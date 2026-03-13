<?php
// api/create-thread.php - API untuk membuat topik baru

include $_SERVER['DOCUMENT_ROOT'] . '/project-A/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project-A/includes/Database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    json_response(['success' => false, 'message' => 'Invalid request method'], 400);
}

// Get POST data
$title = isset($_POST['title']) ? $_POST['title'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$author = isset($_POST['author']) ? $_POST['author'] : '';

// Validate inputs
if (empty($title) || empty($category) || empty($content) || empty($author)) {
    json_response(['success' => false, 'message' => 'Semua field harus diisi'], 400);
}

try {
    $db = new Database();
    $thread = $db->addThread($title, $category, $content, $author);
    
    json_response([
        'success' => true,
        'message' => 'Topik berhasil dibuat',
        'thread_id' => $thread['id']
    ]);
} catch (Exception $e) {
    json_response(['success' => false, 'message' => $e->getMessage()], 500);
}
?>
