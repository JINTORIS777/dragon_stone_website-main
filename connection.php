<?php
// connection.php - centralized DB connection helper for pages in project root
$cfg = __DIR__ . DIRECTORY_SEPARATOR . 'server' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($cfg)) {
    require_once $cfg;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    if (function_exists('db_connect')) {
        $conn = db_connect();
    } elseif (defined('DB_HOST') && defined('DB_USER') && defined('DB_NAME')) {
        try {
            $port = defined('DB_PORT') ? DB_PORT : 3306;
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, $port);
            if ($conn->connect_error) {
                error_log('DB Connect error: ' . $conn->connect_error);
                $conn = false;
            }
        } catch (Exception $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            $conn = false;
        }
    }
}

// Helper function to check if database is available
function is_db_available() {
    global $conn;
    return $conn && $conn instanceof mysqli && !$conn->connect_error;
}
