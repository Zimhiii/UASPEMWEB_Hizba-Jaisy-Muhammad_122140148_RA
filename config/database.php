<?php
// Bagian 3.2: Database Configuration
$host = 'localhost';
$dbname = 'tahfidz_competition';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Bagian 3.1: Database Table Creation
$createTable = "
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    education_level VARCHAR(50) NOT NULL,
    memorization_level VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    browser VARCHAR(255),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $conn->exec($createTable);
} catch(PDOException $e) {
    echo "Table creation failed: " . $e->getMessage();
    exit;
}

// Bagian 4.2: Cookie Management
function setCookieValue($name, $value, $days = 30) {
    setcookie($name, $value, time() + ($days * 24 * 60 * 60), '/');
}

function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function deleteCookie($name) {
    setcookie($name, '', time() - 3600, '/');
}
?>