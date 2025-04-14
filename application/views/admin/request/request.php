<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Request</title>
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
                                    <h4 class="card-title">Data Request</h4>
                                    <div>
                                        <a href="<?= base_url('dashboard/export_pdf') ?>"
                                            class="btn btn-info btn-sm">Export
                                            PDF</a>
                                        <a href="<?= base_url('dashboard/export_excel') ?>"
                                            class="btn btn-info btn-sm">Export Excel</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Tabel Request -->
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Kendaraan</th>
                                                    <th>No Registrasi</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($req)) : ?>
                                                <?php $no = 1;
                                                    foreach ($req as $r) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= htmlspecialchars($r['nama_client']); ?></td>
                                                    <td><?= htmlspecialchars($r['model_kendaraan']); ?></td>
                                                    <td><?= htmlspecialchars($r['no_reg']); ?></td>
                                                    <td><?= htmlspecialchars($r['date']); ?></td>
                                                    <td><?php
                                                            $status = htmlspecialchars($r['status']);

                                                            if ($status === 'A') {
                                                                echo '<span class="badge rounded-pill text-bg-primary">Disetujui</span>';
                                                            } elseif ($status === 'R') {
                                                                echo '<span class="badge rounded-pill text-bg-danger">Ditolak</span>';
                                                            } elseif ($status === 'D') {
                                                                echo '<span class="badge rounded-pill text-bg-success">Selesai</span>';
                                                            } elseif ($status === 'P') {
                                                                echo '<span class="badge rounded-pill text-bg-secondary">Tertunda</span>';
                                                            } else {
                                                                echo '<span class="badge rounded-pill text-bg-dark">' . $status . '</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                                            <a href="<?= site_url('dashboard/approved_request/' . $r['id']); ?>"
                                                                class="btn btn-primary btn-sm <?= $r['status'] != 'P' ? 'disabled' : '' ?>"
                                                                title="Setujui"
                                                                <?= $r['status'] != 'P' ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                                                                Setujui
                                                            </a>

                                                            <a href="<?= site_url('dashboard/rejected_request/' . $r['id']); ?>"
                                                                class="btn btn-danger btn-sm <?= $r['status'] != 'P' ? 'disabled' : '' ?>"
                                                                title="Tolak"
                                                                <?= $r['status'] != 'P' ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                                                                Tolak
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data Request
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