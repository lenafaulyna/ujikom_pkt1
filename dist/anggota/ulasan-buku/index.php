<?php
// Membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$db = "db_perpustakaan";

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) {
    die("Koneksi gagal:" . mysqli_connect_error());
}

// Memproses form ulasan buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_pustaka = $_POST['judul']; // Ubah judul_pustaka menjadi judul
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    // Menyimpan ulasan buku ke dalam database
    $sql = "INSERT INTO ulasan_buku (judul_pustaka, ulasan, rating) VALUES ('$judul_pustaka', '$ulasan', '$rating')";

    if (mysqli_query($kon, $sql)) {
        echo "<script>alert('Ulasan berhasil dikirim!'); window.location.href = 'http://localhost/ujikom_pkt1/dist/index.php?page=dashboard';</script>";
        exit; // Penting untuk menghentikan eksekusi skrip setelah mengarahkan pengguna
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($kon);
    }
}

mysqli_close($kon);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Buku</title>
    <!-- CSS Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .book {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .title {
            color: #333;
            margin-top: 0;
        }

        .review {
            margin-top: 15px;
        }

        .description {
            color: #666;
            line-height: 1.6;
        }

        .rating {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .stars {
            color: #f1c40f;
            font-size: 24px;
        }

        .score {
            margin-left: 10px;
            font-size: 18px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            background-color: #3468C0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #525CEB;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol kembali -->
        <a href="http://localhost/ujikom_pkt1/dist/index.php?page=dashboard" class="btn btn-primary back-button">Kembali ke Dashboard</a>
        <!-- Form untuk menambahkan ulasan buku -->
        <form action="" method="post">
            <label for="judul">Judul Pustaka:</label>
            <input type="text" id="judul" name="judul" required> <!-- Ganti nama menjadi "judul" -->

            <label for="ulasan">Ulasan:</label>
            <textarea id="ulasan" name="ulasan" rows="4" required></textarea>

            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <input type="submit" value="Kirim Ulasan">
        </form>

    </div>
</body>
</html>