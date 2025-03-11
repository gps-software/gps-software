<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                        </div>
                    </div>
                    <div class="row row-card-no-pd">
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6><b>Jumlah Kendaraan Tersedia</b></h6>
                                        </div>
                                        <h4 class="text-info fw-bold">170</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6><b>Jumlah Kendaraan Sedang Dipinjam</b></h6>
                                        </div>
                                        <h4 class="text-success fw-bold">120</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6><b>Jumlah Mobil Dalam Perbaikan</b></h6>
                                        </div>
                                        <h4 class="text-danger fw-bold">15</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6><b>Jumlah Peminjam</b></h6>
                                        </div>
                                        <h4 class="text-secondary fw-bold">12</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">User Statistics</div>
                                        <!-- <div class="card-tools">
                                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-pencil"></i>
                                                </span>
                                                Export
                                            </a>
                                            <a href="#" class="btn btn-label-info btn-round btn-sm">
                                                <span class="btn-label">
                                                    <i class="fa fa-print"></i>
                                                </span>
                                                Print
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="statisticsChart"></canvas>
                                    </div>
                                    <div id="myChartLegend"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tabel Peminjaman Kendaraan</div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Jabatan</th>
                                                    <th scope="col">Tipe Kendaraan</th>
                                                    <th scope="col">Tanggal Pinjam</th>
                                                    <th scope="col">Tanggal Kembali</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <td>Budi</td>
                                                    <td>Jendral</td>
                                                    <td>SUV</td>
                                                    <td>2024-03-01</td>
                                                    <td>2024-03-05</td>
                                                    <td class="text-success">Dikembalikan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-card-no-pd">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <h4 class="card-title">Users Geolocation</h4>
                                        <div class="card-tools">
                                            <button class="btn btn-icon btn-link btn-primary btn-xs">
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                                <span class="fa fa-sync-alt"></span>
                                            </button>
                                            <button class="btn btn-icon btn-link btn-primary btn-xs">
                                                <span class="fa fa-times"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="card-category">
                                        Map of the distribution of users around the world
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsive table-hover table-sales">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/id.png"
                                                                        alt="indonesia" />
                                                                </div>
                                                            </td>
                                                            <td>Indonesia</td>
                                                            <td class="text-end">2.320</td>
                                                            <td class="text-end">42.18%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/us.png"
                                                                        alt="united states" />
                                                                </div>
                                                            </td>
                                                            <td>USA</td>
                                                            <td class="text-end">240</td>
                                                            <td class="text-end">4.36%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/au.png"
                                                                        alt="australia" />
                                                                </div>
                                                            </td>
                                                            <td>Australia</td>
                                                            <td class="text-end">119</td>
                                                            <td class="text-end">2.16%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/ru.png" alt="russia" />
                                                                </div>
                                                            </td>
                                                            <td>Russia</td>
                                                            <td class="text-end">1.081</td>
                                                            <td class="text-end">19.65%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/cn.png" alt="china" />
                                                                </div>
                                                            </td>
                                                            <td>China</td>
                                                            <td class="text-end">1.100</td>
                                                            <td class="text-end">20%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    <img src="assets/img/flags/br.png" alt="brazil" />
                                                                </div>
                                                            </td>
                                                            <td>Brasil</td>
                                                            <td class="text-end">640</td>
                                                            <td class="text-end">11.63%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mapcontainer">
                                                <div id="world-map" class="w-100" style="height: 300px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <div class="card-title">Recent Activity</div>
                                        <div class="card-tools">
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-clean" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ol class="activity-feed">
                                        <li class="feed-item feed-item-secondary">
                                            <time class="date" datetime="9-25">Sep 25</time>
                                            <span class="text">Responded to need
                                                <a href="#">"Volunteer opportunity"</a></span>
                                        </li>
                                        <li class="feed-item feed-item-success">
                                            <time class="date" datetime="9-24">Sep 24</time>
                                            <span class="text">Added an interest
                                                <a href="#">"Volunteer Activities"</a></span>
                                        </li>
                                        <li class="feed-item feed-item-info">
                                            <time class="date" datetime="9-23">Sep 23</time>
                                            <span class="text">Joined the group
                                                <a href="single-group.php">"Boardsmanship Forum"</a></span>
                                        </li>
                                        <li class="feed-item feed-item-warning">
                                            <time class="date" datetime="9-21">Sep 21</time>
                                            <span class="text">Responded to need
                                                <a href="#">"In-Kind Opportunity"</a></span>
                                        </li>
                                        <li class="feed-item feed-item-danger">
                                            <time class="date" datetime="9-18">Sep 18</time>
                                            <span class="text">Created need
                                                <a href="#">"Volunteer Opportunity"</a></span>
                                        </li>
                                        <li class="feed-item">
                                            <time class="date" datetime="9-17">Sep 17</time>
                                            <span class="text">Attending the event
                                                <a href="single-event.php">"Some New Event"</a></span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Support Tickets</div>
                                        <div class="card-tools">
                                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm"
                                                id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-today" data-bs-toggle="pill"
                                                        href="#pills-today" role="tab" aria-selected="true">Today</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-week" data-bs-toggle="pill"
                                                        href="#pills-week" role="tab" aria-selected="false">Week</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-month" data-bs-toggle="pill"
                                                        href="#pills-month" role="tab" aria-selected="false">Month</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-online">
                                            <span
                                                class="avatar-title rounded-circle border border-white bg-info">J</span>
                                        </div>
                                        <div class="flex-1 ms-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">
                                                Joko Subianto
                                                <span class="text-warning ps-3">pending</span>
                                            </h6>
                                            <span class="text-muted">I am facing some trouble with my viewport. When i
                                                start my</span>
                                        </div>
                                        <div class="float-end pt-1">
                                            <small class="text-muted">8:40 PM</small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-offline">
                                            <span
                                                class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                        </div>
                                        <div class="flex-1 ms-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">
                                                Prabowo Widodo
                                                <span class="text-success ps-3">open</span>
                                            </h6>
                                            <span class="text-muted">I have some query regarding the license
                                                issue.</span>
                                        </div>
                                        <div class="float-end pt-1">
                                            <small class="text-muted">1 Day Ago</small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-away">
                                            <span
                                                class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                        </div>
                                        <div class="flex-1 ms-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">
                                                Lee Chong Wei
                                                <span class="text-muted ps-3">closed</span>
                                            </h6>
                                            <span class="text-muted">Is there any update plan for RTL version near
                                                future?</span>
                                        </div>
                                        <div class="float-end pt-1">
                                            <small class="text-muted">2 Days Ago</small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-offline">
                                            <span
                                                class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                        </div>
                                        <div class="flex-1 ms-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">
                                                Peter Parker
                                                <span class="text-success ps-3">open</span>
                                            </h6>
                                            <span class="text-muted">I have some query regarding the license
                                                issue.</span>
                                        </div>
                                        <div class="float-end pt-1">
                                            <small class="text-muted">2 Day Ago</small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-away">
                                            <span
                                                class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                        </div>
                                        <div class="flex-1 ms-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">
                                                Logan Paul <span class="text-muted ps-3">closed</span>
                                            </h6>
                                            <span class="text-muted">Is there any update plan for RTL version near
                                                future?</span>
                                        </div>
                                        <div class="float-end pt-1">
                                            <small class="text-muted">2 Days Ago</small>
                                        </div>
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

</html>