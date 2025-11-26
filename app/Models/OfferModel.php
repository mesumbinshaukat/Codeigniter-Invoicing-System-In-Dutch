<?php

namespace App\Models;

use CodeIgniter\Model;

class OfferModel extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'offer_number', 'submission_id', 'client_name', 'client_address',
        'client_postcode', 'client_city', 'client_email', 'client_phone',
        'project_address', 'building_type', 'research_area', 'research_purpose',
        'number_of_analyses', 'extra_options', 'subtotal', 'btw_percentage',
        'btw_amount', 'total_amount', 'status', 'pdf_path', 'fixed_price', 'tarief_description'
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

    protected $validationRules = [];
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

    public function getWithSubmission($id)
    {
        return $this->select('offers.*, form_submissions.*')
                    ->join('form_submissions', 'form_submissions.id = offers.submission_id')
                    ->where('offers.id', $id)
                    ->first();
    }
}
