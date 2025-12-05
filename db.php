<?php
require_once __DIR__ . '/config.php';

function get_db_connection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        if (DB_DRIVER === 'mysql') {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            // If you have an SSL CA cert, enable this block:
            if (defined('DB_SSL_CA') && DB_SSL_CA && file_exists(DB_SSL_CA)) {
                $dsn .= ';sslmode=require';
                $options[PDO::MYSQL_ATTR_SSL_CA] = DB_SSL_CA;
            }

            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } else {
            throw new Exception("This template is built for MySQL via PDO.");
        }
    } catch (Exception $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    return $pdo;
}
?>
