<?php
// Global configuration for ShopSphere

// DB driver: 'mysql' expected for this template
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'mysql');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'ShopSphereDB');
define('DB_USER', getenv('DB_USER') ?: 'shopsphere_user');
define('DB_PASS', getenv('DB_PASS') ?: 'YourStrongPasswordHere');

// Azure Function payment URL
define('PAYMENT_FUNCTION_URL', getenv('PAYMENT_FUNCTION_URL') ?: 'https://your-function-app.azurewebsites.net/api/payment_authorize');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
