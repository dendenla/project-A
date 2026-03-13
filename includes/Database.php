<?php
// includes/Database.php - Class untuk mengelola data (MySQL/File Storage)

class Database {
    private $conn;
    private $use_file_storage;
    private $data_dir;
    
    public function __construct() {
        global $conn, $db_connected, $USE_FILE_STORAGE;
        
        // Determine storage mode based on global configuration
        $this->use_file_storage = isset($USE_FILE_STORAGE) ? $USE_FILE_STORAGE : true;
        $this->data_dir = DATA_DIR;
        
        // Set connection - use MySQL only if connected and not in file mode
        if (!$this->use_file_storage && $db_connected && $conn instanceof mysqli) {
            $this->conn = $conn;
        } else {
            // Default to file storage
            $this->use_file_storage = true;
            $this->conn = null;
        }
        
        // Create data directory for file storage
        if (!is_dir($this->data_dir)) {
            mkdir($this->data_dir, 0755, true);
        }
    }
    
    /**
     * Check if MySQL connection is available
     */
    private function hasConnection() {
        return $this->conn instanceof mysqli && !$this->use_file_storage;
    }
    
    // ==================== MAJORS METHODS ====================
    
    public function getAllMajors() {
        if ($this->use_file_storage) {
            $file = $this->data_dir . 'majors.json';
            if (file_exists($file)) {
                return json_decode(file_get_contents($file), true) ?: [];
            }
            return [];
        }
        
        if (!$this->hasConnection()) {
            return [];
        }
        
        $query = "SELECT m.*, GROUP_CONCAT(DISTINCT ms.subject_name SEPARATOR '|') AS subjects,
                  GROUP_CONCAT(DISTINCT mp.practice_name SEPARATOR '|') AS practices,
                  GROUP_CONCAT(DISTINCT mc.career_name SEPARATOR '|') AS careers
                  FROM majors m
                  LEFT JOIN major_subjects ms ON m.id = ms.major_id
                  LEFT JOIN major_practices mp ON m.id = mp.major_id
                  LEFT JOIN major_careers mc ON m.id = mc.major_id
                  GROUP BY m.id ORDER BY m.id";
        
        $result = mysqli_query($this->conn, $query);
        $majors = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['subjects'] = $row['subjects'] ? explode('|', $row['subjects']) : [];
                $row['practices'] = $row['practices'] ? explode('|', $row['practices']) : [];
                $row['careers'] = $row['careers'] ? explode('|', $row['careers']) : [];
                $majors[] = $row;
            }
        }
        return $majors;
    }
    
    public function getMajorById($id) {
        if ($this->use_file_storage) {
            $majors = $this->getAllMajors();
            foreach ($majors as $major) {
                if ($major['id'] == $id) {
                    return $major;
                }
            }
            return null;
        }
        
        if (!$this->hasConnection()) {
            return null;
        }
        
        $id = intval($id);
        $query = "SELECT m.*, GROUP_CONCAT(DISTINCT ms.subject_name SEPARATOR '|') AS subjects,
                  GROUP_CONCAT(DISTINCT mp.practice_name SEPARATOR '|') AS practices,
                  GROUP_CONCAT(DISTINCT mc.career_name SEPARATOR '|') AS careers
                  FROM majors m
                  LEFT JOIN major_subjects ms ON m.id = ms.major_id
                  LEFT JOIN major_practices mp ON m.id = mp.major_id
                  LEFT JOIN major_careers mc ON m.id = mc.major_id
                  WHERE m.id = $id GROUP BY m.id";
        
        $result = mysqli_query($this->conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $row['subjects'] = $row['subjects'] ? explode('|', $row['subjects']) : [];
            $row['practices'] = $row['practices'] ? explode('|', $row['practices']) : [];
            $row['careers'] = $row['careers'] ? explode('|', $row['careers']) : [];
            return $row;
        }
        return null;
    }
    
    public function getMajorsByCategory($category) {
        if ($this->use_file_storage) {
            $majors = $this->getAllMajors();
            $result = [];
            foreach ($majors as $major) {
                if ($major['category'] == $category) {
                    $result[] = $major;
                }
            }
            return $result;
        }
        
        if (!$this->hasConnection()) {
            return [];
        }
        
        $category = mysqli_real_escape_string($this->conn, $category);
        $query = "SELECT m.*, GROUP_CONCAT(DISTINCT ms.subject_name SEPARATOR '|') AS subjects,
                  GROUP_CONCAT(DISTINCT mp.practice_name SEPARATOR '|') AS practices,
                  GROUP_CONCAT(DISTINCT mc.career_name SEPARATOR '|') AS careers
                  FROM majors m
                  LEFT JOIN major_subjects ms ON m.id = ms.major_id
                  LEFT JOIN major_practices mp ON m.id = mp.major_id
                  LEFT JOIN major_careers mc ON m.id = mc.major_id
                  WHERE m.category = '$category' GROUP BY m.id ORDER BY m.id";
        
        $result = mysqli_query($this->conn, $query);
        $majors = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['subjects'] = $row['subjects'] ? explode('|', $row['subjects']) : [];
                $row['practices'] = $row['practices'] ? explode('|', $row['practices']) : [];
                $row['careers'] = $row['careers'] ? explode('|', $row['careers']) : [];
                $majors[] = $row;
            }
        }
        return $majors;
    }
    
    // ==================== FORUM METHODS ====================
    
    public function getAllThreads() {
        if ($this->use_file_storage) {
            $file = $this->data_dir . 'threads.json';
            if (file_exists($file)) {
                return json_decode(file_get_contents($file), true) ?: [];
            }
            return [];
        }
        
        if (!$this->hasConnection()) {
            return [];
        }
        
        $query = "SELECT ft.*, COUNT(fr.id) AS replies FROM forum_threads ft 
                  LEFT JOIN forum_replies fr ON ft.id = fr.thread_id 
                  GROUP BY ft.id ORDER BY ft.created_at DESC";
        
        $result = mysqli_query($this->conn, $query);
        $threads = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $threads[] = $row;
            }
        }
        return $threads;
    }
    
    public function getThreadById($id) {
        if ($this->use_file_storage) {
            $threads = $this->getAllThreads();
            foreach ($threads as $thread) {
                if ($thread['id'] == $id) {
                    return $thread;
                }
            }
            return null;
        }
        
        if (!$this->hasConnection()) {
            return null;
        }
        
        $id = intval($id);
        $query = "SELECT ft.*, COUNT(fr.id) AS replies FROM forum_threads ft 
                  LEFT JOIN forum_replies fr ON ft.id = fr.thread_id 
                  WHERE ft.id = $id GROUP BY ft.id";
        
        $result = mysqli_query($this->conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }
    
    public function getThreadReplies($thread_id) {
        if ($this->use_file_storage) {
            $file = $this->data_dir . 'replies_' . intval($thread_id) . '.json';
            if (file_exists($file)) {
                return json_decode(file_get_contents($file), true) ?: [];
            }
            return [];
        }
        
        if (!$this->hasConnection()) {
            return [];
        }
        
        $thread_id = intval($thread_id);
        $query = "SELECT * FROM forum_replies WHERE thread_id = $thread_id ORDER BY created_at ASC";
        
        $result = mysqli_query($this->conn, $query);
        $replies = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $replies[] = $row;
            }
        }
        return $replies;
    }
    
    public function addThread($title, $category, $content, $author) {
        if ($this->use_file_storage) {
            return $this->addThreadFile($title, $category, $content, $author);
        }
        
        if (!$this->hasConnection()) {
            return $this->addThreadFile($title, $category, $content, $author);
        }
        
        $title = mysqli_real_escape_string($this->conn, sanitize($title));
        $category = mysqli_real_escape_string($this->conn, sanitize($category));
        $content = mysqli_real_escape_string($this->conn, sanitize($content));
        $author = mysqli_real_escape_string($this->conn, sanitize($author));
        
        $query = "INSERT INTO forum_threads (title, category, content, author, views, created_at) 
                  VALUES ('$title', '$category', '$content', '$author', 0, NOW())";
        
        if (mysqli_query($this->conn, $query)) {
            $thread_id = mysqli_insert_id($this->conn);
            return $this->getThreadById($thread_id);
        }
        return null;
    }
    
    public function addReply($thread_id, $author, $content) {
        if ($this->use_file_storage) {
            return $this->addReplyFile($thread_id, $author, $content);
        }
        
        if (!$this->hasConnection()) {
            return $this->addReplyFile($thread_id, $author, $content);
        }
        
        $author = mysqli_real_escape_string($this->conn, sanitize($author));
        $content = mysqli_real_escape_string($this->conn, sanitize($content));
        $thread_id = intval($thread_id);
        
        $query = "INSERT INTO forum_replies (thread_id, author, content, created_at) 
                  VALUES ($thread_id, '$author', '$content', NOW())";
        
        if (mysqli_query($this->conn, $query)) {
            $reply_id = mysqli_insert_id($this->conn);
            $result = mysqli_query($this->conn, "SELECT * FROM forum_replies WHERE id = $reply_id");
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            }
        }
        return null;
    }
    
    public function incrementViews($thread_id) {
        if ($this->use_file_storage) {
            return;
        }
        
        if (!$this->hasConnection()) {
            return;
        }
        
        $thread_id = intval($thread_id);
        $query = "UPDATE forum_threads SET views = views + 1 WHERE id = $thread_id";
        mysqli_query($this->conn, $query);
    }
    
    public function searchThreads($keyword) {
        if ($this->use_file_storage) {
            return $this->searchThreadsFile($keyword);
        }
        
        if (!$this->hasConnection()) {
            return $this->searchThreadsFile($keyword);
        }
        
        $keyword = mysqli_real_escape_string($this->conn, $keyword);
        $query = "SELECT ft.*, COUNT(fr.id) AS replies FROM forum_threads ft 
                  LEFT JOIN forum_replies fr ON ft.id = fr.thread_id 
                  WHERE ft.title LIKE '%$keyword%' OR ft.content LIKE '%$keyword%'
                  GROUP BY ft.id ORDER BY ft.created_at DESC";
        
        $result = mysqli_query($this->conn, $query);
        $threads = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $threads[] = $row;
            }
        }
        return $threads;
    }
    
    // ==================== FILE STORAGE HELPER METHODS ====================
    
    private function addThreadFile($title, $category, $content, $author) {
        $threads = $this->getAllThreads();
        $new_id = count($threads) > 0 ? max(array_column($threads, 'id')) + 1 : 1;
        
        $thread = [
            'id' => $new_id,
            'title' => sanitize($title),
            'category' => sanitize($category),
            'content' => sanitize($content),
            'author' => sanitize($author),
            'date' => date('d-m-Y H:i'),
            'created_at' => date('Y-m-d H:i:s'),
            'replies' => 0,
            'views' => 0
        ];
        
        array_unshift($threads, $thread);
        file_put_contents($this->data_dir . 'threads.json', json_encode($threads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return $thread;
    }
    
    private function addReplyFile($thread_id, $author, $content) {
        $file = $this->data_dir . 'replies_' . intval($thread_id) . '.json';
        $replies = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        
        $new_id = count($replies) > 0 ? max(array_column($replies, 'id')) + 1 : 1;
        
        $reply = [
            'id' => $new_id,
            'author' => sanitize($author),
            'content' => sanitize($content),
            'date' => date('d-m-Y H:i'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        array_push($replies, $reply);
        file_put_contents($file, json_encode($replies, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        // Update thread replies count
        $threads = $this->getAllThreads();
        foreach ($threads as &$thread) {
            if ($thread['id'] == $thread_id) {
                $thread['replies'] = count($replies);
                break;
            }
        }
        file_put_contents($this->data_dir . 'threads.json', json_encode($threads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return $reply;
    }
    
    private function searchThreadsFile($keyword) {
        $threads = $this->getAllThreads();
        $result = [];
        $keyword = strtolower($keyword);
        
        foreach ($threads as $thread) {
            if (strpos(strtolower($thread['title']), $keyword) !== false || 
                strpos(strtolower($thread['content']), $keyword) !== false) {
                $result[] = $thread;
            }
        }
        
        return $result;
    }
}
?>
