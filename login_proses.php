<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soundofpraise-php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$church = $_POST['church'];

// Query untuk memeriksa apakah pengguna terdaftar
$sql = "SELECT * FROM users WHERE name = ? AND church = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $church);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Pengguna ditemukan, login berhasil
    $_SESSION['user'] = $result->fetch_assoc();
    $_SESSION['login_success'] = true; // Set session login success
    header('Location: dashboard.php'); // Kembali ke halaman login untuk menampilkan toast
    exit();
} else {
    // Pengguna tidak ditemukan, login gagal
    $_SESSION['login_error'] = "Username atau Gereja tidak sesuai."; // Set pesan error
    header('Location: login.php'); // Kembali ke halaman login
    exit();
}

// $conn->close();
?>