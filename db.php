<?php
require_once("config.php");

echo "<h2>Testing Azure MySQL Connection...</h2>";

$con = getDBConnection();

if ($con) {
    echo "<p style='color:green;'>✔ Connected successfully!</p>";

    $result = mysqli_query($con, "SHOW TABLES;");
    if ($result) {
        echo "<h3>Tables:</h3>";
        while ($row = mysqli_fetch_array($result)) {
            echo $row[0] . "<br>";
        }
    }
}
?>
