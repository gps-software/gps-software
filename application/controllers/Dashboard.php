<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        
    }

    public function index() {
        $this->load->helper('custom');
        $data['greeting'] = greet_user('John Doe');
        $this->load->view('dashboard/dashboard_view', $data);
    }

    public function profile() {
        $get_where = ['id' => $this->session->userdata('id')];
        $data['user'] = $this->User_model->getwhere('auth', $get_where)->row_array();
        $this->load->view('dashboard/profile_view', $data);
    }

    public function updateProfile() {
        $id = $this->session->userdata('id');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'min_length[8]');
        $this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('dashboard/profile');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email')
            ];

            if ($this->input->post('new_password')) {
                $data['password'] = md5($this->input->post('new_password'));
            }

            $this->User_model->updateUser($id, $data);

            $this->session->set_flashdata('message', 'Profile berhasil diperbarui!');
            redirect('dashboard/profile');
        }
    }
    

    public function daftar_peminjam() {
        $this->load->view('dashboard/tabelpeminjam');
    }
}