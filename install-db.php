<?php
// install-db.php - Script untuk setup database MySQL

include 'config.php';

$error = '';
$success = '';
$step = isset($_GET['step']) ? $_GET['step'] : 1;

// Step 1: Buat database
if ($step == 1 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn_temp = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    
    if (!$conn_temp) {
        $error = 'Gagal terhubung ke MySQL: ' . mysqli_connect_error();
    } else {
        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if (mysqli_query($conn_temp, $sql)) {
            $success = 'Database berhasil dibuat!';
            header('Location: install-db.php?step=2');
            exit;
        } else {
            $error = 'Gagal membuat database: ' . mysqli_error($conn_temp);
        }
        mysqli_close($conn_temp);
    }
}

// Step 2: Import SQL schema
if ($step == 2 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    global $conn;
    
    if (!$db_connected) {
        $error = 'Gagal terhubung ke database. Check konfigurasi di config.php';
    } else {
        $sql_file = __DIR__ . '/database.sql';
        
        if (!file_exists($sql_file)) {
            $error = 'File database.sql tidak ditemukan!';
        } else {
            $sql = file_get_contents($sql_file);
            
            // Split dan execute each SET statement
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            $imported = 0;
            $errors = 0;
            
            foreach ($statements as $statement) {
                if (!empty($statement) && substr(trim($statement), 0, 2) != '--') {
                    if (mysqli_query($conn, $statement . ';')) {
                        $imported++;
                    } else {
                        $errors++;
                    }
                }
            }
            
            if ($errors == 0) {
                $success = "Database schema berhasil diimport! ($imported queries dijalankan)";
                header('Location: install-db.php?step=3');
                exit;
            } else {
                $error = "Beberapa query gagal. Imported: $imported, Errors: $errors";
            }
        }
    }
}

// Step 3: Test connection
if ($step == 3 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    global $conn;
    
    if ($db_connected) {
        $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM majors");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['total'] == 8) {
                $success = 'Database siap digunakan! Ditemukan ' . $row['total'] . ' jurusan.';
            } else {
                $error = 'Data tidak lengkap. Ditemukan ' . $row['total'] . ' jurusan (seharusnya 8)';
            }
        } else {
            $error = 'Error querying database: ' . mysqli_error($conn);
        }
    } else {
        $error = 'Gagal terhubung ke database';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Database MySQL - Info Jurusan</title>
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
        .container {
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
            font-size: 28px;
        }
        .step-indicator {
            display: flex;
            gap: 20px;
            margin: 30px 0;
            justify-content: space-between;
        }
        .step {
            flex: 1;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            background: #f0f0f0;
            color: #999;
            font-weight: 600;
        }
        .step.active {
            background: #667eea;
            color: white;
        }
        .step.done {
            background: #4CAF50;
            color: white;
        }
        .message {
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef5350;
        }
        .success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #81c784;
        }
        .info {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #64b5f6;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            line-height: 1.6;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s;
        }
        button:hover {
            background: #764ba2;
        }
        .config-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-family: monospace;
            font-size: 13px;
            line-height: 1.8;
        }
        .config-info strong {
            color: #667eea;
        }
        a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚙️ Setup Database MySQL</h1>
        
        <div class="step-indicator">
            <div class="step <?php echo $step >= 1 ? ($step == 1 ? 'active' : 'done') : ''; ?>">
                1. Buat Database
            </div>
            <div class="step <?php echo $step >= 2 ? ($step == 2 ? 'active' : 'done') : ''; ?>">
                2. Import Schema
            </div>
            <div class="step <?php echo $step >= 3 ? ($step == 3 ? 'active' : 'done') : ''; ?>">
                3. Test Koneksi
            </div>
        </div>

        <?php if ($error): ?>
            <div class="message error">❌ <?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="message success">✅ <?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($step == 1): ?>
            <div class="info">
                <strong>Langkah 1: Buat Database</strong><br>
                Konfigurasi database saat ini:
            </div>
            <div class="config-info">
                <div><strong>Host:</strong> <?php echo DB_HOST; ?></div>
                <div><strong>User:</strong> <?php echo DB_USER; ?></div>
                <div><strong>Database:</strong> <?php echo DB_NAME; ?></div>
                <div><strong>Charset:</strong> utf8mb4</div>
            </div>
            <p>Klik tombol di bawah untuk membuat database MySQL dengan nama "<?php echo DB_NAME; ?>"</p>
            <form method="POST">
                <button type="submit">Buat Database</button>
            </form>
        <?php endif; ?>

        <?php if ($step == 2): ?>
            <div class="info">
                <strong>Langkah 2: Import Schema</strong><br>
                Database berhasil dibuat! Sekarang import schema tabel dan seed data...
            </div>
            <p>Klik tombol di bawah untuk mengimport schema database dan seed data awal</p>
            <form method="POST">
                <button type="submit">Import Database Schema</button>
            </form>
        <?php endif; ?>

        <?php if ($step == 3): ?>
            <div class="info">
                <strong>Langkah 3: Test Koneksi</strong><br>
                Schema database berhasil diimport! Sekarang test koneksi database...
            </div>
            <p>Klik tombol di bawah untuk test koneksi dan verifikasi data</p>
            <form method="POST">
                <button type="submit">Test Koneksi Database</button>
            </form>
        <?php endif; ?>

        <?php if ($step == 3 && !$error && $success): ?>
            <hr style="margin: 30px 0;">
            <h3 style="color: #2e7d32; margin-bottom: 20px;">✅ Setup Selesai!</h3>
            <p>Database MySQL Anda siap digunakan. Silahkan kunjungi:</p>
            <p><a href="<?php echo APP_URL; ?>">🏠 Kembali ke Beranda</a> | <a href="<?php echo APP_URL; ?>majors.php">📚 Lihat Daftar Jurusan</a></p>
        <?php endif; ?>

        <hr style="margin: 30px 0;">
        <p style="color: #999; font-size: 12px; text-align: center;">
            💾 Website Informasi Jurusan Sekolah - Menggunakan MySQL
        </p>
    </div>
</body>
</html>
