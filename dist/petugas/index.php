<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="db_perpustakaan";
    
    $kon = mysqli_connect($host,$user,$password,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }

// Query untuk mendapatkan nilai variabel
            $sql_total_peminjaman = "SELECT COUNT(*) AS total_peminjaman FROM detail_peminjaman";
            $result_total_peminjaman = mysqli_query($kon, $sql_total_peminjaman);
            $data_total_peminjaman = mysqli_fetch_assoc($result_total_peminjaman);
            $total_peminjaman = $data_total_peminjaman['total_peminjaman'];

            $sql_jumlah_anggota = "SELECT COUNT(*) AS jumlah_anggota FROM anggota";
            $result_jumlah_anggota = mysqli_query($kon, $sql_jumlah_anggota);
            $data_jumlah_anggota = mysqli_fetch_assoc($result_jumlah_anggota);
            $jumlah_anggota = $data_jumlah_anggota['jumlah_anggota'];

            $sql_jumlah_pustaka = "SELECT COUNT(*) AS jumlah_pustaka FROM pustaka";
            $result_jumlah_pustaka = mysqli_query($kon, $sql_jumlah_pustaka);
            $data_jumlah_pustaka = mysqli_fetch_assoc($result_jumlah_pustaka);
            $jumlah_pustaka = $data_jumlah_pustaka['jumlah_pustaka'];

            $sql_total_denda = "SELECT SUM(denda) AS total_denda FROM detail_peminjaman";
            $result_total_denda = mysqli_query($kon, $sql_total_denda);
            $data_total_denda = mysqli_fetch_assoc($result_total_denda);
            $total_denda = $data_total_denda['total_denda'];

            // Tutup koneksi
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
            background: linear-gradient(135deg, #98ABEE, #535C91);
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding-top: 48px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #343a40;
            width: 250px;
            overflow-y: auto;
            color: #fff;
            height: 100%; /* Set height to fill the entire viewport */
        }

        .sidebar-sticky {
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #fff;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: #007bff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
            border: none;
            background-color: #fff;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }

        /* Adjust content area to accommodate sidebar */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }
        }

        .submenu {
            display: none;
        }

        .nav-item:hover .submenu {
            display: block;
            position: absolute;
            background-color: #343a40;
            padding: 10px;
            z-index: 1000;
        }

        .submenu li {
            list-style-type: none;
        }

        .submenu a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
        }

        .submenu a:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>ESEMKA LIBRARY</h3>
        </div>
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="http://localhost/ujikom_pkt1/dist/petugas/index.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="peminjaman">
                        <i class="fas fa-list-ol"></i> Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="laporan">
                        <i class="fas fa-file-alt"></i> Laporan <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="laporan/peminjaman">Peminjaman</a></li>
                        <li><a href="laporan/pustaka">Pustaka</a></li>
                        <li><a href="laporan/anggota">Anggota</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pustaka">
                        <i class="fas fa-book"></i> Pustaka <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="pustaka/kategori">Kategori</a></li>
                        <li><a href="pustaka/penulis">Penulis</a></li>
                        <li><a href="pustaka/penerbit">Penerbit</a></li>
                        <li><a href="pustaka">Pustaka</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ulasan-buku">
                        <i class="fas fa-comment"></i> Ulasan Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="petugas">
                        <i class="fas fa-user-tie"></i> Data Petugas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="anggota">
                        <i class="fas fa-users"></i> Data Anggota
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <button class="btn btn-outline-danger btn-block" onclick="logout()" type="button">Logout <i class="fas fa-sign-out-alt"></i></button>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="content">
        <div class="container-fluid">
            <h2 class="mt-4">Dashboard</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <!-- Tampilkan menu logout jika petugas sudah login -->
                <!-- Jika ingin menambahkan logout, tambahkan <li> di sini -->
            </ol>
            <?php
    $host="localhost";
    $user="root";
    $password="";
    $db="db_perpustakaan";
    
    $kon = mysqli_connect($host,$user,$password,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }
    // Periksa koneksi
if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Query untuk mengambil total denda
$sql = "SELECT SUM(denda) AS total_denda FROM detail_peminjaman";
$hasil = mysqli_query($kon, $sql);

// Periksa apakah query berhasil dieksekusi
if (!$hasil) {
    die("Error dalam query: " . mysqli_error($kon));
}

// 3. Ambil data dari hasil query
$data = mysqli_fetch_array($hasil);

// Tutup koneksi
mysqli_close($kon);
?>
           <div class="row">
    <!-- Kotak Total Peminjaman -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-white text-uppercase mb-1">Total Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800"><?php echo $total_peminjaman;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-grip-horizontal fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kotak Jumlah Anggota -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-white text-uppercase mb-1">Jumlah Anggota</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800"><?php echo $jumlah_anggota;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kotak Jumlah Pustaka -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-white text-uppercase mb-1">Jumlah Pustaka</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800"><?php echo $jumlah_pustaka;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kotak Total Denda -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-white text-uppercase mb-1">Total Denda</div>
                        <div class="h5 mb-0 font-weight-bold text-dark-800">Rp. <?php echo number_format($data['total_denda'], 0, ',', '.'); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-dark-300"></i>
                    </div>
                </div>
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
    </main>

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
            labels: ["Novel", "Pendidikan", "Komik", "Sejarah", "Bisnis"],
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

        function logout() {
            // Redirect to logout.php or any logout URL
            window.location.href = "http://localhost/ujikom_pkt1/dist/login.php";
        }
    </script>
</body>
</html>
