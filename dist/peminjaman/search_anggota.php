<?php
// Include file konfigurasi database
include '../config/database.php';

// Tangkap inputan dari AJAX
$query = $_POST['query'];

// Query pencarian anggota berdasarkan nama
$sql = "SELECT * FROM anggota WHERE nama_anggota LIKE '%$query%'";
$result = mysqli_query($kon, $sql);

// Membuat daftar hasil pencarian
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="#" class="list-group-item list-group-item-action">' . $row['nama_anggota'] . '</a>';
    }
} else {
    echo '<p class="list-group-item">Tidak ditemukan anggota dengan nama tersebut.</p>';
}
?>
