<?php
// index.php - Halaman utama

$page_title = 'Beranda';
include 'includes/header.php';
include 'includes/Database.php';

$db = new Database();
$majors = $db->getAllMajors();
$popular_majors = array_slice($majors, 0, 3);
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Website Informasi Jurusan</h1>
            <p>Temukan jurusan yang sesuai dengan minat dan bakat Anda</p>
            <a href="<?php echo APP_URL; ?>majors.php" class="btn btn-primary">Lihat Jurusan</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Apa yang Kami Tawarkan</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📖</div>
                    <h3>Deskripsi Lengkap</h3>
                    <p>Informasi komprehensif tentang setiap jurusan, mata pelajaran, dan capaian pembelajaran</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔬</div>
                    <h3>Kegiatan Praktik</h3>
                    <p>Penjelasan mengenai kegiatan praktik dan laboratorium yang dilakukan di setiap jurusan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💼</div>
                    <h3>Peluang Karier</h3>
                    <p>Informasi tentang prospek karier dan lulusan di dunia kerja setelah lulus</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Forum Diskusi</h3>
                    <p>Berinteraksi langsung dengan siswa dan guru untuk mendiskusikan jurusan pilihan Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Majors Preview -->
    <section class="majors-preview">
        <div class="container">
            <h2>Jurusan Populer</h2>
            <div class="majors-grid">
                <?php foreach ($popular_majors as $major): ?>
                    <div class="major-card">
                        <div class="major-card-header">
                            <h3><?php echo $major['name']; ?></h3>
                            <p><?php echo $major['category']; ?></p>
                        </div>
                        <div class="major-card-body">
                            <p><?php echo substr($major['short_desc'], 0, 100) . '...'; ?></p>
                        </div>
                        <div class="major-card-footer">
                            <a href="<?php echo APP_URL; ?>major-detail.php?id=<?php echo $major['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Siap Memilih Jurusan?</h2>
            <p>Jangan ragu untuk mengeksplorasi berbagai jurusan yang tersedia dan bergabunglah dengan forum diskusi kami</p>
            <div class="cta-buttons">
                <a href="<?php echo APP_URL; ?>majors.php" class="btn btn-primary">Jelajahi Semua Jurusan</a>
                <a href="<?php echo APP_URL; ?>forum.php" class="btn btn-secondary">Ikuti Forum Diskusi</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
