<?php
require_once __DIR__ . '/config.php';

function get_db_connection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_SSL_CA => DB_SSL_CERT,   // SSL required for Azure
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        ];

        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (Exception $e) {
        die("<h3>Database connection failed:</h3><pre>" . $e->getMessage() . "</pre>");
    }

    return $pdo;
}
?>
