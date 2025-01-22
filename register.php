<?php
session_start();
require 'db.php'; // Menyertakan file koneksi database

$successMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $church = htmlspecialchars($_POST['church']);

    // Validasi data (opsional, bisa ditambahkan lebih banyak validasi)
    if (empty($name) || empty($church)) {
        $_SESSION['error'] = "Semua bidang harus diisi!";
        header('Location: register.php');
        exit;
    }

    // Simpan data ke database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, church) VALUES (:name, :church)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':church', $church);
        $stmt->execute();

        // Berhasil menyimpan, tampilkan pesan sukses
        $_SESSION['success'] = "Selamat datang, $name.";
        header('Location: register.php');
        exit;
    } catch (PDOException $e) {
        // Gagal menyimpan, tampilkan pesan error
        $_SESSION['error'] = "Gagal mendaftar: " . $e->getMessage();
        header('Location: register.php');
        exit;
    }
}

if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
        /* Animasi Toast */
        .toast {
            position: absolute;
            z-index: 999;
            top: 5%; /* Posisi 5% dari atas */
            left: 50%;
            transform: translateX(-50%) translateY(-100%); /* Mulai dari luar layar */
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            width: calc(100% - 2rem); /* Mengatur lebar untuk margin */
            
            animation: slideDown 0.5s ease-in-out forwards, fadeOut 3s 3s forwards;
        }

        .toast-error {
            background-color: #dc3545; /* Warna merah untuk error */
        }

        @keyframes slideDown {
            from {
                transform: translateX(-50%) translateY(-100%); /* Mulai di atas layar */
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0); /* Posisi akhir di tengah layar */
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center relative" style="background-image: url('img/soundofp.JPG'); background-size: cover;">
    <div class="absolute top-0 left-0 right-0 bottom-0 bg-black opacity-50 z-10"></div>

    <div class="relative max-w-md w-full bg-white bg-opacity-20 p-8 rounded-xl shadow-lg backdrop-filter backdrop-blur-md z-20">
        <div class="text-center mb-6">
            <img src="img/Logo_Youth.png" alt="Logo Youth" class="w-32 h-32 mb-6 mx-auto" />
            <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang</h1>
            <p class="text-lg text-white">Siap berseru bersama Sound Of Praise?</p>
        </div>

        <?php if ($successMessage): ?>
        <div id="success-message" class="toast inline-block">
            <p class="font-bold">Pendaftaran berhasil!</p>
            <p class=""><?php echo $successMessage; ?></p>
        </div>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
        <div id="error-message" class="toast toast-error">
            <p class="font-bold">Pendaftaran Gagal!</p>
            <p><?php echo $errorMessage; ?></p>
        </div>
        <?php endif; ?>

        <form action="register.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-lg text-white">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 bg-transparent border border-white rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300" required />
            </div>

            <div>
                <label for="church" class="block text-lg text-white">Gereja</label>
                <input type="text" id="church" name="church" placeholder="Masukkan nama gereja" class="w-full px-4 py-3 bg-transparent border border-white rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300" required />
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-600 transition-all duration-300">
                Daftar
            </button>
            <p class="text-white flex justify-center">Sudah punya akun? <a class="text-blue-500 underline font-semibold" href="login.php"> Masuk</a></p>
        </form>
    </div>

    <script>
        // Tampilkan Toast sukses atau error dan sembunyikan setelah beberapa detik
        <?php if ($successMessage): ?>
            setTimeout(function() {
                document.querySelector('#success-message').style.display = 'block';
            }, 1000); // Tampilkan setelah 1 detik
            setTimeout(function() {
                document.querySelector('#success-message').style.display = 'none';
            }, 4000); // Sembunyikan setelah 4 detik
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            setTimeout(function() {
                document.querySelector('#error-message').style.display = 'block';
            }, 1000); // Tampilkan setelah 1 detik
            setTimeout(function() {
                document.querySelector('#error-message').style.display = 'none';
            }, 4000); // Sembunyikan setelah 4 detik
        <?php endif; ?>
    </script>
</body>

</html>
