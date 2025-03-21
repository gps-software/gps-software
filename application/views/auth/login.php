<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pinjam Pakai Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #0033A0, #00AEEF);
        font-family: 'Poppins', sans-serif;
        color: white;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
    }

    .login-container {
        width: 70%;
        max-width: 900px;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .login-form {
        flex: 1;
        padding: 20px;
    }

    .illustration {
        flex: 1;
        max-width: 400px;
        text-align: center;
    }

    .illustration img {
        width: 100%;
        max-width: 350px;
    }

    .btn-primary {
        background-color: #0033A0;
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #002277;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    .forgot-password {
        font-size: 14px;
        color: #0033A0;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .form-control:focus {
        border-color: #0033A0;
        box-shadow: 0 0 8px rgba(0, 51, 160, 0.2);
    }

    .login-container {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
            text-align: center;
        }

        .illustration {
            margin-bottom: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Ilustrasi -->
        <div class="illustration">
            <img src="./assets/img/mobil.jpg" alt="Pinjam Kendaraan">
        </div>

        <!-- Form Login -->
        <div class="login-form">
            <div class="text-center">
                <h4 class="mb-3">Pinjam Pakai Kendaraan</h4>
                <p class="text-muted">Masuk untuk meminjam kendaraan dengan mudah dan cepat</p>
            </div>
            <form action="<?= base_url('auth/aksi_login'); ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
                    <a href="register" class="forgot-password">Belum punya akun? Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>