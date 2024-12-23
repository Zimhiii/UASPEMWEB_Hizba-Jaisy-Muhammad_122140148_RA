<?php
// Bagian 4.1: Session Management
session_start();

// Bagian 4.2: Cookie Management
require_once 'config/database.php';

// Store form data temporarily in cookies if submission fails
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['message'])) {
    setCookieValue('temp_name', $_POST['name'], 1);
    setCookieValue('temp_education_level', $_POST['education_level'], 1);
    setCookieValue('temp_memorization_level', $_POST['memorization_level'], 1);
    setCookieValue('temp_phone', $_POST['phone'], 1);
}

// Clear temporary form data cookies after successful submission
if (isset($_SESSION['message'])) {
    deleteCookie('temp_name');
    deleteCookie('temp_education_level');
    deleteCookie('temp_memorization_level');
    deleteCookie('temp_phone');
}

// Bagian 2.1: Server-side Programming
require_once 'config/database.php';
require_once 'classes/Participant.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant = new Participant($conn);
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="nav-container">
        <h1 class="nav-title">Lomba Tahfidz Quran</h1>
        <div class="nav-links">
            <a href="index.php" class="nav-link">Home</a>
            <a href="register.php" class="nav-link">Daftar</a>
            <a href="participants.php" class="nav-link">Peserta</a>
        </div>
    </nav>

    <main class="content-card">
        <div class="form-container">
            <h2 class="section-title">Formulir Pendaftaran</h2>
            <form id="registrationForm" method="POST" class="form-group">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="nama" >
                </div>
                
                
                <div class="form-group">
                    <label for="education_level">Tingkat Pendidikan</label>
                    <select id="education_level" name="education_level" class="form-input" >
                        <option value="">Pilih Tingkat Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Kuliah">Perguruan Tinggi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="memorization_level">Tingkat Hafalan</label>
                    <select id="memorization_level" name="memorization_level" class="form-input" >
                        <option value="">Pilih Tingkat Hafalan</option>
                        <option value="Juz 30">Juz 30</option>
                        <option value="5 Juz">5 Juz</option>
                        <option value="10 Juz">10 Juz</option>
                        <option value="15 Juz">15 Juz</option>
                        <option value="20 Juz">20 Juz</option>
                        <option value="30 Juz">30 Juz</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" class="form-input" placeholder="no handphone">
                </div>
                <button type="submit" class="submit-btn">Daftar Sekarang</button>
            </form>
        </div>
    </main>
    <script src="js/main.js"></script>
</body>
</html>