<!-- <style>
.nav-item.active>a {
    background-color: #007bff;
    color: white;
}
</style> -->
<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="<?php echo base_url('assets/img/logo_car.png') ?>" alt="navbar brand" class="navbar-brand"
                    height="50" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <?php $uri = uri_string(); ?>
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a class="<?= ($uri == 'dashboard') ? 'bg-primary' : '' ?>" href=<?php echo base_url('dashboard')?>
                        class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Tabel</h4>
                </li>

                <li class="nav-item">
                    <a class="<?= ($uri == 'dashboard/daftar_peminjam') ? 'bg-primary' : '' ?>"
                        href="<?= base_url('dashboard/daftar_peminjam') ?>">
                        <i class="fa-solid fa-users"></i>
                        <span class="sub-item">Daftar User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="<?= ($uri == 'dashboard/daftar_kendaraan') ? 'bg-primary' : '' ?>"
                        href="<?= base_url('dashboard/daftar_kendaraan') ?>">
                        <i class="fa-solid fa-car"></i>
                        <span class="sub-item">Daftar Kendaraan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="<?= ($uri == 'dashboard/daftar_req') ? 'bg-primary' : '' ?>"
                        href="<?= base_url('dashboard/daftar_req') ?>">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span class="sub-item">Daftar Request</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tabel</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href=<?php echo base_url('dashboard/daftar_peminjam')?>>
                                    <span class="sub-item">Daftar Peminjam</span>
                                </a>
                                <a href=<?php echo base_url('dashboard/daftar_kendaraan')?>>
                                    <span class="sub-item">Daftar Kendaraan</span>
                                </a>
                                <a href=<?php echo base_url('dashboard/daftar_req')?>>
                                    <span class="sub-item">Daftar Request</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Jsvectormap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>