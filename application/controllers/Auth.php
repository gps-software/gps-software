<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    // Menampilkan halaman login
    public function index()
    {
        $this->load->view('auth/login');
    }

    // Proses login
    public function aksi_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        
        $data = ['email' => $email];
        $query = $this->User_model->getwhere('auth', $data);
        $result = $query->row_array();

        if (!empty($result) && md5($password) === $result['password']) {
            $data_sess = [
                'logged_in' => TRUE,
                'email' => $result['email'],
                'username' => $result['username'],
                'id' => $result['id']
            ];
            $this->session->set_userdata($data_sess);
            redirect(base_url()."dashboard");
        } else {
            $this->session->set_flashdata('error', 'Email atau kata sandi salah.');
            redirect(base_url().'auth');
        }
    }


    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}
?>