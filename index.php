<?php
// // Bagian 4.1: Session Management
// session_start();



// // Bagian 2.1: Get user browser and IP
// $browser = $_SERVER['HTTP_USER_AGENT'];
// $ip_address = $_SERVER['REMOTE_ADDR'];

// // Store in session
// $_SESSION['browser'] = $browser;
// $_SESSION['ip_address'] = $ip_address;


// mulai

// Bagian 4.1: Session Management
session_start();

// Bagian 2.1: Get user browser and IP
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// Store in session
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;

// Bagian 4.2: Cookie Management
require_once 'config/database.php';

// Set last visit cookie
setCookieValue('last_visit', date('Y-m-d H:i:s'));

// Store preferred language if set
if (isset($_POST['language'])) {
    setCookieValue('preferred_language', $_POST['language']);
}

// Get last visit info
$lastVisit = getCookieValue('last_visit');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba Tahfidz Quran</title>
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

    <section class="hero-section">
        <h1 class="section-title">National Tahfidz Competition</h1>
        <p class="hero-text">Join us in celebrating the preservation of the Holy Quran</p>
        <button class="submit-btn-hero" href="register.php">
            <a href="register.php" class="submit-btn">Register Now</a>
        </button>
    </section>

    <main class="content-card">
        <h2 class="section-title">Selamat Datang di Lomba Tahfidz Quran</h2>
        <p>Lomba Tahfidz Quran adalah ajang kompetisi hafalan Al-Quran yang diselenggarakan untuk berbagai tingkatan pendidikan:</p>
        
        <div class="info-grid">
            <div class="info-card">
                <h3>Tingkat Pendidikan:</h3>
                <ul>
                    <li>Sekolah Dasar (SD)</li>
                    <li>Sekolah Menengah Pertama (SMP)</li>
                    <li>Sekolah Menengah Atas (SMA)</li>
                    <li>Perguruan Tinggi</li>
                </ul>
            </div>
            <div class="info-card">
                <h3>Kategori Hafalan:</h3>
                <ul>
                    <li>Juz 30</li>
                    <li>5 Juz</li>
                    <li>10 Juz</li>
                    <li>15 Juz</li>
                    <li>20 Juz</li>
                    <li>30 Juz</li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>
