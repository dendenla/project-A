<?php
// forum-detail.php - Halaman detail forum thread

$page_title = 'Detail Forum';
$extra_css = 'forum.css';
include 'includes/header.php';
include 'includes/Database.php';

$db = new Database();

// Get thread ID from URL
$thread_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$thread = $db->getThreadById($thread_id);

if (!$thread) {
    echo "<div class='container' style='text-align: center; padding: 60px;'>";
    echo "<h2>Topik tidak ditemukan</h2>";
    echo "<a href='forum.php' class='btn btn-primary'>Kembali ke Forum</a>";
    echo "</div>";
    include 'includes/footer.php';
    exit;
}

// Increment views
$db->incrementViews($thread_id);

// Get thread replies
$replies = $db->getThreadReplies($thread_id);
$page_title = $thread['title'];
?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Forum Diskusi</h1>
            <p>Detail topik dan balasan</p>
        </div>
    </section>

    <section class="forum-section">
        <div class="container" style="max-width: 900px;">
            <a href="forum.php" class="back-link">← Kembali ke Forum</a>

            <!-- Thread Detail -->
            <div class="thread-detail">
                <div class="thread-detail-header">
                    <h1><?php echo $thread['title']; ?></h1>
                    <div class="thread-detail-meta">
                        <span class="thread-category"><?php echo $thread['category']; ?></span>
                        <span>Oleh <strong><?php echo $thread['author']; ?></strong></span>
                        <span><?php echo $thread['date']; ?></span>
                        <span>👁️ <?php echo $thread['views']; ?> dilihat</span>
                    </div>
                </div>

                <div class="thread-detail-content">
                    <div class="thread-detail-body">
                        <?php echo nl2br($thread['content']); ?>
                    </div>
                </div>
            </div>

            <!-- Replies Section -->
            <div class="posts-section">
                <h2>Balasan (<?php echo count($replies); ?>)</h2>

                <?php if (count($replies) > 0): ?>
                    <?php foreach ($replies as $reply): ?>
                        <div class="post-item">
                            <div class="post-header">
                                <span class="post-author"><?php echo $reply['author']; ?></span>
                                <span class="post-date"><?php echo $reply['date']; ?></span>
                            </div>
                            <div class="post-content">
                                <?php echo nl2br($reply['content']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #999; text-align: center; padding: 20px;">Belum ada balasan. Jadilah yang pertama memberikan balasan!</p>
                <?php endif; ?>
            </div>

            <!-- Reply Form -->
            <div class="thread-detail" style="margin-top: 40px;">
                <h2 style="margin-bottom: 20px;">Berikan Balasan Anda</h2>
                <form id="replyForm" method="POST" action="api/create-reply.php">
                    <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
                    <div class="form-group">
                        <label for="replyName">Nama Anda*</label>
                        <input type="text" id="replyName" name="author" required placeholder="Masukkan nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="replyContent">Balasan*</label>
                        <textarea id="replyContent" name="content" required placeholder="Masukkan balasan Anda..." rows="6"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Balasan</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("replyForm").onsubmit = function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            fetch('api/create-reply.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Balasan berhasil dikirim!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim balasan');
            });
        }
    </script>

<?php include 'includes/footer.php'; ?>
