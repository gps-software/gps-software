<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {
    
    public function get_all_request() {
        return $this->db->get('request')->result_array();
    }

    public function get_request_by_id($id) {
        return $this->db->get_where('request', ['id' => $id])->row_array();
    }

    public function tambah_request($data) {
        return $this->db->insert('request', $data);
    }

    public function update_request($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('request', $data);
    }

    public function delete_request($id) {
        $this->db->where('id', $id);
        return $this->db->delete('request');
    }

    public function get_request_for_export() {
        return $this->db->get('request')->result_array();
    }

    public function insert_history($req) {
        $data = [
            'id_client'     => $req['id_client'],
            'id_kendaraan'  => $req['id_kendaraan'],
            'no_reg'        => $req['no_reg'],
            'date'          => $req['date'],
            'status'        => $req['status'],
            'created_date'  => $req['created_date'],
            'updated_date'  => $req['updated_date'],
        ];
        
        return $this->db->insert('request_history', $data);
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('request', ['status' => $status]);
    }
}
?>