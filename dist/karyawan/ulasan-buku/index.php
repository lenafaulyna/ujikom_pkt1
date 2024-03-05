<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Buku</title>
    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <style>
    /* Gaya tambahan untuk tabel */
    .container {
        padding: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #9195F6;
        color: #fff; /* Ubah warna teks menjadi putih */
        font-weight: bold;
    }
    tr:hover {
        background-color: #f2f2f2; /* Ubah warna latar belakang saat dihover */
    }
    .back-button {
        margin-top: 20px;
    }
    </style>

</head>
<body>
    <div class="container">
        <h2 class="mt-4">Ulasan Buku</h2>
        <table id="tabel_ulasan_buku" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Judul Pustaka</th>
                    <th>Ulasan</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Sambungkan ke database
            $host = "localhost";
            $user = "root";
            $password = "";
            $db = "db_perpustakaan";

            $kon = mysqli_connect($host, $user, $password, $db);
            if (!$kon) {
                die("Koneksi gagal:" . mysqli_connect_error());
            }

            // Pastikan koneksi berhasil
            if ($kon) {
                // Query untuk mengambil data ulasan buku
                $query = "SELECT * FROM ulasan_buku ORDER BY ulasan_id DESC";
                $result = mysqli_query($kon, $query);

                if ($result) {
                    // Tampilkan data ulasan buku dalam bentuk baris tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['judul_pustaka'] . "</td>";
                        echo "<td>" . $row['ulasan'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "</tr>";
                    }

                    // Bebaskan memori dari hasil query
                    mysqli_free_result($result);
                } else {
                    echo "Query gagal dieksekusi: " . mysqli_error($kon);
                }

                // Tutup koneksi ke database
                mysqli_close($kon);
            } else {
                echo "Koneksi ke database gagal.";
            }
            ?>
            </tbody>
        </table>

        <!-- Tombol kembali -->
        <a href="http://localhost/ujikom_pkt1/dist/index.php?page=dashboard" class="btn btn-primary back-button">Kembali ke Dashboard</a>
    </div>

    <!-- Link jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Link DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#tabel_ulasan_buku').DataTable();
        });
    </script>
</body>
</html>
