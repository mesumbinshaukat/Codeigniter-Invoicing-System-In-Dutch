<?php

namespace App\Controllers;

use App\Models\FormSubmissionModel;
use CodeIgniter\Controller;

class FormController extends Controller
{
    public function index()
    {
        return view('public/form');
    }

    public function submit()
    {
        $model = new FormSubmissionModel();

        $data = [
            'naam' => $this->request->getPost('naam'),
            'adres' => $this->request->getPost('adres'),
            'postcode' => $this->request->getPost('postcode'),
            'woonplaats' => $this->request->getPost('woonplaats'),
            'email' => $this->request->getPost('email'),
            'telefoonnummer' => $this->request->getPost('telefoonnummer'),
            'project_adres' => $this->request->getPost('project_adres'),
            'type_gebouw' => $this->request->getPost('type_gebouw'),
            'onderzoeksgebied' => $this->request->getPost('onderzoeksgebied'),
            'doel_onderzoek' => $this->request->getPost('doel_onderzoek'),
            'status' => 'pending',
        ];

        if ($model->insert($data)) {
            return redirect()->to('/form/success');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function success()
    {
        return view('public/success');
    }
}
