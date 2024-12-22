<?php
// Bagian 4.1: Session Management
session_start();

// Bagian 2.1: Server-side Programming
require_once 'config/database.php';
require_once 'classes/Participant.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$participant = new Participant($conn);

if ($filter) {
    $participants = $participant->filterParticipants($filter);
} else {
    $participants = $participant->getAllParticipants();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Lomba Tahfidz</title>
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
        <h2 class="section-title">Daftar Peserta</h2>
        
        <form method="GET" class="form-group">
            <input 
                type="text" 
                name="filter" 
                value="<?php echo htmlspecialchars($filter); ?>" 
                class="form-input"
                placeholder="Filter peserta berdasarkan nama, tingkat pendidikan, atau tingkat hafalan..."
            >
            <button type="submit" class="submit-btn">Cari</button>
        </form>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tingkat Pendidikan</th>
                        <th>Tingkat Hafalan</th>
                        <th>Nomor Telepon</th>
                        <th>Browser</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada peserta yang ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $p): ?>
                        <tr>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['name']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['education_level']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['memorization_level']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['phone']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['browser']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($p['ip_address']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Add any additional JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                    this.style.transition = 'all 0.3s ease';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Add animation to form submission
            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('submit', function() {
                    this.style.opacity = '0.7';
                    this.style.transform = 'scale(0.98)';
                    this.style.transition = 'all 0.3s ease';
                });
            }
        });
    </script>
</body>
</html>