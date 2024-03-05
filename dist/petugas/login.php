<?php
session_start(); // Mulai sesi

// Jika petugas sudah login, redirect ke halaman dashboard
if (isset($_SESSION['id_petugas'])) {
    header("Location: petugas/dashboard.php");
    exit;
}

// Cek apakah terdapat kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../config/database.php"; // Sertakan file konfigurasi database

    // Fungsi untuk membersihkan dan memvalidasi input
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ambil data yang dikirimkan melalui form
    $username = input($_POST["username"]);
    $password = input(md5($_POST["password"])); // Menggunakan md5 untuk mengenkripsi password

    // Query untuk melakukan pengecekan login petugas
    $query = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
    $result = mysqli_query($kon, $query);

    // Jika query berhasil dieksekusi
    if ($result) {
        // Ambil jumlah baris yang ditemukan
        $count = mysqli_num_rows($result);

        // Jika jumlah baris yang ditemukan lebih dari 0, berarti login sukses
        if ($count > 0) {
            // Ambil data petugas
            $row = mysqli_fetch_assoc($result);

            // Simpan data petugas ke dalam session
            $_SESSION["id_petugas"] = $row["id_petugas"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["nama_lengkap"] = $row["nama_lengkap"];
            $_SESSION["level"] = "petugas"; // Tambahkan level petugas ke dalam session

            // Redirect ke halaman dashboard petugas
            header("Location: petugas/dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Terjadi kesalahan. Silakan coba lagi.";
    }
}
?>
