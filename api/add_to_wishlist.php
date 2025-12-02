<?php
require_once __DIR__ . '/../db.php';

if (empty($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)($_POST['product_id'] ?? 0);
    if ($product_id > 0) {
        $pdo = get_db_connection();
        $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$_SESSION['user_id'], $product_id]);
        if (!$stmt->fetch()) {
            $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, product_id, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$_SESSION['user_id'], $product_id]);
        }
    }
}
header("Location: /wishlist.php");
exit;
?>
