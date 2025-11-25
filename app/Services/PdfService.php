<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Config\FieldMapper;

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
        $staticFields = FieldMapper::getStaticFields();
        
        $data = array_merge($offer, $staticFields, [
            'offer_date' => date('d-m-Y'),
            'logo_path' => FCPATH . 'uploads/logo/company-logo.png',
        ]);

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
        $staticFields = FieldMapper::getStaticFields();
        
        $data = array_merge($offer, $staticFields, [
            'offer_date' => date('d-m-Y'),
            'logo_path' => FCPATH . 'uploads/logo/company-logo.png',
        ]);

        $html = view('pdf/offer_template', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();

        return $this->dompdf->stream($offer['offer_number'] . '.pdf', ['Attachment' => false]);
    }
}
