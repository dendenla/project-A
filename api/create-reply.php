<?php
// api/create-reply.php - API untuk membuat balasan

include $_SERVER['DOCUMENT_ROOT'] . '/project-A/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project-A/includes/Database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    json_response(['success' => false, 'message' => 'Invalid request method'], 400);
}

// Get POST data
$thread_id = isset($_POST['thread_id']) ? intval($_POST['thread_id']) : 0;
$author = isset($_POST['author']) ? $_POST['author'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

// Validate inputs
if (empty($thread_id) || empty($author) || empty($content)) {
    json_response(['success' => false, 'message' => 'Semua field harus diisi'], 400);
}

try {
    $db = new Database();
    
    // Check if thread exists
    $thread = $db->getThreadById($thread_id);
    if (!$thread) {
        json_response(['success' => false, 'message' => 'Topik tidak ditemukan'], 404);
    }
    
    // Add reply
    $reply = $db->addReply($thread_id, $author, $content);
    
    json_response([
        'success' => true,
        'message' => 'Balasan berhasil ditambahkan',
        'reply_id' => $reply['id']
    ]);
} catch (Exception $e) {
    json_response(['success' => false, 'message' => $e->getMessage()], 500);
}
?>
