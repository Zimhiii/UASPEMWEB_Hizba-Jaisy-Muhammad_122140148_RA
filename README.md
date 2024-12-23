# Dokumentasi Project UAS Web Programming

Project Lomba Tahfidz Quran - Sistem Pendaftaran dan Manajemen Peserta

Website : https://tahfidzhcompetition.wuaze.com/

Developed By : Hizba Jaisy Muhammad - 122140148 - Pemrograman Web RA

## Daftar Isi

1. [Client-side Programming](#1-client-side-programming-30)
2. [Server-side Programming](#2-server-side-programming-30)
3. [Database Management](#3-database-management-20)
4. [State Management](#4-state-management-20)
5. [Bonus: Hosting Aplikasi Web](#bonus-hosting-aplikasi-web-20)

## 1. Client-side Programming (30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)

Implementasi form pendaftaran peserta lomba dengan 4 elemen input berbeda:

```html
<!-- Dari register.php -->
<form id="registrationForm" method="POST" class="form-group">
  <div class="form-group">
    <label for="name">Nama Lengkap</label>
    <input
      type="text"
      id="name"
      name="name"
      class="form-input"
      placeholder="nama"
    />
  </div>

  <div class="form-group">
    <label for="education_level">Tingkat Pendidikan</label>
    <select id="education_level" name="education_level" class="form-input">
      <option value="">Pilih Tingkat Pendidikan</option>
      <option value="SD">SD</option>
      <option value="SMP">SMP</option>
      <option value="SMA">SMA</option>
      <option value="Kuliah">Perguruan Tinggi</option>
    </select>
  </div>

  <div class="form-group">
    <label for="memorization_level">Tingkat Hafalan</label>
    <select
      id="memorization_level"
      name="memorization_level"
      class="form-input"
    >
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
    <input
      type="tel"
      id="phone"
      name="phone"
      class="form-input"
      placeholder="no handphone"
    />
  </div>
  <button type="submit" class="submit-btn">Daftar Sekarang</button>
</form>
```

### 1.2 Event Handling (15%)

Implementasi 3 event berbeda untuk form:

```javascript
// Dari main.js
// Event 1: Form validation before submit
form.addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const educationLevel = document.getElementById("education_level").value;
  const memorizationLevel = document.getElementById("memorization_level").value;
  const phone = document.getElementById("phone").value.trim();

  // Validate all fields
  if (!name || !educationLevel || !memorizationLevel || !phone) {
    alert("Mohon isi semua field yang diperlukan");
    return;
  }

  // Validate phone number format
  const phoneRegex = /^[0-9]{10,13}$/;
  if (!phoneRegex.test(phone)) {
    alert("Nomor telepon tidak valid. Gunakan format yang benar (10-13 digit)");
    return;
  }

  // If all validations pass, submit the form
  this.submit();
});

// Event 2: Real-time phone number validation
const phoneInput = document.getElementById("phone");
phoneInput.addEventListener("input", function (e) {
  const value = e.target.value;
  // Only allow numbers
  if (!/^\d*$/.test(value)) {
    e.target.value = value.replace(/[^\d]/g, "");
  }
  // Limit to 13 digits
  if (value.length > 13) {
    e.target.value = value.slice(0, 13);
  }
});

// Event 3: Education level change validation
const educationLevel = document.getElementById("education_level");
educationLevel.addEventListener("change", function (e) {
  const memorizationLevel = document.getElementById("memorization_level");
  const selectedLevel = e.target.value;

  // Enable/disable certain memorization levels based on education
  if (selectedLevel === "SD") {
    Array.from(memorizationLevel.options).forEach((option) => {
      if (option.value && !["Juz 30", "5 Juz"].includes(option.value)) {
        option.disabled = true;
      } else {
        option.disabled = false;
      }
    });
  } else {
    Array.from(memorizationLevel.options).forEach((option) => {
      option.disabled = false;
    });
  }
});
```

## 2. Server-side Programming (30%)

### 2.1 Pengelolaan Data dengan PHP (20%)

```php
// Dari register.php dan index.php
// Get user browser and IP
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// Store in session
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;

// Validation and database storage in Participant class
public function register($data) {
    try {
        // Server-side validation
        if (empty($data['name']) || empty($data['education_level']) ||
            empty($data['memorization_level']) || empty($data['phone'])) {
            return ['success' => false, 'message' => 'Semua field harus diisi'];
        }

        // Database insertion with browser and IP
        $stmt = $this->db->prepare("
            INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
            VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)
        ");

        $stmt->execute([
            ':name' => $data['name'],
            ':education_level' => $data['education_level'],
            ':memorization_level' => $data['memorization_level'],
            ':phone' => $data['phone'],
            ':browser' => $_SESSION['browser'] ?? '',
            ':ip_address' => $_SESSION['ip_address'] ?? ''
        ]);

        return ['success' => true, 'message' => 'Pendaftaran berhasil'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
}
```

### 2.2 Objek PHP Berbasis OOP (10%)

```php
// Dari Participant.php
class Participant {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Method 1: Register participant
    public function register($data) {
        // Implementation details above
    }

    // Method 2: Get all participants
    public function getAllParticipants() {
        try {
            $stmt = $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // Method 3: Filter participants
    public function filterParticipants($filter) {
        $query = "SELECT * FROM participants WHERE
                  name LIKE :filter OR
                  education_level LIKE :filter OR
                  memorization_level LIKE :filter";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['filter' => '%' . $filter . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

## 3. Database Management (20%)

### 3.1 Pembuatan Tabel Database (5%)

```php
// Dari database.php
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
// Dari database.php
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

Implementasi di class Participant dengan metode register(), getAllParticipants(), dan filterParticipants().

```php
<?php
// Class Participant
class Participant
{
    private $conn;

    // Constructor untuk menginisialisasi koneksi database
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Metode register() untuk menambahkan peserta baru
    public function register($name, $education_level, $memorization_level, $phone, $browser, $ip_address)
    {
        $sql = "INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
                VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':education_level' => $education_level,
                ':memorization_level' => $memorization_level,
                ':phone' => $phone,
                ':browser' => $browser,
                ':ip_address' => $ip_address
            ]);
            return "Participant registered successfully.";
        } catch (PDOException $e) {
            return "Error during registration: " . $e->getMessage();
        }
    }

    // Metode getAllParticipants() untuk mengambil semua peserta
    public function getAllParticipants()
    {
        $sql = "SELECT * FROM participants ORDER BY created_at DESC";

        try {
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching participants: " . $e->getMessage();
        }
    }

    // Metode filterParticipants() untuk menyaring peserta berdasarkan level pendidikan atau hafalan
    public function filterParticipants($filterType, $filterValue)
    {
        $allowedFilters = ['education_level', 'memorization_level'];
        if (!in_array($filterType, $allowedFilters)) {
            return "Invalid filter type.";
        }

        $sql = "SELECT * FROM participants WHERE $filterType = :filterValue ORDER BY created_at DESC";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':filterValue' => $filterValue]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error filtering participants: " . $e->getMessage();
        }
    }
}

// Contoh Penggunaan
// Membuat objek Participant
$participant = new Participant($conn);

// Contoh untuk metode register()
echo $participant->register(
    'Aliyah',
    'SMA',
    '10 Juz',
    '08123456789',
    'Chrome',
    '192.168.1.1'
);

// Contoh untuk metode getAllParticipants()
$allParticipants = $participant->getAllParticipants();
print_r($allParticipants);

// Contoh untuk metode filterParticipants()
$filteredParticipants = $participant->filterParticipants('education_level', 'SMA');
print_r($filteredParticipants);
?>
```

## 4. State Management (20%)

### 4.1 State Management dengan Session (10%)

```php
// Dari index.php dan register.php
session_start();

// Store browser and IP in session
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;

// Store success/error messages
if ($result['success']) {
    $_SESSION['message'] = 'Pendaftaran berhasil!';
    header('Location: participants.php');
    exit;
} else {
    $_SESSION['error'] = $result['message'];
}
```

### 4.2 Pengelolaan State dengan Cookie (10%)

```php
// Dari database.php
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

## Bonus: Hosting Aplikasi Web (20%)

### Langkah-langkah Hosting di InfinityFree

1. **Registrasi Akun**:

   - Buat akun di InfinityFree (infinityfree.com)
   - Pilih paket hosting gratis

2. **Persiapan File**:

   - Compress semua file project ke dalam ZIP
   - Pastikan struktur folder sudah benar

3. **Upload dan Konfigurasi**:

   - Login ke control panel InfinityFree
   - Upload file ZIP melalui File Manager
   - Extract file di public_html
   - Buat database MySQL dan import struktur tabel

4. **Konfigurasi Database**:

   - Update file database.php dengan kredensial yang diberikan InfinityFree:

   ```php
   $host = 'SQL.infinityfree.com';
   $dbname = '[nama_database]';
   $username = '[username_database]';
   $password = '[password_database]';
   ```

5. **Keamanan**:

   - Gunakan HTTPS
   - Implementasi validasi input
   - Gunakan prepared statements
   - Enkripsi data sensitif
   - Regular backup database

6. **Testing**:
   - Cek semua fitur berfungsi
   - Pastikan form dapat menyimpan data
   - Verifikasi session dan cookie berjalan
   - Test performa website
