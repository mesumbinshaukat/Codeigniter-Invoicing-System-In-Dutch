<?php

namespace App\Controllers\Admin;

use App\Models\FormSubmissionModel;
use App\Models\OfferModel;
use App\Services\PdfService;
use CodeIgniter\Controller;

helper('offer_number');

class OfferController extends Controller
{
    protected $helpers = ['url'];

    protected OfferModel $offerModel;
    protected FormSubmissionModel $submissionModel;

    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            header('Location: ' . base_url('admin/login'));
            exit;
        }

        $this->offerModel = new OfferModel();
        $this->submissionModel = new FormSubmissionModel();
    }

    public function create($submissionId)
    {
        $submission = $this->submissionModel->find($submissionId);

        if (!$submission) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        $data = [
            'submission' => $submission,
        ];

        return view('admin/create_offer', $data);
    }

    public function store()
    {
        $submissionId = $this->request->getPost('submission_id');
        $submission = $this->submissionModel->find($submissionId);

        if (!$submission) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        $offerNumber = generateOfferNumber();

        $fixedPrice = $this->request->getPost('fixed_price');
        $tariefDescription = $this->request->getPost('tarief_description');

        $offerData = [
            'offer_number' => $offerNumber,
            'submission_id' => $submissionId,
            'client_name' => $submission['naam'],
            'client_address' => $submission['adres'],
            'client_postcode' => $submission['postcode'],
            'client_city' => $submission['woonplaats'],
            'client_email' => $submission['email'],
            'client_phone' => $submission['telefoonnummer'],
            'project_address' => $submission['project_adres'],
            'building_type' => $submission['type_gebouw'],
            'research_area' => $submission['onderzoeksgebied'] ?? '',
            'research_purpose' => $submission['doel_onderzoek'],
            'number_of_analyses' => $submission['aantal_analyses'] ?? null,
            'extra_options' => $submission['extra_opties'] ?? null,
            'fixed_price' => $fixedPrice,
            'tarief_description' => $tariefDescription,
            'status' => 'draft',
            'client_response_token' => $this->generateClientToken(),
            'client_response_at' => null,
        ];

        $offerId = $this->offerModel->insert($offerData);

        if ($offerId) {
            $this->submissionModel->update($submissionId, ['status' => 'processed']);
            return redirect()->to('/admin/offer/view/' . $offerId)->with('success', 'Offerte succesvol aangemaakt');
        } else {
            return redirect()->back()->with('error', 'Fout bij het aanmaken van offerte');
        }
    }

    public function edit($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        return view('admin/edit_offer', ['offer' => $offer]);
    }

    public function update($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $status = $this->request->getPost('status') ?? $offer['status'];
        $allowedStatuses = ['draft', 'sent', 'accepted', 'rejected'];
        if (!in_array($status, $allowedStatuses, true)) {
            $status = $offer['status'];
        }

        $fixedPriceInput = $this->request->getPost('fixed_price');
        $tariefDescriptionInput = $this->request->getPost('tarief_description');

        $payload = [
            'fixed_price' => ($fixedPriceInput === null || $fixedPriceInput === '') ? $offer['fixed_price'] : $fixedPriceInput,
            'tarief_description' => ($tariefDescriptionInput === null || $tariefDescriptionInput === '') ? $offer['tarief_description'] : $tariefDescriptionInput,
            'status' => $status,
        ];

        if ($offer['status'] !== $status) {
            if (in_array($status, ['accepted', 'rejected'], true)) {
                $payload['client_response_at'] = date('Y-m-d H:i:s');
            } else {
                $payload['client_response_at'] = null;
            }
        }

        if ($this->offerModel->update($id, $payload)) {
            return redirect()->to('/admin/offer/view/' . $id)->with('success', 'Offerte bijgewerkt');
        }

        return redirect()->back()->withInput()->with('error', 'Bijwerken mislukt');
    }

    public function generatePdf($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $pdfService = new PdfService();
        $pdfPath = $pdfService->generateOfferPdf($offer);

        $this->offerModel->update($id, ['pdf_path' => $pdfPath]);

        return redirect()->to('/admin/offer/download/' . $id);
    }

    public function download($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer || !$offer['pdf_path']) {
            return redirect()->to('/admin/offers')->with('error', 'PDF niet gevonden');
        }

        $filePath = WRITEPATH . 'uploads/' . $offer['pdf_path'];

        if (!file_exists($filePath)) {
            return redirect()->to('/admin/offers')->with('error', 'PDF bestand niet gevonden');
        }

        $filename = $offer['offer_number'] . '.pdf';
        
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        
        readfile($filePath);
        exit;
    }

    public function email($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $offer = $this->ensurePdfExists($offer);
        $token = $this->ensureClientToken($offer);
        $responseUrl = base_url('offer/respond/' . $token);
        $acceptUrl = base_url('offer/respond/' . $token . '/accept');
        $rejectUrl = base_url('offer/respond/' . $token . '/reject');

        $email = \Config\Services::email();
        $emailConfig = config('Email');
        $fromEmail = $emailConfig->fromEmail ?: 'info@example.com';
        $fromName = $emailConfig->fromName ?: 'Offerte Systeem';
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($offer['client_email']);
        $email->setSubject('Uw offerte ' . $offer['offer_number']);
        $email->setMessage(view('emails/offer_notification', [
            'offer' => $offer,
            'detailsUrl' => $responseUrl,
            'acceptUrl' => $acceptUrl,
            'rejectUrl' => $rejectUrl,
        ]));

        $filePath = WRITEPATH . 'uploads/' . $offer['pdf_path'];
        if (file_exists($filePath)) {
            $email->attach($filePath);
        }

        if ($email->send()) {
            $this->offerModel->update($id, ['status' => 'sent']);
            return redirect()->back()->with('success', 'Offerte succesvol verzonden naar ' . $offer['client_email']);
        }

        $debugInfo = $email->printDebugger(['headers', 'subject']);
        log_message('error', 'Offer email send failed for offer #{offerId} : {debug}', ['offerId' => $offer['id'], 'debug' => $debugInfo]);

        return redirect()->back()->with('error', 'E-mail verzenden mislukt. Controleer SMTP instellingen. Details: ' . strip_tags($debugInfo));
    }

    public function delete($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        if (!empty($offer['pdf_path'])) {
            $filePath = WRITEPATH . 'uploads/' . $offer['pdf_path'];
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        if ($this->offerModel->delete($id)) {
            return redirect()->to('/admin/offers')->with('success', 'Offerte verwijderd');
        }

        return redirect()->back()->with('error', 'Verwijderen mislukt');
    }

    public function copy($id)
    {
        $offer = $this->offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        unset($offer['id'], $offer['created_at'], $offer['updated_at'], $offer['pdf_path']);
        $offer['offer_number'] = generateOfferNumber();
        $offer['status'] = 'draft';
        $offer['client_response_token'] = $this->generateClientToken();
        $offer['client_response_at'] = null;
        $offer['pdf_path'] = null;

        $newId = $this->offerModel->insert($offer);

        if ($newId) {
            return redirect()->to('/admin/offer/view/' . $newId)->with('success', 'Offerte gekopieerd');
        }

        return redirect()->back()->with('error', 'Kopiëren mislukt');
    }

    protected function generateClientToken(): string
    {
        return bin2hex(random_bytes(16));
    }

    protected function ensureClientToken(array $offer): string
    {
        if (!empty($offer['client_response_token'])) {
            return $offer['client_response_token'];
        }

        $token = $this->generateClientToken();
        $this->offerModel->update($offer['id'], ['client_response_token' => $token]);

        return $token;
    }

    protected function ensurePdfExists(array $offer): array
    {
        $needsPdf = empty($offer['pdf_path']);

        if (!$needsPdf) {
            $filePath = WRITEPATH . 'uploads/' . $offer['pdf_path'];
            $needsPdf = !is_file($filePath);
        }

        if ($needsPdf) {
            $pdfService = new PdfService();
            $pdfPath = $pdfService->generateOfferPdf($offer);
            $this->offerModel->update($offer['id'], ['pdf_path' => $pdfPath]);
            $offer['pdf_path'] = $pdfPath;
        }

        return $offer;
    }
}
