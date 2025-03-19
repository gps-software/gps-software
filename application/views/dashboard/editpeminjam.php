<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjam</title>
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
                                    <h4 class="card-title">Edit Peminjam</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url('dashboard/edit_peminjam/' . $peminjam['id']); ?>" method="post">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $peminjam['nama']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control" value="<?= $peminjam['jabatan']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pangkat</label>
                                            <input type="text" name="pangkat" class="form-control" value="<?= $peminjam['pangkat']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>NRP</label>
                                            <input type="text" name="nrp" class="form-control" value="<?= $peminjam['nrp']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control" value="<?= $peminjam['nik']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" name="no_telepon" class="form-control" value="<?= $peminjam['no_telepon']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?= site_url('tabel'); ?>" class="btn btn-secondary">Batal</a>
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