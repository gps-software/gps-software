<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    public function index() {
        $this->load->helper('custom');
        $data['greeting'] = greet_user('John Doe');
        $this->load->view('dashboard/dashboard_view', $data);
    }

    public function profile() {
        $this->load->view('dashboard/profile_view');
    }
}