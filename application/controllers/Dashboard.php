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
        $this->load->model('Kendaraan_model');
        $this->load->model('Request_model');
    }

    public function index() {
        $this->load->view('dashboard/dashboard_view');
    }

    // ===================== PEMINJAM =====================

    public function daftar_peminjam() {
        $data['peminjam'] = $this->Peminjam_model->get_all_peminjam();
        $this->load->view('admin/user/tabelpeminjam', $data);
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
        $this->load->view('admin/user/tambahpeminjam');
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
        $this->load->view('admin/user/editpeminjam', $data);
    }

    public function delete_peminjam($id) {
        if ($this->Peminjam_model->delete_peminjam($id)) {
            $this->session->set_flashdata('success', 'Peminjam berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus peminjam!');
        }
        redirect('dashboard/daftar_peminjam');
    }

    public function export_pdf() {
        $data['peminjam'] = $this->Peminjam_model->get_all_peminjam(); 
        $this->pdf->load_view('admin/user/export_peminjam_pdf', $data);
        $this->pdf->render();
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
    }

    // ===================== KENDARAAN =====================

    public function daftar_kendaraan() {
        $data['kendaraan'] = $this->Kendaraan_model->get_all_kendaraan();
        $this->load->view('admin/vehicle/tabelkendaraan', $data);
    }

    public function tambah_kendaraan() {
        if ($this->input->post()) {
            $config['upload_path'] = './assets/img/kendaraan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
    
            $this->load->library('upload', $config);
    
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $image = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('dashboard/tambah_kendaraan');
                    return;
                }
            }
    
            $data = [
                'nama'       => $this->input->post('nama'),
                'plat_no'    => $this->input->post('plat_no'),
                'warna'      => $this->input->post('warna'),
                'imei_gps'   => $this->input->post('imei_gps'),
                'image'      => $image,
                'status'     => $this->input->post('status'),
            ];
    
            if ($this->Kendaraan_model->tambah_kendaraan($data)) {
                $this->session->set_flashdata('success', 'Kendaraan berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kendaraan!');
            }
    
            redirect('dashboard/daftar_kendaraan');
        }
    
        $this->load->view('admin/vehicle/tambahkendaraan');
    }
    

    public function edit_kendaraan($id) {
        $kendaraan = $this->Kendaraan_model->get_kendaraan_by_id($id);
    
        if (!$kendaraan) {
            $this->session->set_flashdata('error', 'Data kendaraan tidak ditemukan.');
            redirect('dashboard/daftar_kendaraan');
        }
    
        if ($this->input->post()) {
            // Konfigurasi upload
            $config['upload_path'] = './assets/img/kendaraan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
    
            $this->load->library('upload', $config);
    
            $image = $kendaraan['image']; // default pakai gambar lama
    
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $new_image = $upload_data['file_name'];
    
                    // Hapus gambar lama jika ada
                    if ($kendaraan['image'] && file_exists('./assets/img/kendaraan/' . $kendaraan['image'])) {
                        unlink('./assets/img/kendaraan/' . $kendaraan['image']);
                    }
    
                    $image = $new_image;
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('dashboard/edit_kendaraan/' . $id);
                    return;
                }
            }
    
            $data = [
                'nama'     => $this->input->post('nama'),
                'plat_no'  => $this->input->post('plat_no'),
                'warna'    => $this->input->post('warna'),
                'imei_gps' => $this->input->post('imei_gps'),
                'image'    => $image,
                'status'   => $this->input->post('status'),
            ];
    
            if ($this->Kendaraan_model->update_kendaraan($id, $data)) {
                $this->session->set_flashdata('success', 'Data kendaraan berhasil diupdate!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data kendaraan!');
            }
    
            redirect('dashboard/daftar_kendaraan');
        }
    
        $data['kendaraan'] = $kendaraan;
        $this->load->view('admin/vehicle/editkendaraan', $data);
    }
    

    public function delete_kendaraan($id) {
        if ($this->Kendaraan_model->delete_kendaraan($id)) {
            $this->session->set_flashdata('success', 'Kendaraan berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kendaraan!');
        }
        redirect('dashboard/daftar_kendaraan');
    }

    public function export_kendaraan_excel() {
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $kendaraan = $this->Kendaraan_model->get_kendaraan_for_export();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Plat_no');
        $sheet->setCellValue('C1', 'Warna');
        $sheet->setCellValue('D1', 'Imei_gps');
        $sheet->setCellValue('E1', 'Status');

        $row = 2;
        foreach ($kendaraan as $p) {
            $sheet->setCellValue("A$row", $p['nama']);
            $sheet->setCellValue("B$row", $p['plat_no']);
            $sheet->setCellValue("C$row", $p['warna']);
            $sheet->setCellValue("D$row", $p['imei_gps']);
            $sheet->setCellValue("E$row", $p['status']);
            $row++;
        }

        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data_kendaraan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=$filename");
        $writer->save('php://output');
    }

    public function export_kendaraan_pdf() {
        $data['kendaraan'] = $this->Kendaraan_model->get_all_kendaraan(); 
        $this->pdf->load_view('admin/vehicle/export_kendaraan_pdf', $data);
        $this->pdf->render();
        $this->pdf->stream("data_kendaraan.pdf");
    }

    public function import_kendaraan_excel() {
        if (isset($_FILES['file']['name'])) {
            $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            for ($i = 1; $i < count($sheetData); $i++) {
                $data[] = [
                    'nama' => $sheetData[$i][0],
                    'plat_no'     => $sheetData[$i][1],
                    'warna'          => $sheetData[$i][2],
                    'imei_gps'       => $sheetData[$i][3],
                    'status'         => $sheetData[$i][4],
                ];
            }
            $this->Kendaraan_model->insert_batch($data);
            $this->session->set_flashdata('success', 'Data kendaraan berhasil diimport!');
        }
        redirect('dashboard/daftar_kendaraan');
    }

    // ===================== PEMINJAMAN =====================

    public function daftar_req() {
        $requests = $this->Request_model->get_all_request();

        foreach ($requests as &$req) {
            $client = $this->Peminjam_model->get_name_by_id($req['id_client']);
            $kendaraan = $this->Kendaraan_model->get_data_by_id($req['id_kendaraan']);
            
            $req['nama_client'] = $client ?? 'Unknown';
            $req['model_kendaraan'] = $kendaraan ?? 'Unknown';
        }
        
        $data['req'] = $requests;
        $this->load->view('admin/request/request', $data);
    }

    public function approved_request($id) {
        $req = $this->Request_model->get_request_by_id($id);
        $user = $this->Peminjam_model->get_peminjam_by_id($req['id_client']);
        $car = $this->Kendaraan_model->get_kendaraan_by_id($req['id_kendaraan']);
        // var_dump($user); die;
    
        if ($req) {
            $this->Request_model->insert_history($req);
            $this->Request_model->update_status($id, 'A');

            $this->load->library('email');

            // Konfigurasi email
            $config = array(
                'protocol'      => 'smtp',
                'smtp_host'     => 'smtp.gmail.com',
                'smtp_port'     => 587,
                'smtp_user'     => 'dewipulung57@gmail.com',
                'smtp_pass'     => 'dtwe sfqe fpfd gcdm',
                'smtp_crypto'   => 'tls',
                'mailtype'      => 'html',
                'charset'       => 'utf-8',
                'newline'       => "\r\n",
                'wordwrap'      => TRUE
            );
            $this->email->initialize($config);

            // Data email (ambil dari request)
            $to = $user['email']; // pastikan field email ada di data $user
            $subject = "Request Telah Disetujui";
            $message = "Halo " . $user['nama'] . ",<br><br>Request Peminjaman Mobil Dengan Nama" . $car['nama'] . " Plat " . $car['plat_no']  . " Dan Warna " . $car['warna'] . " telah disetujui.<br><br>Terima kasih.";

            $this->email->from('dewipulung57@gmail.com', 'Admin');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Berhasil Menyetujui Request!');
            } else {
                echo "<pre>";
                print_r($this->email->print_debugger());
                echo "</pre>";
            }
    
            redirect('dashboard/daftar_req');
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyetujui Request!');
        }
    }

    public function rejected_request($id) {
        $req = $this->Request_model->get_request_by_id($id);
        $user = $this->Peminjam_model->get_peminjam_by_id($req['id_client']);
        $car = $this->Kendaraan_model->get_kendaraan_by_id($req['id_kendaraan']);
    
        if ($req) {
            $this->Request_model->insert_history($req);
            $this->Request_model->update_status($id, 'R');

            // Konfigurasi email
            $config = array(
                'protocol'      => 'smtp',
                'smtp_host'     => 'smtp.gmail.com',
                'smtp_port'     => 587,
                'smtp_user'     => 'dewipulung57@gmail.com',
                'smtp_pass'     => 'dtwe sfqe fpfd gcdm',
                'smtp_crypto'   => 'tls',
                'mailtype'      => 'html',
                'charset'       => 'utf-8',
                'newline'       => "\r\n",
                'wordwrap'      => TRUE
            );
            $this->email->initialize($config);

            // Data email (ambil dari request)
            $to = $user['email']; // pastikan field email ada di data $user
            $subject = "Request Telah Ditolak";
            $message = "Halo " . $user['nama'] . ",<br><br>Request Peminjaman Mobil Dengan Nama" . $car['nama'] . " Plat " . $car['plat_no']  . " Dan Warna " . $car['warna'] . " telah ditolak.<br><br>Terima kasih.";

            $this->email->from('dewipulung57@gmail.com', 'Admin');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Berhasil Menolak Request!');
            } else {
                echo "<pre>";
                print_r($this->email->print_debugger());
                echo "</pre>";
            }
    
            redirect('dashboard/daftar_req');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak request!');
            redirect('dashboard/daftar_req');
        }
    }    
      
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
}
?>