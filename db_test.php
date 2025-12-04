<?php
echo "<h2>Testing MySQL Connection...</h2>";

$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");

echo "<p><strong>Host:</strong> $host</p>";
echo "<p><strong>User:</strong> $user</p>";
echo "<p><strong>Database:</strong> $db</p>";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "<p style='color:red;'>❌ Connection failed: " . mysqli_connect_error() . "</p>";
    exit;
}

echo "<p style='color:green;'>✅ Connected successfully!</p>";

$result = mysqli_query($conn, "SHOW TABLES;");
echo "<h3>Tables in database:</h3>";
echo "<ul>";
while ($row = mysqli_fetch_row($result)) {
    echo "<li>" . $row[0] . "</li>";
}
echo "</ul>";

mysqli_close($conn);
?>
