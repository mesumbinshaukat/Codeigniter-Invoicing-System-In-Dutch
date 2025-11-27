<?php

namespace App\Controllers\Admin;

use App\Models\FormSubmissionModel;
use App\Models\OfferModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $helpers = ['url'];

    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            header('Location: ' . base_url('admin/login'));
            exit;
        }
    }

    public function dashboard()
    {
        $submissionModel = new FormSubmissionModel();
        $offerModel = new OfferModel();

        $data = [
            'total_submissions' => $submissionModel->countAll(),
            'pending_submissions' => $submissionModel->where('status', 'pending')->countAllResults(),
            'total_offers' => $offerModel->countAll(),
            'accepted_offers' => $offerModel->where('status', 'accepted')->countAllResults(),
            'recent_submissions' => $submissionModel->orderBy('created_at', 'DESC')->findAll(5),
        ];

        return view('admin/dashboard', $data);
    }

    public function submissions()
    {
        $submissionModel = new FormSubmissionModel();
        
        $data = [
            'submissions' => $submissionModel
                ->where('status !=', 'archived')
                ->orderBy('created_at', 'DESC')
                ->findAll(),
        ];

        return view('admin/submissions_list', $data);
    }

    public function archivedSubmissions()
    {
        $submissionModel = new FormSubmissionModel();

        $data = [
            'submissions' => $submissionModel
                ->where('status', 'archived')
                ->orderBy('updated_at', 'DESC')
                ->findAll(),
        ];

        return view('admin/submissions_archive', $data);
    }

    public function viewSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();
        $offerModel = new OfferModel();
        
        $submission = $submissionModel->find($id);
        
        if (!$submission) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        $offer = $offerModel->where('submission_id', $id)->first();

        $data = [
            'submission' => $submission,
            'offer' => $offer,
        ];

        return view('admin/submission_detail', $data);
    }

    public function editSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();
        $submission = $submissionModel->find($id);

        if (!$submission) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        $data = [
            'submission' => $submission,
        ];

        return view('admin/submission_form', $data);
    }

    public function updateSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();
        $submission = $submissionModel->find($id);

        if (!$submission) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        $payload = $this->request->getPost([ 'naam', 'adres', 'postcode', 'woonplaats', 'email', 'telefoonnummer', 'project_adres', 'type_gebouw', 'onderzoeksgebied', 'doel_onderzoek', 'aantal_analyses', 'extra_opties', 'status' ]);

        if ($submissionModel->update($id, $payload)) {
            return redirect()->to('/admin/submission/view/' . $id)->with('success', 'Inzending bijgewerkt');
        }

        return redirect()->back()->withInput()->with('errors', $submissionModel->errors());
    }

    public function copySubmission($id)
    {
        $submissionModel = new FormSubmissionModel();
        $original = $submissionModel->find($id);

        if (!$original) {
            return redirect()->to('/admin/submissions')->with('error', 'Inzending niet gevonden');
        }

        unset($original['id'], $original['created_at'], $original['updated_at']);
        $original['status'] = 'pending';

        $newId = $submissionModel->insert($original);

        if ($newId) {
            return redirect()->to('/admin/submission/view/' . $newId)->with('success', 'Inzending gekopieerd');
        }

        return redirect()->back()->with('error', 'Kopiëren mislukt');
    }

    public function archiveSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();

        if ($submissionModel->update($id, ['status' => 'archived'])) {
            return redirect()->back()->with('success', 'Inzending gearchiveerd');
        }

        return redirect()->back()->with('error', 'Archiveren mislukt');
    }

    public function restoreSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();

        if ($submissionModel->update($id, ['status' => 'pending'])) {
            return redirect()->back()->with('success', 'Inzending hersteld');
        }

        return redirect()->back()->with('error', 'Herstellen mislukt');
    }

    public function deleteSubmission($id)
    {
        $submissionModel = new FormSubmissionModel();

        if ($submissionModel->delete($id)) {
            return redirect()->to('/admin/submissions')->with('success', 'Inzending verwijderd');
        }

        return redirect()->back()->with('error', 'Verwijderen mislukt');
    }

    public function offers()
    {
        $offerModel = new OfferModel();
        
        $data = [
            'offers' => $offerModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/offers_list', $data);
    }

    public function viewOffer($id)
    {
        $offerModel = new OfferModel();
        
        $offer = $offerModel->find($id);
        
        if (!$offer) {
            return redirect()->to('/admin/offers')->with('error', 'Offerte niet gevonden');
        }

        $data = [
            'offer' => $offer,
            'clientResponseUrl' => $offer['client_response_token'] ? base_url('offer/respond/' . $offer['client_response_token']) : null,
        ];

        return view('admin/offer_detail', $data);
    }
}
