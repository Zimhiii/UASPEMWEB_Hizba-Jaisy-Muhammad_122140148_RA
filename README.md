# Aplikasi Web Lomba Tahfidz Quran

Dokumen ini menjelaskan detail implementasi aplikasi web sesuai dengan persyaratan yang ditentukan.

## 1. Pemrograman Sisi Klien (30%)

### 1.1 Manipulasi DOM (15%)

Aplikasi mengimplementasikan manipulasi DOM di beberapa tempat:

**Formulir Pendaftaran (register.php):**

```php
<form id="registrationForm" method="POST" class="space-y-4">
    <div>
        <label class="block text-gray-700 mb-2" for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="education_level">Tingkat Pendidikan</label>
        <select id="education_level" name="education_level" class="w-full p-2 border rounded" required>
            <!-- Pilihan tingkat pendidikan -->
        </select>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="memorization_level">Tingkat Hafalan</label>
        <select id="memorization_level" name="memorization_level" class="w-full p-2 border rounded" required>
            <!-- Pilihan tingkat hafalan -->
        </select>
    </div>

    <div>
        <label class="block text-gray-700 mb-2" for="phone">Nomor Telepon</label>
        <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded" required>
    </div>
</form>
```

**Tabel Peserta (participants.php):**

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
            <!-- Data peserta -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

### 1.2 Penanganan Event (15%)

Aplikasi mengimplementasikan tiga penangan event berbeda dalam main.js:

```javascript
// Event 1: Validasi formulir sebelum submit
form.addEventListener("submit", function (e) {
  e.preventDefault();
  // Logika validasi untuk field kosong
  if (!name || !educationLevel || !memorizationLevel || !phone) {
    alert("Mohon isi semua field yang diperlukan");
    return;
  }
  // Validasi format nomor telepon
});

// Event 2: Validasi nomor telepon secara real-time
phoneInput.addEventListener("input", function (e) {
  const value = e.target.value;
  // Hanya mengizinkan angka dan membatasi hingga 13 digit
});

// Event 3: Validasi perubahan tingkat pendidikan
educationLevel.addEventListener("change", function (e) {
  // Mengaktifkan/menonaktifkan tingkat hafalan berdasarkan pendidikan
});
```

## 2. Pemrograman Sisi Server (30%)

### 2.1 Pengelolaan Data dengan PHP (20%)

Implementasi dalam register.php dan index.php:

```php
// Mendapatkan informasi browser dan IP
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];

// Pemrosesan formulir dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant = new Participant($conn);
    $result = $participant->register($_POST);
}
```

### 2.2 Objek PHP Berbasis OOP (10%)

Implementasi dalam kelas Participant:

```php
class Participant {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($data) {
        // Metode pendaftaran
    }

    public function getAllParticipants() {
        // Metode untuk mengambil semua peserta
    }
}
```

## 3. Manajemen Database (20%)

### 3.1 Pembuatan Tabel Database (5%)

Implementasi dalam database.php:

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

### 3.2 Konfigurasi Koneksi Database (5%)

Implementasi dalam database.php:

```php
$host = 'localhost';
$dbname = 'tahfidz_competition';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}
```

### 3.3 Manipulasi Data pada Database (10%)

```php
public function filterParticipants($filter) {
        $query = "SELECT * FROM participants WHERE
                  name LIKE :filter OR
                  education_level LIKE :filter OR
                  memorization_level LIKE :filter";
        $stmt = $this->db->prepare($query); // Menggunakan $this->db
        $stmt->execute(['filter' => '%' . $filter . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
```

## 4. Manajemen State (20%)

### 4.1 Manajemen Sesi (10%)

Implementasi di berbagai file:

```php
// Inisialisasi sesi
session_start();

// Menyimpan data sesi
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;
```

### 4.2 Manajemen Cookie (10%)

Implementasi dalam database.php:

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

### Catatan Tambahan:

- Setiap fungsi telah diimplementasikan sesuai dengan persyaratan bobot penilaian
- Kode telah disusun dengan memperhatikan praktik terbaik dalam pengembangan web
- Implementasi mencakup semua aspek yang diminta dalam kriteria penilaian
