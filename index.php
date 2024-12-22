<?php
// Bagian 4.1: Session Management
session_start();

// Bagian 2.1: Get user browser and IP
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// Store in session
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba Tahfidz Quran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Bagian 1.1: DOM Manipulation - Navigation -->
    <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Lomba Tahfidz Quran</h1>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-green-200">Home</a>
                <a href="register.php" class="hover:text-green-200">Daftar</a>
                <a href="participants.php" class="hover:text-green-200">Peserta</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Selamat Datang di Lomba Tahfidz Quran</h2>
            <div class="space-y-4">
                <p class="text-gray-700">
                    Lomba Tahfidz Quran adalah ajang kompetisi hafalan Al-Quran yang diselenggarakan untuk berbagai tingkatan pendidikan:
                </p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-bold text-green-700">Tingkat Pendidikan:</h3>
                        <ul class="list-disc ml-6 text-gray-700">
                            <li>Sekolah Dasar (SD)</li>
                            <li>Sekolah Menengah Pertama (SMP)</li>
                            <li>Sekolah Menengah Atas (SMA)</li>
                            <li>Perguruan Tinggi</li>
                        </ul>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-bold text-green-700">Kategori Hafalan:</h3>
                        <ul class="list-disc ml-6 text-gray-700">
                            <li>Juz 30</li>
                            <li>5 Juz</li>
                            <li>10 Juz</li>
                            <li>15 Juz</li>
                            <li>20 Juz</li>
                            <li>30 Juz</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>