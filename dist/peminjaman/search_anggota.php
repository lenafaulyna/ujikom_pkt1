<?php
// Sambungkan ke database
include '../config/database.php';

// Ambil data yang dikirim dari input pencarian
$query = $_GET['term'];

// Query pencarian anggota berdasarkan informasi dari tabel peminjaman
$sql = "SELECT DISTINCT nama_anggota FROM peminjaman 
        INNER JOIN anggota ON peminjaman.kode_anggota = anggota.kode_anggota 
        WHERE anggota.nama_anggota LIKE '%".$query."%'";

$result = mysqli_query($kon, $sql);

// Simpan hasil pencarian dalam array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row['nama_anggota']);
}

// Mengembalikan hasil pencarian dalam format JSON
echo json_encode($data);
?>
