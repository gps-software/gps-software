<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    // Contoh method untuk mengambil semua user
    public function get_users() {
        $query = $this->db->get('users'); // 'users' adalah nama tabel
        return $query->result();
    }

    // Contoh method untuk mengambil user berdasarkan ID
    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    // Contoh method untuk menambahkan user
    public function add_user($data) {
        return $this->db->insert('users', $data);
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
}