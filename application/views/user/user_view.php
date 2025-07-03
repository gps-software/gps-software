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
            <a href="#home" class="nav-item">Home</a>
        </div>
        <div>
            <a href="#daftar-mobil" class="nav-item">Daftar Mobil</a>
        </div>
        <div>
            <a href="<?= base_url('user/peminjaman'); ?>" class="nav-item">Peminjaman</a>
        </div>
    </nav>

    <div id="home" class="home">
        <div>
            <h1>PINJAM MOBIL</h1>
            <img src="./assets/img/police-car.png" alt="Mobil Polisi">
            <p>Silakan gunakan aplikasi ini untuk meminjam </br> mobil dinas polisi dengan mudah dan cepat.</p>
        </div>
    </div>
    <div id="daftar-mobil">
        <div class="kategori-mobil d-flex justify-content-between items-center">
            <?php foreach ($kategori as $kat) : ?>
            <div>
                <a href="#" class="kategori-item" onclick="filterByCategory('<?= $kat['kategori'] ?>')">
                    <?= ucfirst($kat['kategori']) ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div id="daftar-mobil" class="daftar-mobil">
            <div class="row" id="mobil-list">
                <?php foreach ($kendaraan as $mobil) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="judul"><?= $mobil['nama'] ?></h5>
                        <p class="sub-judul">Plat Nomor: <?= $mobil['plat_no'] ?></p>
                        <img src="<?= base_url('assets/img/' . $mobil['image']) ?>" alt="<?= $mobil['nama'] ?>">
                        <p class="status">Status:
                            <span style="color: green">
                                Tersedia
                            </span>
                        </p>
                        <a href="<?= base_url('user/pinjam_mobil/' . $mobil['id']) ?>" class="btn btn-primary 
                            <?= ($mobil['status'] == 'U') ? 'disabled' : ''; ?>">
                            Pinjam
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script>
    function filterByCategory(kategori) {
        let url = "<?= base_url('user/get_by_kategori/') ?>" + kategori;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                let html = "";
                data.forEach(mobil => {
                    html += `
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="judul">${mobil.nama}</h5>
                        <p class="sub-judul">Plat Nomor: ${mobil.plat_no}</p>
                        <img src="<?= base_url('assets/img/') ?>${mobil.image}" alt="${mobil.nama}">
                        <p class="status">Status:
                            <span style="color: green">
                                Tersedia
                            </span>
                        </p>
                        <a href="http://localhost/gps-software/user/pinjam_mobil/${mobil.id}" class="btn btn-primary ${mobil.status == 'U' ? 'disabled' : ''}">
                            Pinjam
                        </a>
                    </div>
                </div>`;
                });
                document.getElementById("mobil-list").innerHTML = html;
            })
            .catch(error => console.error("Error fetching data:", error));
    }
    </script>
</body>

</html>