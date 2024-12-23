# Tahfidz Competition Website Documentation

## Published : Hizba Jaisy Muhammad

## NIM : 122140148

## KELAS : PEMROGRAMAN WEB RA

## Bagian 1: Client-side Programming (30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)

Form input dengan 4 elemen berbeda dapat ditemukan di `register.php`:

```html
<form id="registrationForm" method="POST" class="form-group">
  <!-- Text input -->
  <input
    type="text"
    id="name"
    name="name"
    class="form-input"
    placeholder="nama"
  />

  <!-- Select/dropdown input -->
  <select id="education_level" name="education_level" class="form-input">
    <option value="">Pilih Tingkat Pendidikan</option>
    <option value="SD">SD</option>
    <!-- ... -->
  </select>

  <!-- Another select/dropdown input -->
  <select id="memorization_level" name="memorization_level" class="form-input">
    <option value="">Pilih Tingkat Hafalan</option>
    <!-- ... -->
  </select>

  <!-- Telephone input -->
  <input
    type="tel"
    id="phone"
    name="phone"
    class="form-input"
    placeholder="no handphone"
  />
</form>
```

Tampilan data dalam tabel HTML di `participants.php`:

```html
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
    <?php foreach ($participants as $p): ?>
    <tr>
      <td><?php echo htmlspecialchars($p['name']); ?></td>
      <!-- ... -->
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
```

### 1.2 Event Handling (15%)

Terdapat 3 event handling di `main.js`:

1. Form validation before submit:

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

2. Real-time phone number validation:

```javascript
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
```

3. Education level change validation:

```javascript
educationLevel.addEventListener("change", function (e) {
  const memorizationLevel = document.getElementById("memorization_level");
  const selectedLevel = e.target.value;
  // Enable/disable options based on education level
  if (selectedLevel === "SD") {
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

Di `register.php` dan `Participant.php`:

```php
// POST method usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant = new Participant($conn);
    $result = $participant->register($_POST);
}

// Server-side validation
if (empty($data['name']) || empty($data['education_level']) ||
    empty($data['memorization_level']) || empty($data['phone'])) {
    return ['success' => false, 'message' => 'Semua field harus diisi'];
}

// Browser and IP capture
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];
```

### 2.2 Objek PHP Berbasis OOP (10%)

Class `Participant` di `Participant.php` dengan dua metode:

```php
class Participant {
    private $db;

    // Method 1: register
    public function register($data) {
        // Implementation
    }

    // Method 2: getAllParticipants
    public function getAllParticipants() {
        // Implementation
    }
}
```

## Bagian 3: Database Management (20%)

### 3.1 Pembuatan Tabel Database (5%)

Di `database.php`:

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

Di `database.php`:

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
}
```

### 3.3 Manipulasi Data pada Database (10%)

Di `Participant.php`:

```php
// Insert data
$stmt = $this->db->prepare("
    INSERT INTO participants (name, education_level, memorization_level, phone, browser, ip_address)
    VALUES (:name, :education_level, :memorization_level, :phone, :browser, :ip_address)
");

// Select data
public function getAllParticipants() {
    $stmt = $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

## Bagian 4: State Management (20%)

### 4.1 State Management dengan Session (10%)

Di berbagai file:

```php
// Start session
session_start();

// Store in session
$_SESSION['browser'] = $browser;
$_SESSION['ip_address'] = $ip_address;

// Use session for messages
$_SESSION['message'] = 'Pendaftaran berhasil!';
```

### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)

Di `database.php`:

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

## Bagian Bonus: Hosting di InfinityFree (20%)

### Langkah-langkah Hosting (5%)

1. Daftar akun di InfinityFree
2. Login ke control panel
3. Buat subdomain atau gunakan domain custom
4. Upload file melalui File Manager atau FTP
5. Import database melalui phpMyAdmin

### Pemilihan Hosting (5%)

InfinityFree cocok karena:

- Gratis selamanya
- Support PHP dan MySQL
- Control panel lengkap
- SSL gratis
- Unlimited bandwidth
- 5GB storage

### Keamanan Aplikasi (5%)

1. Implementasi validasi input di client dan server side
2. Penggunaan prepared statements untuk SQL
3. Sanitasi output dengan htmlspecialchars()
4. Enkripsi password dengan password_hash()
5. Implementasi HTTPS
6. Penerapan session management yang aman

### Konfigurasi Server (5%)

1. Update konfigurasi database di `database.php`:

```php
$host = 'sql.infinityfree.com';
$dbname = '[your_db_name]';
$username = '[your_username]';
$password = '[your_password]';
```

2. Pastikan file .htaccess untuk keamanan:

```apache
# Disable directory listing
Options -Indexes

# Protect application files
<FilesMatch "\.(php|ini|log)$">
 Order Allow,Deny
 Deny from all
</FilesMatch>

# Allow access to main application files
<FilesMatch "^(index|register|participants)\.php$">
 Order Allow,Deny
 Allow from all
</FilesMatch>
```
