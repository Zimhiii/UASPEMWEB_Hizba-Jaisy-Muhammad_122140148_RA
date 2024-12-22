# Lomba Tahfidz Quran Web Application

This document outlines the implementation details of the web application according to the specified requirements.

## 1. Client-side Programming (30%)

### 1.1 DOM Manipulation (15%)

The application implements DOM manipulation in multiple places:

**Registration Form (register.php):**

```php
<form id="registrationForm" method="POST" class="space-y-4">
    <div>
        <label class="block text-gray-700 mb-2" for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="education_level">Tingkat Pendidikan</label>
        <select id="education_level" name="education_level" class="w-full p-2 border rounded" required>
            <!-- Education level options -->
        </select>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="memorization_level">Tingkat Hafalan</label>
        <select id="memorization_level" name="memorization_level" class="w-full p-2 border rounded" required>
            <!-- Memorization level options -->
        </select>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="phone">Nomor Telepon</label>
        <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded" required>
    </div>
</form>
```

**Participants Table (participants.php):**

```php
<table class="w-full table-auto">
    <thead class="bg-green-100">
        <tr>
            <th class="px-4 py-2 text-left">Nama</th>
            <th class="px-4 py-2 text-left">Tingkat Pendidikan</th>
            <th class="px-4 py-2 text-left">Tingkat Hafalan</th>
            <th class="px-4 py-2 text-left">Nomor Telepon</th>
            <th class="px-4 py-2 text-left">Browser</th>
            <th class="px-4 py-2 text-left">Ip Adress</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($participants as $p): ?>
        <tr class="border-b hover:bg-gray-50">
            <!-- Participant data cells -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

### 1.2 Event Handling (15%)

The application implements three distinct event handlers in main.js:

```javascript
// Event 1: Form validation before submit
form.addEventListener("submit", function (e) {
  e.preventDefault();
  // Validation logic for empty fields
  if (!name || !educationLevel || !memorizationLevel || !phone) {
    alert("Mohon isi semua field yang diperlukan");
    return;
  }
  // Phone number format validation
});

// Event 2: Real-time phone number validation
phoneInput.addEventListener("input", function (e) {
  const value = e.target.value;
  // Only allow numbers and limit to 13 digits
});

// Event 3: Education level change validation
educationLevel.addEventListener("change", function (e) {
  // Enable/disable memorization levels based on education
});
```

## 2. Server-side Programming (30%)

### 2.1 Data Management with PHP (20%)

Implementation in register.php and index.php:

```php
// Getting browser and IP information
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// Form processing with POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant = new Participant($conn);
    $result = $participant->register($_POST);
}
```

### 2.2 OOP-based PHP Objects (10%)

Implementation in Participant class:

```php
class Participant {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($data) {
        // Registration method
    }

    public function getAllParticipants() {
        // Method to retrieve all participants
    }
}
```

## 3. Database Management (20%)

### 3.1 Database Table Creation (5%)

Implementation in database.php:

```php
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
```

### 3.2 Database Connection Configuration (5%)

Implementation in database.php:

```php
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
```

## 4. State Management (20%)

### 4.1 Session Management (10%)

Implementation across multiple files:

```php
// Session initialization
session_start();

// Storing session data
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;
```

### 4.2 Cookie Management (10%)

Implementation in database.php:

```php
function setCookieValue($name, $value, $days = 30) {
    setcookie($name, $value, time() + ($days * 24 * 60 * 60), '/');
}

function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function deleteCookie($name) {
    setcookie($name, '', time() - 3600, '/');
}
```
