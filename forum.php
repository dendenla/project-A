<?php
// forum.php - Halaman forum diskusi

$page_title = 'Forum Diskusi';
$extra_css = 'forum.css';
include 'includes/header.php';
include 'includes/Database.php';

$db = new Database();

// Get filter parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'recent';

// Get all threads
if (!empty($search)) {
    $threads = $db->searchThreads($search);
} else {
    $threads = $db->getAllThreads();
}

// Sort threads
if ($sort == 'popular') {
    usort($threads, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($sort == 'unanswered') {
    $threads = array_filter($threads, function($t) {
        return $t['replies'] == 0;
    });
} else {
    // Default: recent
    usort($threads, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

// Forum categories
$categories = ['Teknologi Informasi', 'Desain Grafis', 'Akuntansi', 'Bisnis Manajemen', 'Administrasi Perkantoran', 'Teknik Elektro', 'Teknik Mesin', 'Farmasi', 'Umum'];
?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Forum Diskusi</h1>
            <p>Diskusikan dan tanyakan tentang jurusan pilihan Anda</p>
        </div>
    </section>

    <!-- Forum Content -->
    <section class="forum-section">
        <div class="container">
            <div class="forum-container">
                <!-- Sidebar -->
                <aside class="forum-sidebar">
                    <div class="new-thread-btn">
                        <button id="newThreadBtn" class="btn btn-primary" style="width: 100%;">Buat Topik Baru</button>
                    </div>
                    <div class="forum-categories">
                        <h3>Kategori</h3>
                        <ul id="categoryList">
                            <li><a href="forum.php" class="<?php echo empty($search) && !isset($_GET['category']) ? 'active' : ''; ?>">Semua Topik</a></li>
                            <?php foreach ($categories as $cat): ?>
                                <li><a href="forum.php?category=<?php echo urlencode($cat); ?>" class="<?php echo isset($_GET['category']) && $_GET['category'] == $cat ? 'active' : ''; ?>"><?php echo $cat; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="forum-main">
                    <!-- Filter Section -->
                    <div class="forum-filter">
                        <form style="display: flex; gap: 15px; width: 100%;" method="GET">
                            <input type="text" name="search" placeholder="Cari topik..." class="search-box" value="<?php echo htmlspecialchars($search); ?>">
                            <select name="sort" class="filter-dropdown" onchange="this.form.submit()">
                                <option value="recent" <?php echo $sort == 'recent' ? 'selected' : ''; ?>>Paling Baru</option>
                                <option value="popular" <?php echo $sort == 'popular' ? 'selected' : ''; ?>>Paling Populer</option>
                                <option value="unanswered" <?php echo $sort == 'unanswered' ? 'selected' : ''; ?>>Belum Dijawab</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>

                    <!-- Threads List -->
                    <div class="threads-list" id="threadsList">
                        <?php if (count($threads) > 0): ?>
                            <?php foreach ($threads as $thread): ?>
                                <a href="forum-detail.php?id=<?php echo $thread['id']; ?>" style="text-decoration: none; color: inherit;">
                                    <div class="thread-item">
                                        <div class="thread-header">
                                            <div>
                                                <h3 class="thread-title"><?php echo $thread['title']; ?></h3>
                                                <span class="thread-category"><?php echo $thread['category']; ?></span>
                                            </div>
                                        </div>
                                        <div class="thread-meta">
                                            <span>Oleh: <strong><?php echo $thread['author']; ?></strong></span>
                                            <span><?php echo $thread['date']; ?></span>
                                        </div>
                                        <p class="thread-excerpt"><?php echo substr($thread['content'], 0, 150) . '...'; ?></p>
                                        <div class="thread-stats">
                                            <div class="thread-stat">💬 <?php echo $thread['replies']; ?> Balasan</div>
                                            <div class="thread-stat">👁️ <?php echo $thread['views']; ?> Dilihat</div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="text-align: center; padding: 40px; color: #666;">
                                <p style="font-size: 1.1rem;">Belum ada topik diskusi</p>
                                <p style="margin-top: 10px;">Jadilah yang pertama membuat topik baru!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Modal untuk Thread Baru -->
    <div id="newThreadModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeNewThreadModal">&times;</span>
            <h2>Buat Topik Baru</h2>
            <form id="newThreadForm" method="POST" action="api/create-thread.php">
                <div class="form-group">
                    <label for="threadTitle">Judul Topik*</label>
                    <input type="text" id="threadTitle" name="title" required placeholder="Masukkan judul topik">
                </div>
                <div class="form-group">
                    <label for="threadCategory">Kategori*</label>
                    <select id="threadCategory" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="threadContent">Isi Topik*</label>
                    <textarea id="threadContent" name="content" required placeholder="Masukkan pertanyaan atau diskusi Anda..." rows="6"></textarea>
                </div>
                <div class="form-group">
                    <label for="threadName">Nama Anda*</label>
                    <input type="text" id="threadName" name="author" required placeholder="Masukkan nama Anda">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Buat Topik</button>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const newThreadModal = document.getElementById("newThreadModal");
        const newThreadBtn = document.getElementById("newThreadBtn");
        const closeNewThreadModal = document.getElementById("closeNewThreadModal");

        newThreadBtn.onclick = function() {
            newThreadModal.style.display = "block";
        }

        closeNewThreadModal.onclick = function() {
            newThreadModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == newThreadModal) {
                newThreadModal.style.display = "none";
            }
        }

        // Form submission
        document.getElementById("newThreadForm").onsubmit = function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            fetch('api/create-thread.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Topik berhasil dibuat!');
                    window.location.href = 'forum-detail.php?id=' + data.thread_id;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membuat topik');
            });
        }
    </script>

<?php include 'includes/footer.php'; ?>
