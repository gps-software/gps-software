<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form', 'string']);
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

    public function pinjam_mobil($id_mobil) {
        $data['kendaraan'] = $this->User_model->getwhere("kendaraan", ['id' => $id_mobil])->row_array();
        $this->load->view('user/pinjam_mobil', $data);
    }

    public function submit_peminjaman() {
        $this->form_validation->set_rules('id_kendaraan', 'Id Kendaraan', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('user/peminjaman');
        } else {
            $peminjam_data = array(
                'nama' => $this->input->post('nama'),
                'pangkat' => $this->input->post('pangkat'),
                'jabatan' => $this->input->post('jabatan'),
                'nrp' => $this->input->post('nrp'),
                'nik' => $this->input->post('nik'),
                'no_telepon' => $this->input->post('no_telepon'),
                'email' => $this->input->post('email'),
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s')
            );

            $existing_peminjam = $this->User_model->get_peminjam_by_nik($this->input->post('nik'));
            
            if ($existing_peminjam) {
                $id_peminjam = $existing_peminjam->id;
                $this->User_model->update_peminjam($id_peminjam, $peminjam_data);
            } else {
                $id_peminjam = $this->User_model->insert_peminjam($peminjam_data);
            }
            $pinjaman_data = array(
                'id_client' => $id_peminjam,
                'id_kendaraan' => $this->input->post('id_kendaraan'),
                'no_reg' => 'REQ-' . strtoupper(random_string('alnum', 8)),
                'date' => date('Y-m-d H:i:s'),
                'status' => 'P',
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->User_model->insert_history($pinjaman_data);
            $insert_id = $this->User_model->insert_req($pinjaman_data);
            $this->User_model->update_kendaraan($this->input->post('id_kendaraan'), ['status' => 'U']);
            
            if ($insert_id) {
                $this->session->set_flashdata('message', 'Permohonan peminjaman berhasil diajukan!');
                redirect('user/peminjaman');
            } else {
                $this->session->set_flashdata('errors', 'Gagal mengajukan permohonan peminjaman');
                redirect('user/peminjaman');
            }
        }
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
        $data['no_reg'] = $no_reg;

        if(!$nik) {
            redirect('user');
        }
        $data['detail'] = $this->User_model->get_riwayat_by_no_reg($no_reg);
        $this->load->view('user/detail_permohonan', $data);
    }

    public function pengajuan_pengembalian($no_reg) {
        $request = $this->User_model->get_request_by_no_reg($no_reg);        
        if (!$request) {
            $this->session->set_flashdata('errors', 'Data permohonan tidak ditemukan.');
            redirect('user/check_nik');
        }

        $update_data = [
            'status' => 'RR',
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $this->User_model->update_request($request->id, $update_data);

        // $this->User_model->update_kendaraan($request->id_kendaraan, ['status' => 'A']);

        $history_data = [
            'id_client'    => $request->id_client,
            'id_kendaraan' => $request->id_kendaraan,
            'no_reg'       => $request->no_reg,
            'date'         => date('Y-m-d H:i:s'),
            'status'       => 'RR',
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $this->User_model->insert_history($history_data);

        $this->session->set_flashdata('message', 'Pengajuan Pengembalian berhasil diproses.');
        redirect('user/check_nik');
    }
    
}
?>