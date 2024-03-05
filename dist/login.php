<?php
    $pesan="";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    include "../config/database.php";
    $username = input($_POST["username"]);
    $password = input(md5($_POST["password"]));

    // Query untuk memasukkan data petugas ke dalam tabel petugas
$query_insert_petugas = "INSERT INTO petugas (kode_petugas, username, password, email, nama_lengkap, no_hp, alamat) 
VALUES ('$kode_petugas', '$username', '$password', '$email', '$nama_lengkap', '$no_hp', '$alamat')";

// Eksekusi query untuk memasukkan data petugas
$result_insert_petugas = mysqli_query($kon, $query_insert_petugas);

// Periksa apakah proses penyisipan data petugas berhasil
if ($result_insert_petugas) {
// Jika berhasil, lanjutkan proses login atau tindakan lain yang diinginkan
// Misalnya, arahkan pengguna ke halaman dashboard atau lakukan sesuatu yang diperlukan.
header("Location: petugas/index.php");
echo "Data petugas berhasil disimpan.";
} else {
// Jika gagal, tampilkan pesan kesalahan atau lakukan penanganan kesalahan yang sesuai.
echo "Gagal menyimpan data petugas: " . mysqli_error($kon);
}


     //Query untuk cek pada tabel pengguna yang dijoinkan dengan tabel karyawan
     $tabel_karyawan= "select * from pengguna p
     inner join karyawan k on k.kode_karyawan=p.kode_pengguna
     where username='".$username."' and password='".$password."' limit 1";

     $cek_tabel_karyawan = mysqli_query ($kon,$tabel_karyawan);
     $karyawan = mysqli_num_rows($cek_tabel_karyawan);

    //Query untuk cek pada tabel pengguna yang dijoinkan dengan tabel anggota
    $tabel_anggota= "select * from pengguna p
    inner join anggota m on m.kode_anggota=p.kode_pengguna
    where username='".$username."' and password='".$password."' limit 1";

    $cek_tabel_anggota = mysqli_query ($kon,$tabel_anggota);
    $anggota = mysqli_num_rows($cek_tabel_anggota);

    if ($karyawan>0){

        $row = mysqli_fetch_assoc($cek_tabel_karyawan);

        if ($row["status"]==1){
            
            //menyimpan data karyawan dalam session
            $_SESSION["id_pengguna"]=$row["id_pengguna"];
            $_SESSION["kode_pengguna"]=$row["kode_pengguna"];
            $_SESSION["nama_karyawan"]=$row["nama_karyawan"];
            $_SESSION["username"]=$row["username"];
            $_SESSION["level"]=$row["level"];
            $_SESSION["foto"]=$row["foto"];
            $_SESSION["nip"]=$row["nip"];

            header("Location:index.php?page=dashboard");

        }else {
            $pesan="<div class='alert alert-warning'><strong>Gagal!</strong> Status pengguna tidak aktif.</div>";
        }

    } else if ($anggota>0){

        $row = mysqli_fetch_assoc($cek_tabel_anggota);

        if ($row["status"]==1){
            
            //menyimpan data Anggota dalam session
            $_SESSION["id_pengguna"]=$row["id_pengguna"];
            $_SESSION["kode_pengguna"]=$row["kode_pengguna"];
            $_SESSION["nama_anggota"]=$row["nama_anggota"];
            $_SESSION["username"]=$row["username"];
            $_SESSION["level"]=$row["level"];
            $_SESSION["foto"]=$row["foto"];
     
            header("Location:index.php?page=dashboard");

        }else {
            $pesan="<div class='alert alert-warning'><strong>Gagal!</strong> Status pengguna tidak aktif.</div>";
        }

    }else {
            $pesan="<div class='alert alert-danger'><strong>Error!</strong> Username dan password salah.</div>";
        }
    }
?>
<!DOCTYPE html>
<?php 
    include '../config/database.php';
    $hasil=mysqli_query($kon,"select * from profil_aplikasi order by nama_aplikasi desc limit 1");
    $data = mysqli_fetch_array($hasil); 
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $data['nama_aplikasi'];?></title>
    <link href="../src/templates/css/styles.css" rel="stylesheet" />
    <script src="../src/js/font-awesome/all.min.js" crossorigin="anonymous"></script>

    <style>
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #9195F6, #B7C9F2);
    }

    /* Style untuk efek bayangan */
    .text-shadow {
        text-shadow: 4px 5px 4px rgba(0, 0, 0, 0.3); /* Warna dan intensitas bayangan */
    }

    .box-shadow {
        box-shadow: 30px 30px 10px rgba(0, 0, 0, 0.4); /* Warna dan intensitas bayangan */
    }

    /* Optional: Style untuk card */
    .card {
        background-color: rgba(255, 255, 255, 0.6); /* Warna latar dengan opacity */
        border-radius: 16px; /* Sudut membulat */
    }

    </style>

</head>
<body class="bg-dark">
    <div class="container" style="max-width: 450px;">
        <div class="row justify-content-center">
            <div class="col-lg-11">
            <div class="card shadow-lg border-0 rounded-lg mt-4 box-shadow">
                    <div class="card-body">
                        <center><img src="aplikasi/logo/<?php echo $data['logo'];?>" id="preview" width="22%"></center>
                        <h4 class="text-center font-weight-bold my-3 text-shadow"><?php echo ucwords($data['nama_aplikasi']);?></h4>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $pesan; ?>
                        <?php 
                            if (isset($_GET['daftar'])) {
                                if ($_GET['daftar']=='berhasil'){
                                    echo "<div class='alert alert-success'><strong>Berhasil!</strong> Pendaftaran akun berhasil.</div>";
                                }   
                            }
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <div class="form-group">
                                <label class="small mb-1">Username</label>
                                <input class="form-control py-3" name="username" type="text" placeholder="Masukan Username" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Password</label>
                                <input class="form-control py-3" name="password" type="password" placeholder="Masukan Password" />
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small" style="font-weight: bold; font-size: 12px;">
                            <a href="register.php">Belum mempunyai akun? Daftar sekarang!</a>
                        </div>
                        <div class="small" style="font-weight: bold; font-size: 12px;">
                        <a href="reset_password.php">Lupa password?</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../src/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="../src/plugin/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../src/js/scripts.js"></script>
</body>
</html>
