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

    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('auth', $data);
    }

    public function get_kategori() {
        return $this->db->select('kategori')->distinct()->get('kendaraan')->result_array();
    }

    public function get_kendaraan($limit = 10) {
        return $this->db->limit($limit)->where('status', 'Tersedia')->get('kendaraan')->result_array();
    }

    public function get_kendaraan_by_kategori($kategori) {
        return $this->db->where('kategori', urldecode($kategori))->get('kendaraan')->result_array();
    }

    public function get_unique_no_reg_by_nik($nik) {
        $client = $this->get_client_by_nik($nik);
        if(!$client) return [];
        
        $id_client = $client['id'];
        
        // Subquery untuk mendapatkan no_reg terbaru per client
        $this->db->select('no_reg, MAX(created_date) as latest_date');
        $this->db->from('request');
        $this->db->where('id_client', $id_client);
        $this->db->group_by('no_reg');
        $subquery = $this->db->get_compiled_select();
        
        // Query utama
        $this->db->select('p.no_reg, p.date, p.status, k.nama as nama_kendaraan, k.plat_no');
        $this->db->from('request p');
        $this->db->join('kendaraan k', 'p.id_kendaraan = k.id');
        $this->db->join("($subquery) latest", 'p.no_reg = latest.no_reg AND p.created_date = latest.latest_date');
        $this->db->where('p.id_client', $id_client);  // PERBAIKAN DI SINI
        $this->db->order_by('p.created_date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_riwayat_by_no_reg($no_reg) {
        $this->db->select('p.*, k.nama as nama_kendaraan, k.plat_no');
        $this->db->from('request p');
        $this->db->join('kendaraan k', 'p.id_kendaraan = k.id');
        $this->db->where('p.no_reg', $no_reg);
        $this->db->order_by('p.created_date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_client_by_nik($nik) {
        return $this->db->get_where('user', ['nik' => $nik])->row_array();
    }

    public function get_peminjam_by_nik($nik) {
        $this->db->where('nik', $nik);
        $query = $this->db->get('user');
        return $query->row();
    }
    
    public function insert_peminjam($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    
    public function update_peminjam($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }
    
    public function update_kendaraan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kendaraan', $data);
    }
    
    public function insert_pinjaman($data) {
        $this->db->insert('request', $data);
        return $this->db->insert_id();
    }

}