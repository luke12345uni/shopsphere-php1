<?php
// ShopSphere Global Configuration

// Database credentials from Azure App Service Settings
define('DB_DRIVER', 'mysql');
define('DB_HOST', getenv('DB_HOST'));       // lukedb.mysql.database.azure.com
define('DB_NAME', getenv('DB_NAME'));       // shopsphere_db
define('DB_USER', getenv('DB_USER'));       // Cmet1999
define('DB_PASS', getenv('DB_PASS'));       // your password

// SSL Certificate Path (must exist in your deployed Web App)
define('DB_SSL_CERT', __DIR__ . '/certs/DigiCertGlobalRootG2.crt.pem');

// Azure Function URL (optional for now)
define('PAYMENT_FUNCTION_URL', '/payment_authorize.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
