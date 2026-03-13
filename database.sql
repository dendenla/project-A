-- Database Schema untuk Website Info Jurusan
-- Buat database terlebih dahulu jika belum ada

-- DROP DATABASE IF EXISTS info_jurusan;
-- CREATE DATABASE info_jurusan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE info_jurusan;

-- Table: majors (Tabel Jurusan)
CREATE TABLE IF NOT EXISTS majors (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(50) NOT NULL,
  short_desc TEXT NOT NULL,
  description LONGTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: major_subjects (Mata Pelajaran Jurusan)
CREATE TABLE IF NOT EXISTS major_subjects (
  id INT PRIMARY KEY AUTO_INCREMENT,
  major_id INT NOT NULL,
  subject_name VARCHAR(255) NOT NULL,
  FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE CASCADE,
  INDEX idx_major_id (major_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: major_practices (Kegiatan Praktik Jurusan)
CREATE TABLE IF NOT EXISTS major_practices (
  id INT PRIMARY KEY AUTO_INCREMENT,
  major_id INT NOT NULL,
  practice_name VARCHAR(255) NOT NULL,
  description TEXT,
  FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE CASCADE,
  INDEX idx_major_id (major_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: major_careers (Peluang Karier Jurusan)
CREATE TABLE IF NOT EXISTS major_careers (
  id INT PRIMARY KEY AUTO_INCREMENT,
  major_id INT NOT NULL,
  career_name VARCHAR(255) NOT NULL,
  FOREIGN KEY (major_id) REFERENCES majors(id) ON DELETE CASCADE,
  INDEX idx_major_id (major_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: forum_threads (Topik Forum Diskusi)
CREATE TABLE IF NOT EXISTS forum_threads (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  content LONGTEXT NOT NULL,
  author VARCHAR(100) NOT NULL,
  views INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_category (category),
  INDEX idx_created_at (created_at),
  FULLTEXT idx_search (title, content)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: forum_replies (Balasan Forum)
CREATE TABLE IF NOT EXISTS forum_replies (
  id INT PRIMARY KEY AUTO_INCREMENT,
  thread_id INT NOT NULL,
  author VARCHAR(100) NOT NULL,
  content LONGTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (thread_id) REFERENCES forum_threads(id) ON DELETE CASCADE,
  INDEX idx_thread_id (thread_id),
  INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data dummy untuk majors (8 Jurusan)
INSERT INTO majors (name, category, short_desc, description) VALUES
('Teknologi Informasi (TI)', 'Kejuruan', 
 'Program keahlian di bidang teknologi dan sistem informasi',
 'Jurusan Teknologi Informasi menyiapkan siswa untuk menjadi profesional yang menguasai pengembangan perangkat lunak, infrastruktur jaringan, dan manajemen basis data.'),

('Desain Grafis (DG)', 'Kejuruan',
 'Program keahlian di bidang desain visual dan komunikasi grafis',
 'Jurusan Desain Grafis mempersiapkan siswa untuk menghasilkan karya desain visual berkualitas tinggi untuk berbagai media dan platform komunikasi.'),

('Akuntansi (AK)', 'IPS',
 'Program keahlian di bidang akuntansi dan keuangan',
 'Jurusan Akuntansi menyiapkan siswa untuk mengelola keuangan perusahaan, membuat laporan keuangan, dan memastikan kepatuhan terhadap standar akuntansi.'),

('Bisnis Manajemen (BM)', 'IPS',
 'Program keahlian di bidang manajemen bisnis dan kewirausahaan',
 'Jurusan Bisnis Manajemen mempersiapkan siswa untuk mengelola operasional bisnis, sumber daya manusia, dan strategi pemasaran.'),

('Administrasi Perkantoran (AP)', 'IPS',
 'Program keahlian di bidang administrasi dan manajemen kantor',
 'Jurusan Administrasi Perkantoran menyiapkan siswa untuk mengelola operasional kantor, dokumentasi, dan memberikan dukungan administratif.'),

('Teknik Elektro (TE)', 'IPA',
 'Program keahlian di bidang teknik elektro dan instalasi listrik',
 'Jurusan Teknik Elektro mempersiapkan siswa untuk mendesain, membangun, dan memelihara sistem kelistrikan dan infrastruktur listrik.'),

('Teknik Mesin (TM)', 'IPA',
 'Program keahlian di bidang perancangan dan manufaktur mesin',
 'Jurusan Teknik Mesin menyiapkan siswa untuk mendesain, memproduksi, dan memelihara mesin serta peralatan mekanis.'),

('Farmasi (FM)', 'IPA',
 'Program keahlian di bidang farmasi dan kesehatan',
 'Jurusan Farmasi mempersiapkan siswa untuk bekerja di industri farmasi, apotek, dan layanan kesehatan.');

-- Insert Mata Pelajaran untuk TI (ID: 1)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(1, 'Pemrograman Web'),
(1, 'Pemrograman Mobile'),
(1, 'Basis Data'),
(1, 'Jaringan Komputer'),
(1, 'Sistem Operasi'),
(1, 'Keamanan Siber'),
(1, 'Cloud Computing'),
(1, 'Algoritma dan Struktur Data');

-- Insert Mata Pelajaran untuk Desain Grafis (ID: 2)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(2, 'Desain Grafis Dasar'),
(2, 'Fotografi Digital'),
(2, 'Desain Web'),
(2, 'Desain Video'),
(2, 'Typography'),
(2, 'Color Theory'),
(2, 'UI/UX Design'),
(2, 'Motion Graphics');

-- Insert Mata Pelajaran untuk Akuntansi (ID: 3)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(3, 'Dasar-dasar Akuntansi'),
(3, 'Akuntansi Keuangan'),
(3, 'Akuntansi Manajemen'),
(3, 'Audit'),
(3, 'Perpajakan'),
(3, 'Sistem Informasi Akuntansi'),
(3, 'Akuntansi Biaya'),
(3, 'Analisis Laporan Keuangan');

-- Insert Mata Pelajaran untuk Bisnis Manajemen (ID: 4)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(4, 'Manajemen Umum'),
(4, 'Manajemen Pemasaran'),
(4, 'Manajemen Sumber Daya Manusia'),
(4, 'Kewirausahaan'),
(4, 'Ekonomi Bisnis'),
(4, 'Komunikasi Bisnis'),
(4, 'Etika Bisnis'),
(4, 'Strategi Bisnis');

-- Insert Mata Pelajaran untuk Administrasi Perkantoran (ID: 5)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(5, 'Administrasi Umum'),
(5, 'Manajemen Perkantoran'),
(5, 'Kearsipan'),
(5, 'Komunikasi Bisnis'),
(5, 'Tata Usaha'),
(5, 'Pengetikan Cepat'),
(5, 'Kesekretarisan'),
(5, 'Teknologi Perkantoran');

-- Insert Mata Pelajaran untuk Teknik Elektro (ID: 6)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(6, 'Dasar Teknik Elektro'),
(6, 'Instalasi Listrik'),
(6, 'Mesin Listrik'),
(6, 'Elektronika'),
(6, 'Sistem Tenaga Listrik'),
(6, 'Teknik Kendali Otomatis'),
(6, 'Telekomunikasi'),
(6, 'Energi Terbarukan');

-- Insert Mata Pelajaran untuk Teknik Mesin (ID: 7)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(7, 'Mekanika Teknik'),
(7, 'Desain Mesin'),
(7, 'Manufaktur'),
(7, 'Material Teknik'),
(7, 'Termodinamika'),
(7, 'Hidrolika dan Pneumatika'),
(7, 'CAD/CAM'),
(7, 'Teknik Pengelasan');

-- Insert Mata Pelajaran untuk Farmasi (ID: 8)
INSERT INTO major_subjects (major_id, subject_name) VALUES
(8, 'Kimia Farmasi'),
(8, 'Farmakologi'),
(8, 'Farmasetika'),
(8, 'Teknologi Farmasi'),
(8, 'Analisis Farmasi'),
(8, 'Asuhan Farmasi'),
(8, 'Cosmetology'),
(8, 'Regulasi Farmasi');

-- Insert Kegiatan Praktik untuk TI (ID: 1)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(1, 'Praktik Pemrograman', 'Praktik Pemrograman dengan berbagai bahasa pemrograman (Python, Java, JavaScript)'),
(1, 'Membangun Jaringan', 'Membangun dan mengelola jaringan komputer'),
(1, 'Pengembangan Aplikasi', 'Mengembangkan aplikasi web dan mobile'),
(1, 'Administrasi Server', 'Mengadministrasi server dan database'),
(1, 'Security Testing', 'Melakukan penetration testing dan security audit'),
(1, 'Metodologi Agile', 'Bekerja dalam tim menggunakan metodologi agile');

-- Insert Kegiatan Praktik untuk Desain Grafis (ID: 2)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(2, 'Desain dengan Adobe', 'Menggunakan software desain profesional (Adobe Creative Suite)'),
(2, 'Fotografi Dasar', 'Fotografi dan editing foto'),
(2, 'Desain Kemasan', 'Desain kemasan produk dan label'),
(2, 'Materi Promosi', 'Membuat materi promosi dan iklan'),
(2, 'UI/UX Design', 'Desain interface aplikasi mobile dan web'),
(2, 'Konten Multimedia', 'Pembuatan konten multimedia');

-- Insert Kegiatan Praktik untuk Akuntansi (ID: 3)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(3, 'Pencatatan Keuangan', 'Pencatatan transaksi keuangan'),
(3, 'Laporan Keuangan', 'Pembuatan laporan keuangan'),
(3, 'Audit Internal', 'Audit internal perusahaan'),
(3, 'Perhitungan Pajak', 'Perhitungan pajak'),
(3, 'Analisis Neraca', 'Analisis neraca dan perubahan modal'),
(3, 'Software Akuntansi', 'Penggunaan software akuntansi modern');

-- Insert Kegiatan Praktik untuk Bisnis Manajemen (ID: 4)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(4, 'Studi Kasus', 'Studi kasus manajemen perusahaan nyata'),
(4, 'Business Plan', 'Membuat business plan untuk startup'),
(4, 'Simulasi Bisnis', 'Simulasi bisnis dan market research'),
(4, 'Kepemimpinan', 'Pelatihan kepemimpinan dan kepemimpinan tim'),
(4, 'Negosiasi', 'Negosiasi dan komunikasi bisnis'),
(4, 'Analisis Kompetitor', 'Analisis kompetitor dan strategi pemasaran');

-- Insert Kegiatan Praktik untuk Administrasi Perkantoran (ID: 5)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(5, 'Manajemen Dokumen', 'Mengelola dokumen dan arsip kantor'),
(5, 'Software Perkantoran', 'Menggunakan software perkantoran (MS Office)'),
(5, 'Protokol Bisnis', 'Protokol dan etiket bisnis'),
(5, 'Manajemen Jadwal', 'Manajemen jadwal dan pertemuan'),
(5, 'Surat Menyurat', 'Penanganan surat-menyurat bisnis'),
(5, 'Presentasi', 'Penyusunan laporan dan presentasi');

-- Insert Kegiatan Praktik untuk Teknik Elektro (ID: 6)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(6, 'Instalasi Listrik', 'Instalasi sistem kelistrikan residensial dan komersial'),
(6, 'Perawatan Peralatan', 'Perawatan mesin dan peralatan listrik'),
(6, 'Troubleshooting', 'Troubleshooting dan perbaikan sistem kelistrikan'),
(6, 'Pengujian Alat', 'Pengujian dan kalibrasi peralatan'),
(6, 'Desain CAD', 'Desain instalasi dengan CAD'),
(6, 'Keselamatan Kerja', 'Keselamatan kerja di lingkungan berbahaya');

-- Insert Kegiatan Praktik untuk Teknik Mesin (ID: 7)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(7, 'Desain CAD', 'Desain komponen mesin dengan software CAD'),
(7, 'Pembuatan Prototipe', 'Pembuatan prototipe dan model'),
(7, 'Operasi Mesin', 'Operasi mesin-mesin produksi'),
(7, 'Pengelasan', 'Teknik pengelasan dan assembly'),
(7, 'Quality Control', 'Pengujian dan quality control'),
(7, 'Maintenance Mesin', 'Maintenance dan perbaikan mesin');

-- Insert Kegiatan Praktik untuk Farmasi (ID: 8)
INSERT INTO major_practices (major_id, practice_name, description) VALUES
(8, 'Formulasi Obat', 'Formulasi dan produksi obat'),
(8, 'Analisis Kualitas', 'Analisis kualitas farmasi'),
(8, 'Uji Keamanan', 'Penguji keamanan dan efektivitas obat'),
(8, 'Layanan Farmasi', 'Layanan farmasi di apotek'),
(8, 'Edukasi Pasien', 'Edukasi pasien tentang obat'),
(8, 'GMP', 'Good Manufacturing Practice (GMP)');

-- Insert Peluang Karier untuk TI (ID: 1)
INSERT INTO major_careers (major_id, career_name) VALUES
(1, 'Software Developer'),
(1, 'Web Developer'),
(1, 'Mobile App Developer'),
(1, 'Database Administrator'),
(1, 'Network Administrator'),
(1, 'Security Analyst'),
(1, 'Cloud Architect'),
(1, 'IT Project Manager');

-- Insert Peluang Karier untuk Desain Grafis (ID: 2)
INSERT INTO major_careers (major_id, career_name) VALUES
(2, 'Graphic Designer'),
(2, 'UI/UX Designer'),
(2, 'Web Designer'),
(2, 'Photographer'),
(2, 'Motion Graphics Designer'),
(2, 'Brand Identity Designer'),
(2, 'Creative Director'),
(2, 'Advertising Designer');

-- Insert Peluang Karier untuk Akuntansi (ID: 3)
INSERT INTO major_careers (major_id, career_name) VALUES
(3, 'Akuntan'),
(3, 'Auditor'),
(3, 'Tax Consultant'),
(3, 'Financial Analyst'),
(3, 'Internal Auditor'),
(3, 'Accounting Manager'),
(3, 'Bookkeeper'),
(3, 'Financial Consultant');

-- Insert Peluang Karier untuk Bisnis Manajemen (ID: 4)
INSERT INTO major_careers (major_id, career_name) VALUES
(4, 'Business Manager'),
(4, 'Sales Manager'),
(4, 'Marketing Manager'),
(4, 'HR Manager'),
(4, 'Business Consultant'),
(4, 'Entrepreneur'),
(4, 'Operations Manager'),
(4, 'General Manager');

-- Insert Peluang Karier untuk Administrasi Perkantoran (ID: 5)
INSERT INTO major_careers (major_id, career_name) VALUES
(5, 'Office Administrator'),
(5, 'Secretary'),
(5, 'Administrative Assistant'),
(5, 'Receptionist'),
(5, 'Document Manager'),
(5, 'Office Manager'),
(5, 'Executive Secretary'),
(5, 'Administrative Coordinator');

-- Insert Peluang Karier untuk Teknik Elektro (ID: 6)
INSERT INTO major_careers (major_id, career_name) VALUES
(6, 'Electrical Engineer'),
(6, 'Electrician'),
(6, 'Power Plant Operator'),
(6, 'Maintenance Technician'),
(6, 'Electrical Supervisor'),
(6, 'Installation Engineer'),
(6, 'Quality Control Engineer'),
(6, 'Renewable Energy Specialist');

-- Insert Peluang Karier untuk Teknik Mesin (ID: 7)
INSERT INTO major_careers (major_id, career_name) VALUES
(7, 'Mechanical Engineer'),
(7, 'Manufacturing Engineer'),
(7, 'Design Engineer'),
(7, 'Production Manager'),
(7, 'Maintenance Technician'),
(7, 'Plant Manager'),
(7, 'CAD Drafter'),
(7, 'Quality Engineer');

-- Insert Peluang Karier untuk Farmasi (ID: 8)
INSERT INTO major_careers (major_id, career_name) VALUES
(8, 'Pharmacist'),
(8, 'Pharmaceutical Sales'),
(8, 'Quality Assurance Officer'),
(8, 'Regulatory Affairs Specialist'),
(8, 'Apoteker'),
(8, 'Clinical Pharmacist'),
(8, 'Pharmacy Manager'),
(8, 'Research & Development Scientist');
