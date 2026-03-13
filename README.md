# Website Informasi Jurusan Sekolah - PHP Native

Website ini dibuat menggunakan PHP Native sebagai media informasi yang berisi penjelasan mengenai berbagai jurusan yang tersedia di sekolah.

## 📋 Fitur Utama

### 1. **Informasi Jurusan**
- Daftar lengkap jurusan yang tersedia (8 jurusan)
- Deskripsi detail setiap jurusan
- Mata pelajaran yang dipelajari
- Kegiatan praktik dan laboratorium
- Peluang karier setelah lulus
- Pencarian dan filter jurusan berdasarkan kategori

### 2. **Forum Diskusi**
- Buat topik diskusi baru
- Lihat dan baca topik diskusi dari siswa lain
- Berikan balasan pada topik diskusi
- Filter topik berdasarkan kategori
- Cari topik dengan keyword
- Urutkan topik by: Terbaru, Populer, Belum Dijawab

### 3. **Desain Responsif**
- Website responsif untuk desktop, tablet, dan mobile
- Navigasi yang user-friendly
- Interface modern dengan gradient colors

## 🏗️ Struktur Folder

```
project-A/
├── index.php              # Halaman utama
├── majors.php             # Daftar jurusan
├── major-detail.php       # Detail jurusan
├── forum.php              # Daftar forum diskusi
├── forum-detail.php       # Detail thread forum
├── setup.php              # Setup dan inisialisasi
├── config.php             # Konfigurasi aplikasi
├── api/
│   ├── create-thread.php  # API untuk buat thread
│   └── create-reply.php   # API untuk buat reply
├── includes/
│   ├── header.php         # Header template
│   ├── footer.php         # Footer template
│   └── Database.php       # Class untuk manage data
├── assets/
│   ├── css/
│   │   ├── style.css      # Style utama
│   │   ├── navbar.css     # Style navbar
│   │   └── forum.css      # Style forum
│   ├── images/            # Folder untuk gambar
├── data/                  # Folder untuk menyimpan data JSON
│   ├── majors.json        # Data jurusan
│   ├── threads.json       # Data thread forum
│   └── replies_*.json     # File untuk balasan setiap thread
└── uploads/               # Folder untuk upload (opsional)
```

## 🚀 Cara Menggunakan

### 1. **Instalasi dan Setup**

1. Pastikan PHP sudah terinstall di sistem Anda
2. Copy folder `project-A` ke folder `htdocs` jika menggunakan XAMPP
3. Buka browser dan akses: `http://localhost/project-A/setup.php`
4. Klik tombol "Inisialisasi Website" untuk setup data
5. Setelah inisialisasi selesai, Anda dapat mengakses website di `http://localhost/project-A/`

### 2. **Mengakses Website**

- **Beranda**: `http://localhost/project-A/index.php`
- **Daftar Jurusan**: `http://localhost/project-A/majors.php`
- **Detail Jurusan**: `http://localhost/project-A/major-detail.php?id=1`
- **Forum Diskusi**: `http://localhost/project-A/forum.php`
- **Detail Thread**: `http://localhost/project-A/forum-detail.php?id=1`

### 3. **Menggunakan Forum**

#### Membuat Topik Baru:
1. Buka halaman Forum Diskusi
2. Klik tombol "Buat Topik Baru"
3. Isi form dengan:
   - Judul Topik
   - Kategori
   - Isi Topik
   - Nama Anda
4. Klik "Buat Topik"

#### Memberikan Balasan:
1. Klik pada topik yang ingin Anda balas
2. Scroll ke bawah ke bagian "Berikan Balasan Anda"
3. Isi form dengan nama dan balasan Anda
4. Klik "Kirim Balasan"

## 📚 Data Jurusan

Website ini menyediakan 8 jurusan:

1. **Teknologi Informasi (TI)** - Kategori: Kejuruan
2. **Desain Grafis (DG)** - Kategori: Kejuruan
3. **Akuntansi (AK)** - Kategori: IPS
4. **Bisnis Manajemen (BM)** - Kategori: IPS
5. **Administrasi Perkantoran (AP)** - Kategori: IPS
6. **Teknik Elektro (TE)** - Kategori: IPA
7. **Teknik Mesin (TM)** - Kategori: IPA
8. **Farmasi (FM)** - Kategori: IPA

Setiap jurusan memiliki:
- Deskripsi lengkap
- 8+ mata pelajaran
- 6+ kegiatan praktik
- 8+ peluang karier

## 🔧 Teknologi yang Digunakan

- **Backend**: PHP 7.0+
- **Frontend**: HTML5, CSS3
- **Data Storage**: JSON File (tidak memerlukan database)
- **Server**: Apache/XAMPP

## 📝 Catatan Teknis

### Penyimpanan Data
Website menggunakan sistem penyimpanan berbasis file JSON di folder `data/`:
- `majors.json` - Menyimpan data 8 jurusan
- `threads.json` - Menyimpan semua topik forum
- `replies_*.json` - Menyimpan balasan untuk setiap thread

### Security
- Semua input user di-sanitasi menggunakan `htmlspecialchars()`
- Validasi data di server-side
- JSON response untuk API

### Performance
- Penyimpanan file yang efisien
- Query data yang cepat tanpa database overhead
- CSS dan HTML yang ringan

## 🎨 Fitur Desain

- **Color Scheme**: Purple/Blue gradient (#667eea - #764ba2)
- **Responsive Design**: Mobile-first approach
- **Modern UI**: Card-based layout, smooth transitions
- **User Experience**: Intuitive navigation, clear call-to-action

## 📞 Kontak

Email: info@sekolah.edu  
Telepon: (021) 123-4567

## © 2026 Hak Cipta

Website Informasi Jurusan Sekolah. Semua hak dilindungi.

---

**Dibuat oleh**: Tim Pengembang  
**Tanggal**: Maret 2026  
**Versi**: 1.0 - PHP Native