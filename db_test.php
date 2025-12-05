<?php
require_once "config.php";

echo "<h2>Testing MySQL Connection...</h2>";

$con = db_connect();

echo "<p>Connected successfully!</p>";

$res = $con->query("SELECT * FROM products");

echo "<h3>Products:</h3>";

while ($row = $res->fetch_assoc()) {
    echo $row['name'] . " - £" . $row['price'] . "<br>";
}
?>
