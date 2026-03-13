<?php
// majors.php - Halaman daftar jurusan

$page_title = 'Daftar Jurusan';
include 'includes/header.php';
include 'includes/Database.php';

$db = new Database();

// Get filter parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Get all majors
$majors = $db->getAllMajors();

// Apply filters
if (!empty($search)) {
    $search_lower = strtolower($search);
    $majors = array_filter($majors, function($major) use ($search_lower) {
        return strpos(strtolower($major['name']), $search_lower) !== false || 
               strpos(strtolower($major['short_desc']), $search_lower) !== false;
    });
}

if (!empty($category)) {
    $majors = array_filter($majors, function($major) use ($category) {
        return $major['category'] == $category;
    });
}

// Get unique categories
$categories = array_unique(array_column($db->getAllMajors(), 'category'));
?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Daftar Jurusan</h1>
            <p>Pilih dan pelajari jurusan yang sesuai dengan minat Anda</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <form method="GET" class="filter-controls">
                <input type="text" name="search" placeholder="Cari jurusan..." class="search-box" value="<?php echo htmlspecialchars($search); ?>">
                <select name="category" class="filter-dropdown">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo $category == $cat ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="majors.php" class="btn btn-secondary">Reset</a>
            </form>
        </div>
    </section>

    <!-- Majors Listing -->
    <section class="majors-section">
        <div class="container">
            <?php if (count($majors) > 0): ?>
                <div class="majors-list">
                    <?php foreach ($majors as $major): ?>
                        <div class="major-card">
                            <div class="major-card-header">
                                <h3><?php echo $major['name']; ?></h3>
                                <p><?php echo $major['category']; ?></p>
                            </div>
                            <div class="major-card-body">
                                <p><?php echo $major['short_desc']; ?></p>
                            </div>
                            <div class="major-card-footer">
                                <a href="<?php echo APP_URL; ?>major-detail.php?id=<?php echo $major['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 40px;">
                    <p style="font-size: 1.2rem; color: #666;">Tidak ada jurusan yang sesuai dengan pencarian Anda</p>
                    <a href="majors.php" class="btn btn-primary" style="margin-top: 20px;">Lihat Semua Jurusan</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
