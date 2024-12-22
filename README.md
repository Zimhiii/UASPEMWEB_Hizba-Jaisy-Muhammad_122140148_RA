# README

## Kriteria Penilaian UAS

Dokumentasi ini dibuat untuk menjelaskan setiap bagian kriteria penilaian dalam implementasi proyek yang telah diselesaikan. Berikut adalah rincian berdasarkan kriteria:

### 1. **Fungsionalitas Utama Aplikasi**

- **Deskripsi:**
  Aplikasi yang dibangun memiliki fungsionalitas utama sesuai dengan kebutuhan proyek, yaitu:
  - Menyediakan formulir pengisian informasi tertentu.
  - Menampilkan data dalam bentuk tabel yang dapat digulir secara horizontal.
- **Implementasi:**
  - Formulir menggunakan elemen HTML `<form>` dengan validasi sederhana.
  - Tabel dirancang dengan fitur scroll horizontal menggunakan CSS.

### 2. **Struktur HTML yang Valid**

- **Deskripsi:**
  Struktur HTML memenuhi standar validasi W3C dengan elemen-elemen yang tertata.
- **Implementasi:**
  - Menggunakan elemen `<!DOCTYPE html>` di awal file.
  - Setiap elemen HTML ditutup dengan benar dan tidak ada kesalahan struktur.

### 3. **Penggunaan Bootstrap untuk Container**

- **Deskripsi:**
  Bootstrap digunakan untuk tata letak dan responsivitas aplikasi.
- **Implementasi:**
  - Elemen `div` dengan kelas `container` digunakan untuk membungkus konten utama.
  - Grid system dari Bootstrap diimplementasikan untuk tata letak kolom.

### 4. **Desain Formulir**

- **Deskripsi:**
  Formulir didesain dengan elemen input yang sesuai dan fungsional.
- **Implementasi:**
  - Elemen input seperti `<input>` dan `<textarea>` digunakan.
  - Terdapat tombol submit yang interaktif.

### 5. **Desain Tabel dengan Scroll Horizontal**

- **Deskripsi:**
  Tabel memiliki fitur scroll horizontal untuk mendukung tampilan data yang besar.
- **Implementasi:**
  - Properti CSS `overflow-x: auto;` diterapkan pada tabel.
  - Desain tabel meliputi warna bergantian untuk baris genap dan ganjil menggunakan `nth-child` CSS.

### 6. **Footer Bernuansa Gelap**

- **Deskripsi:**
  Footer dirancang dengan tema gelap yang estetis.
- **Implementasi:**
  - CSS diterapkan dengan properti `background-color: #333;` dan `color: #fff;`.
  - Konten footer mencakup informasi hak cipta atau kontak.

### 7. **Responsivitas Desain**

- **Deskripsi:**
  Aplikasi dirancang agar tampil dengan baik di berbagai ukuran layar.
- **Implementasi:**
  - Media query digunakan untuk penyesuaian tampilan.
  - Elemen Bootstrap seperti `container` dan `col` memastikan layout responsif.

### 8. **Kode yang Rapi dan Terdokumentasi**

- **Deskripsi:**
  Kode ditulis dengan rapi dan disertai komentar untuk menjelaskan fungsinya.
- **Implementasi:**
  - Komentar pada setiap bagian kode menjelaskan logika dan tujuan.
  - Indentasi konsisten sesuai standar.

### 9. **Navigasi yang Mudah**

- **Deskripsi:**
  Aplikasi menyediakan navigasi yang sederhana dan mudah dipahami.
- **Implementasi:**
  - Menu atau link navigasi dirancang secara intuitif.
  - Tidak ada hambatan dalam mengakses berbagai fitur aplikasi.

### 10. **Validasi Input Formulir**

- **Deskripsi:**
  Input pada formulir divalidasi untuk menghindari kesalahan.
- **Implementasi:**
  - Validasi sederhana menggunakan atribut HTML seperti `required` dan `pattern`.
  - Feedback diberikan jika input tidak valid.

## Cara Menjalankan Proyek

1. **Unduh atau Clone Repository**

   ```bash
   git clone <repository-url>
   ```

2. **Buka File HTML di Browser**

   - Klik kanan pada file `index.html` dan pilih "Open With Browser".

3. **Nikmati Aplikasinya**
   - Gunakan formulir untuk memasukkan data.
   - Lihat data yang dimasukkan pada tabel dengan fitur scroll horizontal.

## Catatan Tambahan

- Pastikan Anda menggunakan browser modern untuk kompatibilitas maksimal.
- Jika ada masalah, silakan hubungi pengembang untuk bantuan lebih lanjut.
