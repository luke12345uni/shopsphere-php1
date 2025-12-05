<?php
echo "<h2>Testing MySQL Connection...</h2>";

$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");
$ssl  = "/site/wwwroot/certs/DigiCertGlobalRootG2.crt.pem"; // SSL certificate you uploaded

echo "Host: $host<br>";
echo "User: $user<br>";
echo "Database: $db<br><br>";

$mysqli = mysqli_init();

// Enable SSL
mysqli_ssl_set($mysqli, NULL, NULL, $ssl, NULL, NULL);

// Try connection
if (!mysqli_real_connect($mysqli, $host, $user, $pass, $db, 3306, NULL, MYSQLI_CLIENT_SSL)) {
    echo "<b>Connection failed:</b> " . mysqli_connect_error();
    exit;
}

echo "<b style='color:green;'>Connection successful!</b><br><br>";

// Show tables
$result = $mysqli->query("SHOW TABLES");

echo "<h3>Tables in database:</h3>";
echo "<pre>";
while ($row = $result->fetch_array()) {
    print_r($row);
}
echo "</pre>";

$mysqli->close();
?>
