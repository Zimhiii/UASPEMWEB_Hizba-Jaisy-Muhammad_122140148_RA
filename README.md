# Lomba Tahfidz Quran - Technical Documentation

## Bagian 1: Client-side Programming (30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)

Form input dengan 4 elemen berbeda dapat ditemukan di `register.php`:

```html
<!-- From register.php -->
<form id="registrationForm" method="POST" class="form-group">
    <input type="text" id="name" name="name" class="form-input">
    <select id="education_level" name="education_level" class="form-input">
    <select id="memorization_level" name="memorization_level" class="form-input">
    <input type="tel" id="phone" name="phone" class="form-input">
</form>
```

DOM Manipulation untuk validasi form:

```javascript
// From main.js
document
  .getElementById("registrationForm")
  .addEventListener("submit", function (e) {
    let isValid = true;
    const name = document.getElementById("name");
    const educationLevel = document.getElementById("education_level");
    const memorizationLevel = document.getElementById("memorization_level");
    const phone = document.getElementById("phone");

    // Reset error messages
    document.querySelectorAll(".error-message").forEach((el) => el.remove());
    // ... validation logic
  });
```

### 1.2 Event Handling (15%)

Tiga event berbeda diimplementasikan di `main.js`:

1. Form Submit Event:

```javascript
form.addEventListener("submit", function (e) {
  e.preventDefault();
  // Validate all fields
  if (!name || !educationLevel || !memorizationLevel || !phone) {
    alert("Mohon isi semua field yang diperlukan");
    return;
  }
  // ... more validation
});
```

2. Real-time Phone Number Validation:

```javascript
phoneInput.addEventListener("input", function (e) {
  const value = e.target.value;
  // Only allow numbers
  if (!/^\d*$/.test(value)) {
    e.target.value = value.replace(/[^\d]/g, "");
  }
});
```

3. Education Level Change Event:

```javascript
educationLevel.addEventListener("change", function (e) {
  const memorizationLevel = document.getElementById("memorization_level");
  const selectedLevel = e.target.value;
  // Enable/disable memorization levels based on education
  if (selectedLevel === "SD") {
    // For SD, only allow Juz 30 and 5 Juz
    Array.from(memorizationLevel.options).forEach((option) => {
      if (option.value && !["Juz 30", "5 Juz"].includes(option.value)) {
        option.disabled = true;
      }
    });
  }
});
```

## Bagian 2: Server-side Programming (30%)

### 2.1 Pengelolaan Data dengan PHP (20%)

Implementation in `register.php` and `Participant.php`:

```php
// From Participant.php - Server-side validation
public function register($data) {
    try {
        if (empty($data['name']) || empty($data['education_level']) ||
            empty($data['memorization_level']) || empty($data['phone'])) {
            return ['success' => false, 'message' => 'Semua field harus diisi'];
        }

        // Store browser and IP data
        $stmt = $this->db->prepare("
            INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
            VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)
        ");
```

### 2.2 Objek PHP Berbasis OOP (10%)

Class `Participant` dengan multiple methods:

```php
// From Participant.php
class Participant {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Method 1: register
    public function register($data) {
        // ... registration logic
    }

    // Method 2: getAllParticipants
    public function getAllParticipants() {
        // ... fetch participants logic
    }

    // Method 3: filterParticipants
    public function filterParticipants($filter) {
        // ... filter logic
    }
}
```

## Bagian 3: Database Management (20%)

### 3.1 Pembuatan Tabel Database (5%)

```php
// From database.php
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

### 3.2 Konfigurasi Koneksi Database (5%)

```php
// From database.php
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

### 3.3 Manipulasi Data pada Database (10%)

```php
// From Participant.php - Insert Data
$stmt = $this->db->prepare("
    INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
    VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)
");

// Select Data
public function getAllParticipants() {
    try {
        $stmt = $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
```

## Bagian 4: State Management (20%)

### 4.1 State Management dengan Session (10%)

```php
// From index.php and register.php
session_start();

// Store browser and IP in session
$_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

// Store success/error messages
if ($result['success']) {
    $_SESSION['message'] = 'Pendaftaran berhasil!';
    header('Location: participants.php');
    exit;
}
```

### 4.2 Pengelolaan State dengan Cookie (10%)

```php
// From database.php - Cookie Management Functions
function setCookieValue($name, $value, $days = 30) {
    setcookie($name, $value, time() + ($days * 24 * 60 * 60), '/');
}

function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function deleteCookie($name) {
    setcookie($name, '', time() - 3600, '/');
}

// Implementation in register.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['message'])) {
    setCookieValue('temp_name', $_POST['name'], 1);
    setCookieValue('temp_education_level', $_POST['education_level'], 1);
    // ... more cookie storage
}
```
