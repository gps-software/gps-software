<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $this->dompdf = new Dompdf($options);
    }

    // Fungsi untuk memuat tampilan sebagai PDF
    public function load_view($view, $data = [])
    {
        $CI = &get_instance();
        $html = $CI->load->view($view, $data, true);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf")
    {
        $this->dompdf->stream($filename, ["Attachment" => true]);
    }
}
