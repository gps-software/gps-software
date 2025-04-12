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
    }

    nav {
        background: #004080;
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

    .home {
        background: #f1f1f1;
        padding-top: 100px;
        min-height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
    }

    .home h1 {
        color: #004080;
        font-size: 4rem;
        margin-bottom: 30px;
        position: absolute;
        z-index: 0;
        top: 38%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: "Lilita One", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .home p {
        color: #333;
        font-size: 1.2rem;
        position: relative;
        z-index: 2;
    }

    .home img {
        max-width: 100%;
        height: auto;
        max-height: 140px;
        position: relative;
        z-index: 0;
    }

    .nav-item {
        color: white;
        text-decoration: none;
        transition: color 0.3s ease;
        margin: 0 15px;
    }

    .nav-item:hover {
        color: #ffcc00;
    }

    .kategori-mobil {
        margin: -40px 3% 0px 3%;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .kategori-item {
        color: black;
        text-decoration: none;
        transition: color 0.3s ease;
        margin: 0 10px;
    }

    .kategori-item:hover {
        color: #ffcc00;
    }

    .daftar-mobil {
        margin: 50px 10%;
    }

    .card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        /* text-align: center; */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .judul {
        font-size: 1.5rem;
        color: #004080;
        margin-bottom: 10px;
    }

    .sub-judul {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 15px;
    }

    .card img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .card {
        cursor: pointer;
    }

    .riwayat-container {
        margin: 50px 10%;
    }

    .kendaraan-card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .riwayat-item {
        background: #f9f9f9;
        border-left: 4px solid #004080;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .riwayat-item:hover {
        background: #e6f0ff;
    }

    .status-pending {
        color: #ff9800;
        font-weight: bold;
    }

    .status-disetujui {
        color: #4caf50;
        font-weight: bold;
    }

    .status-selesai {
        color: #2196f3;
        font-weight: bold;
    }

    .status-ditolak {
        color: #f44336;
        font-weight: bold;
    }

    .permohonan-card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .permohonan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .back-button {
        display: inline-block;
        background: #004080;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-decoration: none;
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

    <div class="container" style="padding-top: 100px;">
        <h2>Detail Permohonan: <?= $detail[0]['no_reg'] ?></h2>

        <a href="<?= base_url('user/check_nik') ?>" class="back-button">Kembali ke Daftar Permohonan</a>

        <?php foreach($detail as $d): ?>
        <div class="riwayat-item">
            <div class="d-flex justify-content-between">
                <h4><?= $d['nama_kendaraan'] ?> (<?= $d['plat_no'] ?>)</h4>
                <span class="status-<?= strtolower($d['status']) ?>">
                    <?php
                        $status = htmlspecialchars($d['status']);

                        if ($status === 'A') {
                            echo '<span class="badge rounded-pill text-bg-success">Disetujui</span>';
                        } elseif ($status === 'R') {
                            echo '<span class="badge rounded-pill text-bg-danger">Ditolak</span>';
                        } elseif ($status === 'D') {
                            echo '<span class="badge rounded-pill text-bg-info">Selesai</span>';
                        } elseif ($status === 'P') {
                            echo '<span class="badge rounded-pill text-bg-info">Pending</span>';
                        } else {
                            echo '<span class="badge rounded-pill text-bg-dark">' . $status . '</span>';
                        }
                    ?>
                </span>
            </div>
            <p>Tanggal: <?= date('d F Y', strtotime($d['date'])) ?></p>
            <p>Dibuat pada: <?= date('d F Y H:i', strtotime($d['created_date'])) ?></p>
            <?php
                $status = htmlspecialchars($d['status']);

                if ($status === 'A') {
                    echo '<p>Disetujui Pada: </p>' . date('d F Y H:i', strtotime($d['updated_date']));
                } elseif ($status === 'R') {
                    echo '<p>Ditolak Pada: </p>' . date('d F Y H:i', strtotime($d['updated_date']));
                } elseif ($status === 'D') {
                    echo '<p>Selesai Pada:</p>'. date('d F Y H:i', strtotime($d['updated_date']));
                } elseif ($status === 'P') {
                    echo '<p>Pending</p>';
                } else {
                    echo '<p>' . $status . '</p>';
                }
            ?>
        </div>
        <?php endforeach; ?>
    </div>
</body>


</html>