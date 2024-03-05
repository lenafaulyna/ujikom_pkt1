<?php
session_start();
    //Koneksi database
    include '../../config/database.php';
    //Memulai karyawan
    mysqli_query($kon,"START TRANSACTION");

    $id_karyawan=$_GET['id_karyawan'];
    $kode_karyawan=$_GET['kode_karyawan'];

  // Menghapus data dalam tabel karyawan
$hapus_karyawan = false;
if ($id_karyawan != 46) { // Pastikan bukan ID admin karyawan
    $hapus_karyawan = mysqli_query($kon, "DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'");
}

// Menghapus data dalam tabel pengguna
$hapus_pengguna = false;
if ($kode_karyawan != 'KO44') { // Pastikan bukan kode admin pengguna
    $hapus_pengguna = mysqli_query($kon, "DELETE FROM pengguna WHERE kode_pengguna='$kode_karyawan'");
}

// Periksa apakah kedua penghapusan berhasil dilakukan
if ($hapus_karyawan && $hapus_pengguna) {
    mysqli_query($kon, "COMMIT");
    header("Location:../../dist/index.php?page=karyawan&hapus=berhasil");
} else {
    mysqli_query($kon, "ROLLBACK");
    $pesan_error = "Gagal menghapus admin. Admin tidak dapat dihapus.";
    header("Location:../../dist/index.php?page=karyawan&hapus=gagal");
}

?>