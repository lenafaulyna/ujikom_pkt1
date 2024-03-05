<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_perpustakaan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $newPassword = md5($_POST['newPassword']); // Hashing password using MD5

    // Update password
    $sql = "UPDATE pengguna SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPassword, $username);

    if ($stmt->execute()) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
