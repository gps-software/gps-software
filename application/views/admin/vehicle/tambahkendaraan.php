<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>
    <?php $this->load->view('style/style') ?>
    <?php $this->load->view('style/script') ?>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('components/sidebar') ?>
        <div class="main-panel">
            <?php $this->load->view('components/navbar') ?>
            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Kendaraan</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url('dashboard/tambah_kendaraan'); ?>" method="post"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nama Kendaraan</label>
                                            <input type="text" name="nama" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Plat Nomor</label>
                                            <input type="text" name="plat_no" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>IMEI GPS</label>
                                            <input type="text" name="imei_gps" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="A">Tersedia</option>
                                                <option value="U">Tidak Tersedia</option>
                                                <option value="Us">Digunakan</option>
                                                <option value="S">Service</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                                            <a href="<?= site_url('dashboard/daftar_kendaraan'); ?>"
                                                class="btn btn-danger btn-sm">Batal</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    <?php if ($this->session->flashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '<?= $this->session->flashdata('success') ?>',
        showConfirmButton: false,
        timer: 2000
    });
    <?php elseif ($this->session->flashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $this->session->flashdata('error') ?>',
    });
    <?php endif; ?>
    </script>


</body>

</html>