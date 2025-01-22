<?php
session_start();

// Jika pengguna belum login, arahkan mereka ke halaman login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user']; // Menyimpan informasi pengguna yang sedang login
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
        /* Animasi Toast */
      .toast {
            position: absolute;
            z-index: 999;
            top: 2%; /* Posisi 5% dari atas */
            left: 50%;
            transform: translateX(-50%) translateY(-100%); /* Mulai dari luar layar */
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            width: calc(80% - 1rem); /* Mengatur lebar untuk margin */
            
            animation: slideDown 0.5s ease-in-out forwards, fadeOut 3s 3s forwards;
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

<body class="bg-gradient-to-br from-blue-500 to-indigo-700 min-h-screen flex items-center justify-center text-white">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <!-- Bagian Header -->
        <header class="text-center mb-6">
            <div class="flex justify-center items-center font-bold gap-x-2 mb-2">
                <p class="text-white font-bold">Klik tiket untuk detail</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" viewBox="0 0 256 256">
                    <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                </svg>
            </div>
            <a href="img/Ticketyouth.png" data-lightbox="ticket" data-title="Tiket Youth">
                <img src="img/Ticketyouth.png" alt="Logo Youth" class="relative w-full mx-auto lg:h-64 mb-4" />
            </a>
            <h1 class="text-4xl font-bold mb-2">Selamat Datang!</h1>
            <p class="text-lg">Halo, <span class="font-semibold"><?php echo htmlspecialchars($user['name']); ?></span></p>
        </header>

        <!-- Bagian Konten -->
        <main class="bg-white bg-opacity-20 backdrop-blur-md rounded-lg shadow-lg p-6 w-11/12 sm:w-3/4 lg:w-1/2 text-center">
            <p class="text-lg mb-4">Selamat menikmati pengalaman bersama Sound of Praise!</p>
            <p class="text-base text-gray-200">Bersyukur bisa bersama Anda dalam perjalanan ini.</p>
        </main>

        <div class="toast inline-block flex justify-center items-center">
            <p class="font-bold">Anda berhasil login ! </p>
        </div>

        <!-- Tombol Logout -->
        <footer class="mt-8">
            <a href="logout.php"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="px-6 py-3 bg-red-500 hover:bg-red-600 rounded-lg shadow-md font-semibold text-white transition">
                Logout
            </a>
            <form id="logout-form" action="logout.php" method="POST" style="display: none;">
                <!-- Hanya logout jika form ini dikirim -->
                <input type="hidden" name="logout" value="1">
            </form>
        </footer>
    </div>
</body>

</html>
