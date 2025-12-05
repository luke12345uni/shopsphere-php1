<?php

session_start();

// Load env vars
$DB_HOST = getenv("DB_HOST");
$DB_USER = getenv("DB_USER");
$DB_PASS = getenv("DB_PASS");
$DB_NAME = getenv("DB_NAME");
$DB_SSL  = "/site/wwwroot/certs/DigiCertGlobalRootG2.crt.pem"; // your actual cert name

// Azure-required MySQL SSL connection
function getDBConnection() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_SSL;

    $con = mysqli_init();

    // REQUIRED FOR AZURE MySQL FLEXIBLE SERVER
    mysqli_ssl_set($con, NULL, NULL, $DB_SSL, NULL, NULL);

    mysqli_real_connect(
        $con,
        $DB_HOST,
        $DB_USER,
        $DB_PASS,
        $DB_NAME,
        3306,
        NULL,
        MYSQLI_CLIENT_SSL
    );

    if (mysqli_connect_errno()) {
        die("MySQL Connection failed: " . mysqli_connect_error());
    }

    return $con;
}
?>
