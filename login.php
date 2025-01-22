<?php
session_start();

// Cek jika login berhasil dan tampilkan pesan
if (isset($_SESSION['login_success'])) {
    $login_success = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
} else {
    $login_success = false;
}

// Cek jika ada pesan error dari login_process.php
if (isset($_SESSION['login_error'])) {
    $login_error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
} else {
    $login_error = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
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
            <h1 class="text-3xl font-bold text-white mb-2">Login</h1>
            <p class="text-lg text-white">Masuk untuk melanjutkan</p>
        </div>

        <?php if ($login_error): ?>
            <div class="toast toast-error" id="error-message">
                <p class="font-bold">Login gagal!</p>
                <?= $login_error; ?>
            </div>
        <?php endif; ?>

        <form action="login_proses.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-lg text-white">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 bg-transparent border border-white rounded-lg text-white placeholder-white focus:outline                 focus:ring-2 focus:ring-blue-400 transition duration-300" required />
            </div>

            <div>
                <label for="church" class="block text-lg text-white">Gereja</label>
                <input type="text" id="church" name="church" placeholder="Masukkan nama gereja" class="w-full px-4 py-3 bg-transparent border border-white rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300" required />
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-600 transition-all duration-300">
                Login
            </button>

            <p class="text-white flex justify-center">Belum punya akun? <a class="text-blue-500 underline font-semibold" href="/register.php"> Daftar</a></p>
        </form>
    </div>

    <!-- Toast message for successful login -->
    <?php if ($login_success): ?>
        <div class="toast" id="success-message">
            Anda berhasil login
        </div>
        <script>
            // Tampilkan Toast sukses login dan sembunyikan setelah beberapa detik
            setTimeout(function() {
                document.querySelector('.toast').style.display = 'block';
            }, 1000); // Tampilkan setelah 1 detik
            setTimeout(function() {
                document.querySelector('.toast').style.display = 'none';
            }, 4000); // Sembunyikan setelah 4 detik
        </script>
    <?php endif; ?>

    <script>
        // Tampilkan Toast error login dan sembunyikan setelah 4 detik
        <?php if ($login_error): ?>
            setTimeout(function() {
                document.querySelector('.toast-error').style.display = 'block';
            }, 1000); // Tampilkan setelah 1 detik
            setTimeout(function() {
                document.querySelector('.toast-error').style.display = 'none';
            }, 4000); // Sembunyikan setelah 4 detik
        <?php endif; ?>
    </script>
</body>

</html>
