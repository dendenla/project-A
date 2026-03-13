<?php
// setup.php - Setup halaman untuk inisialisasi website

include 'config.php';
include 'includes/Database.php';

// Initialize database
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

$db = new Database();

// Check if initialized
$majors_file = DATA_DIR . 'majors.json';
$threads_file = DATA_DIR . 'threads.json';

$is_initialized = file_exists($majors_file) && file_exists($threads_file);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['init'])) {
    // Re-initialize
    if (file_exists($majors_file)) {
        unlink($majors_file);
    }
    if (file_exists($threads_file)) {
        unlink($threads_file);
    }
    
    $db = new Database();
    $message = "Website berhasil diinisialisasi!";
    $is_initialized = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - Info Jurusan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .setup-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .status {
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .info-list {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-list li {
            margin: 10px 0;
            color: #555;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            transition: background 0.3s ease;
            margin-right: 10px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #764ba2;
        }
        .btn-secondary {
            background: #999;
        }
        .btn-secondary:hover {
            background: #777;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <h1>📚 Setup Website Info Jurusan</h1>
        
        <?php if ($is_initialized): ?>
            <div class="status success">✅ Website sudah diinisialisasi dan siap digunakan!</div>
            
            <div class="info-list">
                <h3>Informasi:</h3>
                <ul>
                    <li><strong>Direktori Data:</strong> <?php echo DATA_DIR; ?></li>
                    <li><strong>File Jurusan:</strong> majors.json</li>
                    <li><strong>File Forum:</strong> threads.json</li>
                    <li><strong>Total Jurusan:</strong> <?php echo count($db->getAllMajors()); ?></li>
                </ul>
            </div>

            <?php if (isset($message)): ?>
                <p style="color: #28a745; font-weight: bold;">✅ <?php echo $message; ?></p>
            <?php endif; ?>

            <p>Data website Anda telah berhasil diinisialisasi dengan:</p>
            <ul>
                <li>8 Jurusan dengan informasi lengkap</li>
                <li>Forum diskusi yang dapat diakses oleh semua pengunjung</li>
                <li>Sistem penyimpanan data berbasis file JSON</li>
            </ul>

            <form method="POST" style="margin-top: 20px;">
                <button type="submit" name="init" class="btn btn-secondary" onclick="return confirm('Apakah Anda yakin ingin menginisialisasi ulang? Data sebelumnya akan dihapus!');">
                    Inisialisasi Ulang
                </button>
            </form>
        <?php else: ?>
            <div class="status info">⚠️ Website belum diinisialisasi</div>
            
            <p>Klik tombol di bawah untuk menginisialisasi website dengan data default:</p>

            <form method="POST">
                <button type="submit" name="init" class="btn">Inisialisasi Website</button>
            </form>
        <?php endif; ?>

        <hr style="margin: 30px 0;">

        <h3>Tautan Cepat:</h3>
        <a href="<?php echo APP_URL; ?>" class="btn">Ke Beranda</a>
        <a href="<?php echo APP_URL; ?>majors.php" class="btn">Lihat Jurusan</a>
        <a href="<?php echo APP_URL; ?>forum.php" class="btn">Forum Diskusi</a>

        <p style="margin-top: 30px; color: #999; font-size: 0.9rem;">
            Website Info Jurusan © 2026
        </p>
    </div>
</body>
</html>
