<?php

use App\Models\CounterModel;

if (!function_exists('generateOfferNumber')) {
    function generateOfferNumber()
    {
        $counterModel = new CounterModel();
        
        $year = date('y');
        $month = date('m');
        
        $counter = $counterModel->getNextCounter($year, $month);
        
        $offerNumber = 'OA' . $year . $month . str_pad($counter, 3, '0', STR_PAD_LEFT);
        
        return $offerNumber;
    }
}
