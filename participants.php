<?php
// Bagian 4.1: Session Management
session_start();

// Bagian 2.1: Server-side Programming
require_once 'config/database.php';
require_once 'classes/Participant.php';

// Get all participants (Bagian 2.2: OOP)
$participant = new Participant($conn);
$participants = $participant->getAllParticipants();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Lomba Tahfidz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation same as other pages -->
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
            <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Daftar Peserta</h2>
            
            <!-- Bagian 1.1: DOM Manipulation - Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Tingkat Pendidikan</th>
                            <th class="px-4 py-2 text-left">Tingkat Hafalan</th>
                            <th class="px-4 py-2 text-left">Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($participants as $p): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($p['name']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($p['education_level']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($p['memorization_level']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($p['phone']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>