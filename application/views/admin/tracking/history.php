<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tracking</title>
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
                                    <div class="card-title">Riwayat Lokasi</div>
                                </div>
                                <div class="card-body">
                                    <iframe src="https://www.google.com/maps/embed" width="600" height="450"
                                        style="border: 0; width: 100%" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= site_url('dashboard/daftar_req'); ?>"
                                        class="btn btn-danger btn-sm">Batal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>