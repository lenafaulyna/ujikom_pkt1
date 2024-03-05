<?php
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

        mysqli_query($kon,"START TRANSACTION");

        $query = mysqli_query($kon, "SELECT max(id_anggota) as kodeTerbesar FROM anggota");
        $data = mysqli_fetch_array($query);
        $id_anggota = $data['kodeTerbesar'];
        $id_anggota++;
        $huruf = "A";
        $kode_anggota = $huruf . sprintf("%03s", $id_anggota);

        $nama_anggota=input($_POST["nama"]);
        $nomor_telp=input($_POST["nomor_telp"]);
        $email=input($_POST["email"]);
        $alamat=input($_POST["alamat"]);
        $username = input($_POST["username"]);
        $password = input(md5($_POST["password"]));
        $status=1;
        $level="Anggota";
        $simpan_anggota=mysqli_query($kon,"insert into anggota (kode_anggota,nama_anggota,no_telp,email) values ('$kode_anggota','$nama_anggota','$nomor_telp','$email')");
        $simpan_pengguna=mysqli_query($kon,"insert into pengguna (kode_pengguna,username,password,status,level) values ('$kode_anggota','$username','$password','$status','$level')");
        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan_anggota) {
            mysqli_query($kon,"COMMIT");
            header("Location:login.php?daftar=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:daftar.php?daftar=gagal");
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
        background: linear-gradient(135deg,  #9195F6, #B7C9F2);
    }

    /* Style untuk efek bayangan */
    .text-shadow {
        text-shadow: 4px 5px 4px rgba(0, 0, 0, 0.4); /* Warna dan intensitas bayangan */
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
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-bold my-3">Registrasi</h3></div>
                                    <div class="card-body">
                                        <?php 
                                            if (isset($_GET['daftar'])) {
                                                if ($_GET['daftar']=='gagal'){
                                                    echo"<div class='alert alert-warning'><strong>Gagal!</strong> Pendaftaran akun gagal. Coba sekali lagi atau hubungi CS!</div>";
                                                }   
                                            }
                                        ?>
                                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="small mb-1">Nama Lengkap</label>
                                                        <input class="form-control py-3" name="nama" type="text" placeholder="Masukan nama lengkap" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1">Nomor Hp</label>
                                                        <input class="form-control py-3" name="nomor_telp" type="number" placeholder="Masukan no hp" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Email</label>
                                                <input class="form-control py-3" type="email" name="email" aria-describedby="emailHelp" placeholder="Masukan email" required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Alamat</label>
                                                <input class="form-control py-3" type="text" name="alamat" placeholder="Masukan alamat" required />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" >Username</label>
                                                        <input class="form-control py-3" name="username" id="username" type="text" placeholder="Masukan username" required />
                                                        <div id="info_username"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1">Password</label>
                                                        <input class="form-control py-3" name="password" type="password" placeholder="Masukan password" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"> <button class="btn btn-primary btn-block" id="submit" type="submit">Submit</button></div>
                                        </form>
                                    </div>
                                       <div class="card-footer text-center">
                                            <div class="small" style="font-weight: bold; font-size: 12px;">
                                         <a href="login.php">Sudah memiliki akun? Login sekarang!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            </div>
        </div>
        <script src="../src/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="../src/plugin/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../src/js/scripts.js"></script>
    </body>
</html>


<script>

    //Untuk cek ketersediaan username
    $("#username").bind('keyup', function () {

        var username = $('#username').val();

        $.ajax({
            url: 'anggota/cek-username.php',
            method: 'POST',
            data:{username:username},
            success:function(data){
                $('#info_username').show();
                $('#info_username').html(data);
            }
        }); 

    });
</script>