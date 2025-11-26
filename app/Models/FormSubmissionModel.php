<?php

namespace App\Models;

use CodeIgniter\Model;

class FormSubmissionModel extends Model
{
    protected $table = 'form_submissions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'naam', 'adres', 'postcode', 'woonplaats', 'email', 'telefoonnummer',
        'project_adres', 'type_gebouw', 'onderzoeksgebied', 'doel_onderzoek', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'naam' => 'required|min_length[2]|max_length[255]',
        'adres' => 'permit_empty|max_length[255]',
        'postcode' => 'required|max_length[20]',
        'woonplaats' => 'required|max_length[100]',
        'email' => 'required|valid_email',
        'telefoonnummer' => 'required|max_length[20]',
        'project_adres' => 'required|max_length[255]',
        'type_gebouw' => 'required|max_length[100]',
        'onderzoeksgebied' => 'permit_empty',
        'doel_onderzoek' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
