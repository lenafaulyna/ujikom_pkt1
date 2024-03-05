<?php
// Pastikan session telah dimulai
session_start();

// Periksa apakah session level telah di-set sebelumnya
$level = isset($_SESSION['petugas']) ? $_SESSION['petugas'] : '';

// Sambungkan ke database
$host = "localhost";
$user = "root";
$password = "";
$db = "db_perpustakaan";

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) {
    die("Koneksi gagal:" . mysqli_connect_error());
}
// Sekarang kita dapat menjalankan kueri ke database
$hasil = mysqli_query($kon, "select nama_aplikasi from profil_aplikasi order by nama_aplikasi desc limit 1");
$data = mysqli_fetch_array($hasil);

// Tutup koneksi database
mysqli_close($kon);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #9195F6, #B7C9F2);
        }

        .container {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .row .col {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><?php  echo $data['nama_aplikasi'];?></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
             
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=profil">Profil</a>
                        <a class="dropdown-item" href="http://localhost/ujikom_pkt1/dist/login.php"  data-toggle="modal" data-target="#logoutModal" >Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <?php 
                        if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Petugas' || $_SESSION['level'] == 'petugas')):
                    ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php?page=dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="index.php?page=daftar-peminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
                                Peminjaman
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?page=laporan-peminjaman"><i class="fas fa-book"></i>  &nbsp; Peminjaman</a>
                                    <a class="nav-link" href="index.php?page=laporan-pustaka"><i class="fas fa-grip-horizontal"></i> &nbsp; Pustaka</a>
                                    <a class="nav-link" href="index.php?page=laporan-anggota"><i class="fas fa-user-tag"></i> &nbsp; Anggota</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePustaka" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Pustaka
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePustaka" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?page=kategori"><i class="fas fa-grip-horizontal"></i> &nbsp; Kategori</a>
                                    <a class="nav-link" href="index.php?page=penulis"><i class="fas fa-user-tag"></i> &nbsp; Penulis</a>
                                    <a class="nav-link" href="index.php?page=penerbit"><i class="fas fa-building"></i> &nbsp; Penerbit</a>
                                    <a class="nav-link" href="index.php?page=pustaka"><i class="fas fa-book"></i>  &nbsp; Pustaka</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="karyawan/ulasan-buku/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                                Ulasan Buku
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pengguna
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePengguna" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?page=anggota"><i class="fas fa-user"></i>  &nbsp; Anggota</a>
                                    <a class="nav-link" href="index.php?page=karyawan"><i class="fas fa-user-tie"></i> &nbsp; Admin</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Pengaturan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePengaturan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?page=aplikasi"><i class="fas fa-desktop"></i>  &nbsp; Aplikasi</a>
                                </nav>
                            </div>
                        </div>
                        <?php endif; ?>
    <div class="container">
        <h2 class="mt-4">Dashboard Petugas</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <?php
            // Tampilkan menu logout jika petugas sudah login
            if (!empty($level)) {
                echo '<li class="breadcrumb-item"><a href="logout.php">Logout</a></li>';
            }
            ?>
        </ol>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <div class="text-xs text-white text-uppercase mb-1">Total Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800">7</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <div class="text-xs text-white text-uppercase mb-1">Jumlah Anggota</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800">4</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="text-xs text-white text-uppercase mb-1">Jumlah Pustaka</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800">10</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <div class="text-xs text-white text-uppercase mb-1">Total Denda</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800">Rp. 0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Total Peminjaman Tahun 2024
                    </div>
                    <div class="card-body">
                        <canvas id="chart1" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Jumlah Peminjaman Berdasarkan Kategori
                    </div>
                    <div class="card-body">
                        <canvas id="chart2" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample data for charts (replace with actual data)
        var data1 = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Total Borrowings",
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: "rgb(75, 192, 192)",
                borderWidth: 1
            }]
        };

        var data2 = {
            labels: ["Fiction", "Non-fiction", "Science", "History", "Biography"],
            datasets: [{
                label: "Borrowings by Category",
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Render charts
        var ctx1 = document.getElementById('chart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'line',
            data: data1,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('chart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
