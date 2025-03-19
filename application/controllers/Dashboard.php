<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'pdf', 'excel']);
        $this->load->model('User_model');
        $this->load->model('Peminjam_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('dashboard/dashboard_view');
    }

    public function daftar_peminjam() {
        $data['peminjam'] = $this->Peminjam_model->get_all_peminjam();
        $this->load->view('dashboard/tabelpeminjam', $data);
    }
    public function tambah_peminjam() {
        if ($this->input->post()) {
            $data = [
                'nama'       => $this->input->post('nama'),
                'jabatan'    => $this->input->post('jabatan'),
                'pangkat'    => $this->input->post('pangkat'),
                'nrp'        => $this->input->post('nrp'),
                'nik'        => $this->input->post('nik'),
                'no_telepon' => $this->input->post('no_telepon')
            ];
            
            if ($this->Peminjam_model->tambah_peminjam($data)) {
                $this->session->set_flashdata('success', 'Peminjam berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan peminjam!');
            }
    
            redirect('dashboard/daftar_peminjam');
        }
        $this->load->view('dashboard/tambahpeminjam');
    }
    
    public function edit_peminjam($id) {
        $data['peminjam'] = $this->Peminjam_model->get_peminjam_by_id($id);
        if ($this->input->post()) {
            $update_data = [
                'nama'       => $this->input->post('nama'),
                'jabatan'    => $this->input->post('jabatan'),
                'pangkat'    => $this->input->post('pangkat'),
                'nrp'        => $this->input->post('nrp'),
                'nik'        => $this->input->post('nik'),
                'no_telepon' => $this->input->post('no_telepon')
            ];
            
            if ($this->Peminjam_model->update_peminjam($id, $update_data)) {
                $this->session->set_flashdata('success', 'Peminjam berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui peminjam!');
            }
    
            redirect('dashboard/daftar_peminjam');
        }
        $this->load->view('dashboard/editpeminjam', $data);
    }
    
    public function delete_peminjam($id) {
        if ($this->Peminjam_model->delete_peminjam($id)) {
            $this->session->set_flashdata('success', 'Peminjam berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus peminjam!');
        }
    
        redirect('dashboard/daftar_peminjam');
    }

    public function export_pdf()
    {
        $this->load->model('Peminjam_model');
        $data['peminjam'] = $this->Peminjam_model->get_all_peminjam(); 
    
        // Load library Pdf
        $this->load->library('pdf');
    
        // Gunakan fungsi yang sudah dibuat di Pdf.php
        $this->pdf->load_view('dashboard/export_peminjam_pdf', $data);
        $this->pdf->render();
        
        // Kirim output PDF untuk di-download
        $this->pdf->stream("data_peminjam.pdf");
    }    
    
    
    public function export_excel() {
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $peminjam = $this->Peminjam_model->get_peminjam_for_export();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Jabatan');
        $sheet->setCellValue('C1', 'Pangkat');
        $sheet->setCellValue('D1', 'NRP');
        $sheet->setCellValue('E1', 'NIK');
        $sheet->setCellValue('F1', 'No Telepon');

        $row = 2;
        foreach ($peminjam as $p) {
            $sheet->setCellValue("A$row", $p['nama']);
            $sheet->setCellValue("B$row", $p['jabatan']);
            $sheet->setCellValue("C$row", $p['pangkat']);
            $sheet->setCellValue("D$row", $p['nrp']);
            $sheet->setCellValue("E$row", $p['nik']);
            $sheet->setCellValue("F$row", $p['no_telepon']);
            $row++;
        }

        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data_peminjam.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=$filename");
        $writer->save('php://output');
    }

    public function import_excel() {
        if (isset($_FILES['file']['name'])) {
            $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $data = [];
            for ($i = 1; $i < count($sheetData); $i++) {
                $data[] = [
                    'nama'       => $sheetData[$i][0],
                    'jabatan'    => $sheetData[$i][1],
                    'pangkat'    => $sheetData[$i][2],
                    'nrp'        => $sheetData[$i][3],
                    'nik'        => $sheetData[$i][4],
                    'no_telepon' => $sheetData[$i][5],
                ];
            }
            $this->Peminjam_model->insert_batch($data);
            $this->session->set_flashdata('success', 'Data berhasil diimport!');
        }
        redirect('dashboard/daftar_peminjam');
      
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
?>
