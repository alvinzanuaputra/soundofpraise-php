<?php
session_start();
require 'db.php'; // Koneksi ke database menggunakan PDO

// Ambil data dari form
$name = htmlspecialchars($_POST['name']);
$church = htmlspecialchars($_POST['church']);

try {
    // Query untuk memeriksa apakah pengguna terdaftar
    $sql = "SELECT * FROM users WHERE name = :name AND church = :church";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':church', $church);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Pengguna ditemukan, login berhasil
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login_success'] = true;
        header('Location: dashboard.php'); // Redirect ke dashboard
        exit();
    } else {
        // Pengguna tidak ditemukan, login gagal
        $_SESSION['login_error'] = "Username atau Gereja tidak sesuai.";
        header('Location: login.php'); // Redirect kembali ke login
        exit();
    }
} catch (PDOException $e) {
    // Error dalam query
    $_SESSION['login_error'] = "Terjadi kesalahan saat login: " . $e->getMessage();
    header('Location: login.php');
    exit();
}
?>
