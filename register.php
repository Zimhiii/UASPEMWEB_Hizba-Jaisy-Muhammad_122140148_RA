<?php
// Bagian 4.1: Session Management
session_start();

// Bagian 2.1: Server-side Programming
require_once 'config/database.php';
require_once 'classes/Participant.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create new participant object (Bagian 2.2: OOP)
    $participant = new Participant($conn);
    
    // Validate and process registration
    $result = $participant->register($_POST);
    
    if ($result['success']) {
        $_SESSION['message'] = 'Pendaftaran berhasil!';
        header('Location: participants.php');
        exit;
    } else {
        $_SESSION['error'] = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lomba Tahfidz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation same as index.php -->
    <!-- <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Lomba Tahfidz Quran</h1>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-green-200">Home</a>
                <a href="register.php" class="hover:text-green-200">Daftar</a>
                <a href="participants.php" class="hover:text-green-200">Peserta</a>
            </div>
        </div>
    </nav> -->
    <nav class="relative bg-green-600 text-white p-4 pb-8 flex items-center flex-col">
        <h1 class="text-2xl font-bold">Lomba Tahfidz Quran</h1>
        <div class="absolute inset-0 mx-auto mt-[60px] bg-blue-500 w-fit h-fit bg-white text-green-600 px-4 py-2 rounded shadow-md flex gap-4">
            <a href="index.php" class="hover:text-green-900 hover:underline hover:decoration-green-800 animation-all transform hover:scale-110">Home</a>
            <a href="register.php" class="hover:text-green-900 hover:underline hover:decoration-green-800 animation-all transform hover:scale-110">Daftar</a>
            <a href="participants.php" class="hover:text-green-900 hover:underline hover:decoration-green-800 animation-all transform hover:scale-110">Peserta</a>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Formulir Pendaftaran</h2>
            
            <!-- Bagian 1.1: DOM Manipulation - Form -->
            <form id="registrationForm" method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-2" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border rounded" >
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2" for="education_level">Tingkat Pendidikan</label>
                    <select id="education_level" name="education_level" class="w-full p-2 border rounded" >
                        <option value="">Pilih Tingkat Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Kuliah">Perguruan Tinggi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 mb-2" for="memorization_level">Tingkat Hafalan</label>
                    <select id="memorization_level" name="memorization_level" class="w-full p-2 border rounded" >
                        <option value="">Pilih Tingkat Hafalan</option>
                        <option value="Juz 30">Juz 30</option>
                        <option value="5 Juz">5 Juz</option>
                        <option value="10 Juz">10 Juz</option>
                        <option value="15 Juz">15 Juz</option>
                        <option value="20 Juz">20 Juz</option>
                        <option value="30 Juz">30 Juz</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 mb-2" for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded" >
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </main>

    <!-- Bagian 1.2: Event Handling -->
    <script src="js/main.js"></script>
</body>
</html>