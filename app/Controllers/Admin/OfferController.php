<?php

namespace App\Controllers\Admin;

use App\Models\FormSubmissionModel;
use App\Models\OfferModel;
use App\Models\OfferItemModel;
use App\Services\PdfService;
use CodeIgniter\Controller;

helper('offer_number');

class OfferController extends Controller
{
    protected $helpers = ['url'];

    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            header('Location: ' . base_url('admin/login'));
            exit;
        }
    }

    public function create($submissionId)
    {
        $submissionModel = new FormSubmissionModel();
        $submission = $submissionModel->find($submissionId);

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
        $offerModel = new OfferModel();
        $submissionModel = new FormSubmissionModel();

        $submissionId = $this->request->getPost('submission_id');
        $submission = $submissionModel->find($submissionId);

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
            'fixed_price' => $fixedPrice,
            'tarief_description' => $tariefDescription,
            'status' => 'draft',
        ];

        $offerId = $offerModel->insert($offerData);

        if ($offerId) {
            $submissionModel->update($submissionId, ['status' => 'processed']);
            return redirect()->to('/admin/offer/view/' . $offerId)->with('success', 'Offerte succesvol aangemaakt');
        } else {
            return redirect()->back()->with('error', 'Fout bij het aanmaken van offerte');
        }
    }

    public function generatePdf($id)
    {
        $offerModel = new OfferModel();
        $offer = $offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $pdfService = new PdfService();
        $pdfPath = $pdfService->generateOfferPdf($offer);

        $offerModel->update($id, ['pdf_path' => $pdfPath]);

        return redirect()->to('/admin/offer/download/' . $id);
    }

    public function download($id)
    {
        $offerModel = new OfferModel();
        $offer = $offerModel->find($id);

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
        $offerModel = new OfferModel();
        $offer = $offerModel->find($id);

        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $email = \Config\Services::email();

        $email->setFrom('info@uwbedrijf.nl', 'Uw Bedrijfsnaam');
        $email->setTo($offer['client_email']);
        $email->setSubject('Uw offerte ' . $offer['offer_number']);
        $email->setMessage('Beste ' . $offer['client_name'] . ',<br><br>Bijgevoegd vindt u de offerte voor uw aanvraag.<br><br>Met vriendelijke groet,<br>Uw Bedrijfsnaam');

        if ($offer['pdf_path']) {
            $filePath = WRITEPATH . 'uploads/' . $offer['pdf_path'];
            if (file_exists($filePath)) {
                $email->attach($filePath);
            }
        }

        if ($email->send()) {
            $offerModel->update($id, ['status' => 'sent']);
            return redirect()->back()->with('success', 'Offerte succesvol verzonden naar ' . $offer['client_email']);
        } else {
            return redirect()->back()->with('error', 'Fout bij het verzenden van e-mail');
        }
    }
}
