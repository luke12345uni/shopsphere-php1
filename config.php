<?php
// ShopSphere PHP Configuration

// Database settings (from Azure App Settings)
define('DB_HOST', getenv('DB_HOST') ?: 'lukedb.mysql.database.azure.com');
define('DB_NAME', getenv('DB_NAME') ?: 'shopsphere_db');

// IMPORTANT: Correct username format for Azure Flexible Server
define('DB_USER', getenv('DB_USER') ?: 'Cmet1999');

// Password from App Settings
define('DB_PASS', getenv('DB_PASS') ?: 'YOURPASSWORD');

// Path to SSL certificate (uploaded to /certs/)
define('DB_SSL_CA', __DIR__ . '/certs/DigiCertGlobalRootG2.crt.pem');

// Create a global mysqli connection function
function db_connect() {
    $con = mysqli_init();

    // Enable SSL for Azure MySQL
    mysqli_ssl_set($con, NULL, NULL, DB_SSL_CA, NULL, NULL);

    // Connect
    $success = mysqli_real_connect(
        $con,
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME,
        3306,
        NULL,
        MYSQLI_CLIENT_SSL
    );

    if (!$success) {
        die("MySQL Connection Failed: " . mysqli_connect_error());
    }

    return $con;
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
