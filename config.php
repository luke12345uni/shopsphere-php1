<?php
// =============================
// ShopSphere Global Configuration
// =============================

// Database connection settings (from App Service settings)
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'mysql');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'shopsphere_db');
define('DB_USER', getenv('DB_USER') ?: 'Cmet1999');
define('DB_PASS', getenv('DB_PASS') ?: '');

// =============================
// SSL Certificate Path for Azure MySQL
// =============================

// IMPORTANT: This file must exist in /site/wwwroot/certs/ after deployment
define('DB_SSL_CA', __DIR__ . '/certs/DigiCertGlobalRootG2.crt.pem');

// =============================
// Azure Payment Function
// =============================
define('PAYMENT_FUNCTION_URL', getenv('PAYMENT_FUNCTION_URL') ?: 
    'https://your-function-url.azurewebsites.net/api/payment_authorize');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
