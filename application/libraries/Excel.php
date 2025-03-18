<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php'; // Pastikan autoload PHPSpreadsheet dipanggil

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    public function __construct()
    {
        // CodeIgniter instance
        $CI = &get_instance();
    }

    public function createSpreadsheet()
    {
        return new Spreadsheet();
    }

    public function saveSpreadsheet($spreadsheet, $filename = 'document.xlsx')
    {
        $writer = new Xlsx($spreadsheet);
        $filePath = FCPATH . 'uploads/' . $filename;
        $writer->save($filePath);
        return $filePath;
    }
}
