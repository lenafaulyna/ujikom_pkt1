<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #dddddd;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th, td, button {
            font-size: 16px;
        }

        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c82333;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <h1>Daftar Peminjaman Buku</h1>
    <table id="peminjamanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Peminjaman</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $host="localhost";
                $user="root";
                $password="";
                $db="db_perpustakaan";
                
                $kon = mysqli_connect($host,$user,$password,$db);
                if (!$kon){
                      die("Koneksi gagal:".mysqli_connect_error());
                }

                // Query untuk mengambil data peminjaman buku
                $sql = "SELECT * FROM peminjaman";
                $result = $kon->query($sql);

                // Tampilkan data peminjaman buku dalam tabel
                if ($result->num_rows > 0) {
                    $count = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$count."</td>";
                        echo "<td>".$row['kode_peminjaman']."</td>";
                        echo "<td>".$row['tanggal']."</td>";
                        echo "<td class='action-buttons'>";
                        echo "<button onclick='editRow(this)'>Edit</button>";
                        echo "<button onclick='deleteRow(this)'>Hapus</button>";
                        echo "</td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data peminjaman buku</td></tr>";
                }
                $kon->close();
            ?>
        </tbody>
    </table>

    <script>
        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            // Di sini Anda bisa tambahkan logika untuk menghapus data dari database
        }

        function editRow(btn) {
            // Di sini Anda bisa tambahkan logika untuk mengedit data
            alert('Anda dapat menambahkan logika untuk mengedit data di sini');
        }
    </script>
</body>
</html>
