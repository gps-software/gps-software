<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'pdf', 'excel']);
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['kategori'] = $this->User_model->get_kategori();
        $data['kendaraan'] = $this->User_model->get_kendaraan(10);
        $this->load->view('user/user_view', $data);
    }

    public function get_by_kategori($kategori) {
        header('Content-Type: application/json');
        $data['kendaraan'] = $this->User_model->get_kendaraan_by_kategori($kategori);
        echo json_encode($data['kendaraan']);
    }

    public function peminjaman() {
        $this->load->view('user/peminjaman');
    }

    public function check_nik() {
        $nik = $this->input->post('nik') ? $this->input->post('nik') : $this->session->userdata('nik');
        
        if ($nik) {
            $this->session->set_userdata('nik', $nik);
            $data['permohonan'] = $this->User_model->get_unique_no_reg_by_nik($nik);
        } else {
            $data['permohonan'] = array();
        }
        
        $this->load->view('user/peminjaman', $data);
    }
    
    public function detail_permohonan($no_reg) {
        $nik = $this->session->userdata('nik');
        if(!$nik) {
            redirect('user');
        }
        $data['detail'] = $this->User_model->get_riwayat_by_no_reg($no_reg);
        $this->load->view('user/detail_permohonan', $data);
    }
    
}
?>