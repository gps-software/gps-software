<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam_model extends CI_Model {
    
    // ✅ Ambil semua data peminjam
    public function get_all_peminjam() {
        return $this->db->get('peminjam')->result_array();
    }

    // ✅ Ambil data peminjam berdasarkan ID
    public function get_peminjam_by_id($id) {
        return $this->db->get_where('peminjam', ['id' => $id])->row_array();
    }

    // ✅ Tambah peminjam baru
    public function tambah_peminjam($data) {
        return $this->db->insert('peminjam', $data);
    }

    // ✅ Update data peminjam
    public function update_peminjam($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('peminjam', $data);
    }

    // ✅ Hapus peminjam berdasarkan ID
    public function delete_peminjam($id) {
        $this->db->where('id', $id);
        return $this->db->delete('peminjam');
    }

    // ✅ Export semua peminjam untuk Excel/PDF
    public function get_peminjam_for_export() {
        return $this->db->get('peminjam')->result_array();
    }

    // ✅ Import data peminjam dalam jumlah besar
    public function insert_batch($data) {
        return $this->db->insert_batch('peminjam', $data);
    }
}
?>
