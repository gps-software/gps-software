<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjam</title>
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
                                    <h4 class="card-title">Data Peminjam</h4>
                                    <div>
                                        <a href="<?= base_url('dashboard/export_pdf') ?>"
                                            class="btn btn-info btn-sm">Export
                                            PDF</a>
                                        <a href="<?= base_url('dashboard/export_excel') ?>"
                                            class="btn btn-info btn-sm">Export Excel</a>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#importModal" style="color: aliceblue;">Import
                                            Excel</button>
                                        <a href="<?= base_url('dashboard/tambah_peminjam'); ?>"
                                            class="btn btn-primary btn-sm">Tambah Peminjam</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal Import -->
                                    <div class="modal fade" id="importModal" tabindex="-1"
                                        aria-labelledby="importModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="importModalLabel">Import Data Peminjam
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Silakan unduh template terlebih dahulu sebelum mengunggah file.
                                                    </p>
                                                    <a href="<?= base_url('assets/import_peminjam.xlsx') ?>"
                                                        class="btn btn-info">Download Template</a>
                                                    <form action="<?= base_url('dashboard/import_excel') ?>"
                                                        method="POST" enctype="multipart/form-data" class="mt-3">
                                                        <input type="file" name="file" class="form-control" required>
                                                        <button type="submit"
                                                            class="btn btn-warning mt-2">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tabel Peminjam -->
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Jabatan</th>
                                                    <th>Pangkat</th>
                                                    <th>NRP</th>
                                                    <th>NIK</th>
                                                    <th>email</th>
                                                    <th>No Telepon</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($peminjam)) : ?>
                                                <?php $no = 1;
                                                    foreach ($peminjam as $p) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $p['nama']; ?></td>
                                                    <td><?= $p['jabatan']; ?></td>
                                                    <td><?= $p['pangkat']; ?></td>
                                                    <td><?= $p['nrp']; ?></td>
                                                    <td><?= $p['nik']; ?></td>
                                                    <td><?= $p['email']; ?></td>
                                                    <td><?= $p['no_telepon']; ?></td>
                                                    <td class="text-center">
                                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                                            <a href="<?= site_url('dashboard/edit_peminjam/' . $p['id']); ?>"
                                                                class="btn btn-primary btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button onclick="confirmDelete(<?= $p['id'] ?>)"
                                                                class="btn btn-danger btn-sm" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Data peminjam tidak tersedia
                                                    </td>
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
                window.location.href = "<?= base_url('dashboard/delete_peminjam/') ?>" + id;
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


</body>

</html>