<?php
    session_start();
    $id_petugas=$_SESSION['id_petugas'];
    $_SESSION['id_petugas']='';
    $_SESSION['kode_petugas']='';
    $_SESSION['nama_lengkap']='';
    $_SESSION['username']='';
    $_SESSION['level']='';

    unset($_SESSION['id_petugas']);
    unset($_SESSION['kode_petugas']);
    unset($_SESSION['nama_lengkap']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);

    session_unset();
    session_destroy();

    echo "<script>window.location.href = 'http://localhost/ujikom_pkt1/dist/login.php';</script>";
    exit();
?>