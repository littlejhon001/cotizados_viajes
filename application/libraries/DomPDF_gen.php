<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "/third_party/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

class DomPDF_gen {

    public function generate($html, $filename = '', $stream = TRUE, $paper = 'letter', $orientation = "portrait" ) {
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_option('isHtml5ParserEnabled', true); // Enable HTML5 parser

        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);

        $dompdf->render();

        $output = $dompdf->output();
        //$dompdf->stream("hoja_vida_ccs",['Attachment']);
        return $output;
        //   file_put_contents('documentos/'. $filename, $output);
        // return file_get_contents('documentos/'. $ filename);
    }

}