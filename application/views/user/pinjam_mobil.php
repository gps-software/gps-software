<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pinjam Mobil Polisi</title>
    <?php $this->load->view('style/style')?>
    <?php $this->load->view('style/script')?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <style>
    html,
    body {
        padding: 0px;
        margin: 0px;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    nav {
        background: #2c5282;
        padding: 15px 5%;
        border-radius: 0px 0px 30px 30px;
        font-size: 16px;
        font-weight: bold;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-item {
        color: #e2e8f0;
        text-decoration: none;
        transition: color 0.3s ease;
        margin: 0 15px;
    }

    .nav-item:hover {
        color: #f6ad55;
    }

    .container {
        padding-top: 80px;
    }

    .page-inner {
        padding: 0 15px;
    }

    .fw-bold {
        font-weight: bold;
        color: #2d3748;
    }

    .card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .form-label {
        font-weight: 500;
        color: #4a5568;
    }

    .form-control {
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 10px 15px;
        background-color: #f7fafc;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
    }

    .btn-primary {
        background-color: #3182ce;
        border-color: #3182ce;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2c5282;
        border-color: #2c5282;
    }

    .alert {
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #fff5f5;
        border: 1px solid #fed7d7;
        color: #e53e3e;
    }

    .alert-success {
        background-color: #f0fff4;
        border: 1px solid #c6f6d5;
        color: #38a169;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%234a5568' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }
    </style>
</head>

<body>
    <nav class="d-flex justify-content-between items-center">
        <div>
            <a href="<?= base_url('#home'); ?>" class="nav-item">Home</a>
        </div>
        <div>
            <a href="<?= base_url('#daftar-mobil'); ?>" class="nav-item">Daftar Mobil</a>
        </div>
        <div>
            <a href="<?= base_url('user/peminjaman'); ?>" class="nav-item">Peminjaman</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h1 class="fw-bold mb-3">Pinjam Mobil</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($this->session->flashdata('errors')) : ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('errors'); ?>
                            </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('message')) : ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo base_url('user/submit_peminjaman'); ?>"
                                class="row g-3">
                                <input type="hidden" name="id_kendaraan" value="<?php echo $kendaraan['id'] ?>">
                                <div class="col-md-6">
                                    <label for="kendaraan" class="form-label fw-bold">Nama Kendaraan</label>
                                    <input type="text" class="form-control" id="kendaraan" name="kendaraan"
                                        value="<?php echo $kendaraan['nama'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="pangkat" class="form-label fw-bold">Pangkat</label>
                                    <input type="text" class="form-control" id="pangkat" name="pangkat" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="nrp" class="form-label fw-bold">NRP</label>
                                    <input type="text" class="form-control" id="nrp" name="nrp" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="nik" class="form-label fw-bold">NIK</label>
                                    <input type="number" class="form-control" id="nik" name="nik" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="no_telepon" class="form-label fw-bold">No. Telepon</label>
                                    <input type="number" class="form-control" id="no_telepon" name="no_telepon"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        required>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>