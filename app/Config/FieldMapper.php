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
            'number_of_analyses' => 'offers.number_of_analyses',
            'extra_options' => 'offers.extra_options',
            'subtotal' => 'offers.subtotal',
            'btw_percentage' => 'offers.btw_percentage',
            'btw_amount' => 'offers.btw_amount',
            'total_amount' => 'offers.total_amount',
            'items' => 'offer_items',
        ];
    }

    public static function getStaticFields()
    {
        return [
            'company_name' => 'Uw Bedrijfsnaam',
            'company_address' => 'Bedrijfsadres 123',
            'company_postcode' => '1234 AB',
            'company_city' => 'Amsterdam',
            'company_phone' => '+31 (0)20 123 4567',
            'company_email' => 'info@uwbedrijf.nl',
            'company_kvk' => 'KvK: 12345678',
            'company_btw' => 'BTW: NL123456789B01',
            'company_iban' => 'IBAN: NL12 ABCD 0123 4567 89',
            'payment_terms' => '14 dagen',
            'validity_period' => '30 dagen',
        ];
    }
}
