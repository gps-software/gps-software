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
        text-align: center;
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

    <!-- Section untuk input NIK -->
    <section id="input-nik"
        style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center;">
        <div
            style="max-width: 500px; width: 100%; background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2 class="judul" style="margin-bottom: 25px; font-size: 2rem; color: #004080;">Masukkan NIK</h2>
            <form action="/submit-nik" method="POST" style="text-align: left;">
                <div style="margin-bottom: 25px;">
                    <label for="nik"
                        style="font-size: 1.3rem; color: #004080; font-weight: bold; display: block; margin-bottom: 12px;">NIK:</label>
                    <input type="text" id="nik" name="nik" placeholder="Masukkan NIK Anda" required pattern="\d{16}"
                        maxlength="16"
                        style="width: 100%; padding: 14px; border: 1px solid #ccc; border-radius: 8px; font-size: 1.1rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" />
                </div>
                <button type="submit"
                    style="background: #004080; color: white; padding: 14px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: background 0.3s ease;">
                    Kirim
                </button>
            </form>
        </div>
    </section>

    <section id="daftar-mobil" class="daftar-mobil">
        <!-- Daftar mobil akan ditampilkan di sini -->
    </section>
</body>


</html>