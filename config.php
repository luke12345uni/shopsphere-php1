<?php
// Global configuration for ShopSphere

// DB driver: 'mysql' expected
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'mysql');

// These must match your App Service settings:
define('DB_HOST', getenv('DB_HOST') ?: 'lukedb.mysql.database.azure.com');
define('DB_NAME', getenv('DB_NAME') ?: 'shopsphere_db');
define('DB_USER', getenv('DB_USER') ?: 'Cmet1999');
define('DB_PASS', getenv('DB_PASS') ?: 'YourStrongPasswordHere');

// Optional: Azure Function payment URL
define('PAYMENT_FUNCTION_URL', getenv('PAYMENT_FUNCTION_URL') ?: 'https://your-function-app.azurewebsites.net/api/payment_authorize');

// SSL certificate for Azure MySQL (only if you uploaded it)
define('DB_SSL_CA', __DIR__ . '/certs/MysqlflexGlobalRootCA.crt.pem'); // adjust path if needed

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
