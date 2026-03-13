<?php
// config.php - Konfigurasi database dan aplikasi

// =============== DATABASE CONFIGURATION ===============
// Pilih mode storage: 'mysql' atau 'file'
define('DB_MODE', 'mysql'); // Ubah ke 'file' jika ingin menggunakan file JSON

// MySQL Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'info_jurusan');
define('DB_PORT', 3306);

// File Storage Configuration (untuk backup)
define('DATA_DIR', __DIR__ . '/data/');

// Initialize Database Connection
$conn = null;
$db_connected = false;

if (DB_MODE === 'mysql') {
    // Coba koneksi MySQL dengan error handling
    try {
        $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        
        if ($conn && mysqli_select_db($conn, DB_NAME)) {
            mysqli_set_charset($conn, "utf8mb4");
            define('USE_FILE_STORAGE', false);
            $db_connected = true;
        } else {
            throw new Exception('Database connection failed');
        }
    } catch (Exception $e) {
        // Jika MySQL gagal (termasuk database belum exist), fallback ke file storage
        define('USE_FILE_STORAGE', true);
        $db_connected = false;
        $conn = null;
        
        // Buat direktori jika belum ada
        if (!is_dir(DATA_DIR)) {
            mkdir(DATA_DIR, 0755, true);
        }
    }
} else {
    // Gunakan file storage
    define('USE_FILE_STORAGE', true);
    
    // Buat direktori jika belum ada
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0755, true);
    }
}

// Application Settings
define('APP_NAME', 'Info Jurusan');
define('APP_URL', 'http://localhost/project-A/');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

// Session configuration
session_start();

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Helper Functions
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function redirect($page) {
    header("Location: " . APP_URL . $page);
    exit();
}

function is_ajax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function json_response($data, $status = 200) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit();
}
?>
