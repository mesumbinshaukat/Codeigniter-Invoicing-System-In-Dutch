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
            'recent_submissions' => $submissionModel->orderBy('created_at', 'DESC')->findAll(5),
        ];

        return view('admin/dashboard', $data);
    }

    public function submissions()
    {
        $submissionModel = new FormSubmissionModel();
        
        $data = [
            'submissions' => $submissionModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/submissions_list', $data);
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
        ];

        return view('admin/offer_detail', $data);
    }
}
