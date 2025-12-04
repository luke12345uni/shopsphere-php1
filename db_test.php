<?php
echo "<h2>Testing MySQL Connection...</h2>";

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = 3306;

// SSL certificate required by Azure
$ssl_ca = __DIR__ . "/DigiCertGlobalRootCA.crt.pem";

echo "Host: $host<br>";
echo "User: $user<br>";
echo "Database: $db<br><br>";

$conn = mysqli_init();

mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

if (!mysqli_real_connect(
        $conn,
        $host,
        $user,
        $pass,
        $db,
        $port,
        NULL,
        MYSQLI_CLIENT_SSL
    )) {

    die("<strong>Connection failed:</strong> " . mysqli_connect_error());
}

echo "<strong>SUCCESS! Connected to Azure MySQL.</strong>";
?>
