<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Kendaraan</title>
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
                                    <h4 class="card-title">Edit Kendaraan</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url('dashboard/edit_kendaraan/' . $kendaraan['id']); ?>"
                                        method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nama Kendaraan</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="<?= $kendaraan['nama']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Plat Nomor</label>
                                            <input type="text" name="plat_no" class="form-control"
                                                value="<?= $kendaraan['plat_no']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna" class="form-control"
                                                value="<?= $kendaraan['warna']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>IMEI GPS</label>
                                            <input type="text" name="imei_gps" class="form-control"
                                                value="<?= $kendaraan['imei_gps']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="image" class="form-control">
                                            <?php if ($kendaraan['image']): ?>
                                            <img src="<?= base_url('assets/img/kendaraan/' . $kendaraan['image']); ?>"
                                                width="100" class="mt-2">
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Tersedia"
                                                    <?= $kendaraan['status'] == 'A' ? 'selected' : '' ?>>Tersedia
                                                </option>
                                                <option value="Digunakan"
                                                    <?= $kendaraan['status'] == 'Us' ? 'selected' : '' ?>>
                                                    Digunakan</option>
                                                <option value="Servis"
                                                    <?= $kendaraan['status'] == 'S' ? 'selected' : '' ?>>Servis
                                                </option>
                                            </select>
                                        </div>
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
</body>

</html>