<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php $this->load->view('style/style')?>
    <?php $this->load->view('style/script')?>
    <style>
    .password-toggle {
        position: relative;
    }

    .password-toggle input {
        padding-right: 40px;
    }

    .password-toggle .toggle-icon {
        font-size: 18px;
        position: absolute;
        right: 30px;
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('components/sidebar') ?>
        <div class="main-panel">
            <?php $this->load->view('components/navbar') ?>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Profile</h3>
                        </div>
                    </div>
                    <div class="row row-card-no-pd">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php if ($this->session->flashdata('errors')) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('errors'); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($this->session->flashdata('message')) : ?>
                                    <div class="alert alert-success">
                                        <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo base_url('dashboard/updateProfile'); ?>"
                                        class="row g-3">
                                        <div class="col-6">
                                            <label for="username" class="form-label fw-bold">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="<?php echo $user['username']; ?>" required>
                                        </div>

                                        <div class="col-6 mb-4">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="<?php echo $user['email']; ?>" required>
                                        </div>
                                        <hr>

                                        <div class="col-12 password-toggle">
                                            <label for="new_password" class="form-label fw-bold">Password Baru</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password"
                                                placeholder="Gunakan password yang tidak mudah diketahui">
                                            <i class="toggle-icon fas fa-eye"
                                                onclick="togglePassword('new_password')"></i>
                                        </div>

                                        <div class="col-12 mt-4 password-toggle">
                                            <label for="confirm_new_password" class="form-label fw-bold">Konfirmasi
                                                Password Baru</label>
                                            <input type="password" class="form-control" id="confirm_new_password"
                                                name="confirm_new_password" placeholder="Konfirmasi password baru">
                                            <i class="toggle-icon fas fa-eye"
                                                onclick="togglePassword('confirm_new_password')"></i>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

    <script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.parentElement.querySelector('.toggle-icon');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
</body>

</html>