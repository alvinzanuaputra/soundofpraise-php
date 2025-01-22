<?php
session_start();

// Menghapus data sesi pengguna
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
