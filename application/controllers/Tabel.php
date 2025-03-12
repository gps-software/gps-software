<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('BorrowModel');
    }

    public function index() {
        $this->load->view('tabel/tabelpeminjam');
    }

}