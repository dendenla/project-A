<?php
// includes/header.php - Header template

include __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>assets/css/navbar.css">
    <?php if (isset($extra_css)): ?>
        <link rel="stylesheet" href="<?php echo APP_URL; ?>assets/css/<?php echo $extra_css; ?>">
    <?php endif; ?>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h1>📚 Info Jurusan</h1>
                <button class="mobile-toggle">☰</button>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo APP_URL; ?>index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Beranda</a></li>
                <li><a href="<?php echo APP_URL; ?>majors.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'majors.php' ? 'active' : ''; ?>">Jurusan</a></li>
                <li><a href="<?php echo APP_URL; ?>forum.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'forum.php' ? 'active' : ''; ?>">Forum Diskusi</a></li>
                <li><a href="<?php echo APP_URL; ?>index.php#contact">Hubungi Kami</a></li>
            </ul>
        </div>
    </nav>
