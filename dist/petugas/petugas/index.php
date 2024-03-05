<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Petugas Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Load DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add your custom styles -->
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px 15px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-tambah {
            float: right;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .btn-circle {
            border-radius: 50%;
            padding: 5px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Data Petugas Perpustakaan</h1>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <button class="btn-tambah btn btn-dark btn-icon-split"><span class="text">Tambah</span></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel_petugas">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi tabel dengan data petugas dari database -->
                            <?php
                            // include database
                            $host="localhost";
                            $user="root";
                            $password="";
                            $db="db_perpustakaan";
                            $kon = mysqli_connect($host,$user,$password,$db);
                            if (!$kon){
                                  die("Koneksi gagal:".mysqli_connect_error());
                            }
                            $sql="select * from petugas";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                         <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama_lengkap']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['no_hp']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td>
                                <button class="setting-akun btn btn-primary btn-circle" kode_petugas="<?php echo $data['kode_petugas']; ?>" ><i class="fas fa-user"></i></button>
                                <button class="btn-edit btn btn-warning btn-circle" id_petugas="<?php echo $data['id_petugas']; ?>" kode_petugas="<?php echo $data['kode_petugas']; ?>" ><i class="fas fa-edit"></i></button>
                                <a href="petugas/hapus.php?id_petugas=<?php echo $data['id_petugas']; ?>&kode_petugas=<?php echo $data['kode_petugas']; ?>" class="btn-hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

                            <script>
                            // Loop untuk menampilkan data petugas
                            
                            // Tambah petugas
                            $('.btn-tambah').on('click', function() {
                                // Anda perlu menambahkan logika untuk membuka modal tambah petugas di sini
                            });
                    
                            // Fungsi edit petugas
                            // Anda perlu menambahkan logika untuk edit petugas di sini
                    
                            // Fungsi setting akun petugas
                            // Anda perlu menambahkan logika untuk setting akun petugas di sini
                    
                            // Fungsi hapus petugas
                            // Anda perlu menambahkan logika untuk hapus petugas di sini
                        </script>
                    </body>
                    </html>
