<?php
require_once __DIR__ . '/db.php';
include __DIR__ . '/header.php';

if (empty($_SESSION['user_id'])) {
    echo '<p>Please <a href="login.php">log in</a> to view your wishlist.</p>';
    include __DIR__ . '/footer.php';
    exit;
}

$pdo = get_db_connection();
$stmt = $pdo->prepare("SELECT p.id, p.name, p.description, p.price, p.image_path
                       FROM wishlist w
                       JOIN products p ON w.product_id = p.id
                       WHERE w.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$items = $stmt->fetchAll();
?>
<h2>My Wishlist</h2>
<?php if (!$items): ?>
    <p>You have no items in your wishlist yet.</p>
<?php else: ?>
    <div class="product-grid">
        <?php foreach ($items as $p): ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
                <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                <p class="price">£<?php echo number_format($p['price'], 2); ?></p>
                <p class="desc"><?php echo htmlspecialchars($p['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
