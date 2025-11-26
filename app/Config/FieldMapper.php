<?php

namespace App\Config;

class FieldMapper
{
    public static function getPdfFieldMapping()
    {
        return [
            'offer_number' => 'offers.offer_number',
            'offer_date' => 'current_date',
            'client_name' => 'offers.client_name',
            'client_address' => 'offers.client_address',
            'client_postcode' => 'offers.client_postcode',
            'client_city' => 'offers.client_city',
            'client_email' => 'offers.client_email',
            'client_phone' => 'offers.client_phone',
            'project_address' => 'offers.project_address',
            'building_type' => 'offers.building_type',
            'research_area' => 'offers.research_area',
            'research_purpose' => 'offers.research_purpose',
            'fixed_price' => 'offers.fixed_price',
            'tarief_description' => 'offers.tarief_description',
        ];
    }

    public static function getStaticFields()
    {
        return [
            'company_name' => 'Asbestinventarisatie en Milieuadvies B.V.',
            'company_address' => 'Kerkstraat 41',
            'company_postcode' => '5101 BB',
            'company_city' => 'Dongen',
            'company_phone' => '0162 - 764 024',
            'company_email' => 'info@aenmbv.nl',
            'company_website' => 'www.aenmbv.nl',
            'company_kvk' => 'KvK 53156145',
            'company_btw' => 'BTW nr NL 850771870B01',
            'company_iban' => 'Van Lanschot 22 74 07 253',
        ];
    }
}
