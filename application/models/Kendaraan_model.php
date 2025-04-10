<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model {

    public function get_all_kendaraan() {
        return $this->db->get('kendaraan')->result_array();
    }

    public function get_kendaraan_by_id($id) {
        return $this->db->get_where('kendaraan', ['id' => $id])->row_array();
    }

    public function tambah_kendaraan($data) {
        return $this->db->insert('kendaraan', $data);
    }

    public function update_kendaraan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kendaraan', $data);
    }

    public function delete_kendaraan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kendaraan');
    }

    public function get_kendaraan_for_export() {
        return $this->db->get('kendaraan')->result_array();
    }

    public function insert_batch($data) {
        return $this->db->insert_batch('kendaraan', $data);
    }
}
