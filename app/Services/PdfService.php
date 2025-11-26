<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');
        
        $this->dompdf = new Dompdf($options);
    }

    public function generateOfferPdf($offer)
    {
        $data = [
            'offer_number' => $offer['offer_number'],
            'client_name' => $offer['client_name'],
            'client_address' => $offer['client_address'] ?? '',
            'client_postcode' => $offer['client_postcode'],
            'client_city' => $offer['client_city'],
            'client_email' => $offer['client_email'],
            'client_phone' => $offer['client_phone'],
            'project_address' => $offer['project_address'],
            'building_type' => $offer['building_type'],
            'research_area' => $offer['research_area'] ?? '',
            'research_purpose' => $offer['research_purpose'],
            'fixed_price' => $offer['fixed_price'],
            'tarief_description' => $offer['tarief_description'],
        ];

        $html = view('pdf/offer_template', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();

        $uploadsDir = WRITEPATH . 'uploads/';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $filename = 'offer_' . $offer['offer_number'] . '_' . time() . '.pdf';
        $filepath = $uploadsDir . $filename;

        file_put_contents($filepath, $this->dompdf->output());

        return $filename;
    }

    public function streamPdf($offer)
    {
        $data = [
            'offer_number' => $offer['offer_number'],
            'client_name' => $offer['client_name'],
            'client_address' => $offer['client_address'] ?? '',
            'client_postcode' => $offer['client_postcode'],
            'client_city' => $offer['client_city'],
            'client_email' => $offer['client_email'],
            'client_phone' => $offer['client_phone'],
            'project_address' => $offer['project_address'],
            'building_type' => $offer['building_type'],
            'research_area' => $offer['research_area'] ?? '',
            'research_purpose' => $offer['research_purpose'],
            'fixed_price' => $offer['fixed_price'],
            'tarief_description' => $offer['tarief_description'],
        ];

        $html = view('pdf/offer_template', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();

        return $this->dompdf->stream($offer['offer_number'] . '.pdf', ['Attachment' => false]);
    }
}
