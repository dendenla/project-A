<?php
// major-detail.php - Halaman detail jurusan

include 'includes/header.php';
include 'includes/Database.php';

$db = new Database();

// Get major ID from URL
$major_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$major = $db->getMajorById($major_id);

if (!$major) {
    echo "<div class='container' style='text-align: center; padding: 60px;'>";
    echo "<h2>Jurusan tidak ditemukan</h2>";
    echo "<a href='majors.php' class='btn btn-primary'>Kembali ke Daftar Jurusan</a>";
    echo "</div>";
    include 'includes/footer.php';
    exit;
}

$page_title = $major['name'];

// Get related majors (same category)
$related_majors = $db->getMajorsByCategory($major['category']);
$related_majors = array_filter($related_majors, function($m) use ($major_id) {
    return $m['id'] != $major_id;
});
?>

    <!-- Detail Section -->
    <section class="major-detail">
        <div class="container">
            <a href="<?php echo APP_URL; ?>majors.php" class="back-link">← Kembali ke Daftar Jurusan</a>
            
            <div class="detail-content">
                <div class="detail-header">
                    <h1><?php echo $major['name']; ?></h1>
                    <span class="category-badge"><?php echo $major['category']; ?></span>
                </div>

                <div class="detail-sections">
                    <!-- Description -->
                    <div class="detail-section">
                        <h2>Deskripsi Jurusan</h2>
                        <p><?php echo $major['description']; ?></p>
                    </div>

                    <!-- Subjects -->
                    <div class="detail-section">
                        <h2>Mata Pelajaran yang Dipelajari</h2>
                        <ul>
                            <?php 
                            $subjects = json_decode($major['subjects'], true);
                            foreach ($subjects as $subject): 
                            ?>
                                <li><?php echo $subject; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Practices -->
                    <div class="detail-section">
                        <h2>Kegiatan Praktik</h2>
                        <ul>
                            <?php 
                            $practices = json_decode($major['practices'], true);
                            foreach ($practices as $practice): 
                            ?>
                                <li><?php echo $practice; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Careers -->
                    <div class="detail-section">
                        <h2>Peluang Karier Setelah Lulus</h2>
                        <ul>
                            <?php 
                            $careers = json_decode($major['careers'], true);
                            foreach ($careers as $career): 
                            ?>
                                <li><?php echo $career; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Call to Action -->
                    <div class="detail-section" style="border-bottom: none; text-align: center;">
                        <p style="font-size: 1.1rem; margin-bottom: 20px;">Tertarik dengan jurusan ini? Diskusikan dengan kami di forum!</p>
                        <a href="<?php echo APP_URL; ?>forum.php" class="btn btn-primary">Buka Forum Diskusi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Majors -->
    <?php if (count($related_majors) > 0): ?>
        <section class="related-majors">
            <div class="container">
                <h2>Jurusan Terkait</h2>
                <div class="majors-grid">
                    <?php foreach ($related_majors as $related): ?>
                        <div class="major-card">
                            <div class="major-card-header">
                                <h3><?php echo $related['name']; ?></h3>
                                <p><?php echo $related['category']; ?></p>
                            </div>
                            <div class="major-card-body">
                                <p><?php echo $related['short_desc']; ?></p>
                            </div>
                            <div class="major-card-footer">
                                <a href="<?php echo APP_URL; ?>major-detail.php?id=<?php echo $related['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php include 'includes/footer.php'; ?>
