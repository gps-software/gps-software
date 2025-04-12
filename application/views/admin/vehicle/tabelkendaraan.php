<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Kendaraan</title>
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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Data Kendaraan</h4>
                                    <div>
                                        <a href="<?= base_url('dashboard/export_kendaraan_pdf') ?>" class="btn btn-danger">Export PDF</a>
                                        <a href="<?= base_url('dashboard/export_kendaraan_excel') ?>" class="btn btn-success">Export Excel</a>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal" style="color: aliceblue;">Import Excel</button>
                                        <a href="<?= base_url('dashboard/tambah_kendaraan'); ?>" class="btn btn-primary">Tambah Kendaraan</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal Import -->
                                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="importModalLabel">Import Data Kendaraan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Silakan unduh template terlebih dahulu sebelum mengunggah file.</p>
                                                    <a href="<?= base_url('assets/import_kendaraan.xlsx') ?>" class="btn btn-info">Download Template</a>
                                                    <form action="<?= base_url('dashboard/import_kendaraan_excel') ?>" method="POST" enctype="multipart/form-data" class="mt-3">
                                                        <input type="file" name="file" class="form-control" required>
                                                        <button type="submit" class="btn btn-warning mt-2">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Plat no</th>
                                                        <th>Warna</th>
                                                        <th>IMEI GPS</th>
                                                        <th>image</th>
                                                        <th>Status</th>
                                                        <th style="text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($kendaraan)) : ?>
                                                        <?php $no = 1;
                                                        foreach ($kendaraan as $k) : ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= htmlspecialchars($k['nama']) ?></td>
                                                                <td><?= htmlspecialchars($k['plat_no']) ?></td>
                                                                <td><?= htmlspecialchars($k['warna']) ?></td>
                                                                <td><?= htmlspecialchars($k['imei_gps']) ?></td>
                                                                <td>
                                                                    <?php if ($k['image']) : ?>
                                                                        <img src="<?= base_url('assets/img/kendaraan/' . $k['image']) ?>" width="80">
                                                                    <?php else : ?>
                                                                        -
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= htmlspecialchars($k['status']) ?></td>
                                                                <td style="text-align: center;">
                                                                    <a href="<?= site_url('dashboard/edit_kendaraan/' . $k['id']); ?>" class="btn btn-warning btn-sm" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button onclick="confirmDelete(<?= $k['id'] ?>)" class="btn btn-danger btn-sm" title="Hapus">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="8" class="text-center">Data kendaraan tidak tersedia</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('dashboard/delete_kendaraan/') ?>" + id;
            }
        });
    }
</script>

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

</html>