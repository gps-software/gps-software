<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'pdf', 'excel']);
        $this->load->model('User_model');
        $this->load->model('Peminjam_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('user/user_view');
    }

    public function peminjaman() {
        $this->load->view('user/peminjaman');
    }
}
?>