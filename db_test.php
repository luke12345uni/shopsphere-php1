<?php
require_once __DIR__ . '/db.php';

echo "<h1>Testing Azure MySQL Connection...</h1>";

try {
    $db = get_db_connection();
    echo "<p style='color:green;'>✔ Connected successfully!</p>";

    // Test: list tables
    $tables = $db->query("SHOW TABLES")->fetchAll();
    echo "<h2>Tables:</h2><pre>";
    print_r($tables);
    echo "</pre>";

    // Test: query products table
    echo "<h2>Products:</h2><pre>";
    $products = $db->query("SELECT id, name, price FROM products")->fetchAll();
    print_r($products);
    echo "</pre>";

} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
