<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam_model extends CI_Model {
    public function get_all_peminjam() {
        return $this->db->get('user')->result_array();
    }

    public function get_peminjam_by_id($id) {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function tambah_peminjam($data) {
        return $this->db->insert('user', $data);
    }

    public function update_peminjam($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function delete_peminjam($id) {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }

    public function get_peminjam_for_export() {
        return $this->db->get('user')->result_array();
    }

    public function insert_batch($data) {
        return $this->db->insert_batch('user', $data);
    }

    public function get_name_by_id($id) {
        $result = $this->db->get_where('user', ['id' => $id])->row_array();
        return $result['nama'] ?? null;
    }

    public function get_user_count() {
        return $this->db->count_all('user');
    }
}
?>