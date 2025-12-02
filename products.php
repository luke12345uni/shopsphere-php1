<?php
require_once __DIR__ . '/db.php';
include __DIR__ . '/header.php';

$pdo = get_db_connection();
$stmt = $pdo->query("SELECT id, name, description, price, stock, image_path FROM products");
$products = $stmt->fetchAll();
?>
<h2>Products</h2>
<div class="product-grid">
    <?php foreach ($products as $p): ?>
        <div class="product-card">
            <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
            <p class="price">£<?php echo number_format($p['price'], 2); ?></p>
            <p class="desc"><?php echo htmlspecialchars($p['description']); ?></p>
            <p class="stock"><?php echo (int)$p['stock']; ?> in stock</p>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <form method="post" action="api/add_to_cart.php" class="inline-form">
                    <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                    <button class="btn-secondary" type="submit">Add to Cart</button>
                </form>
                <form method="post" action="api/add_to_wishlist.php" class="inline-form">
                    <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                    <button class="btn-link" type="submit">♡ Wishlist</button>
                </form>
            <?php else: ?>
                <p class="muted">Login to add to cart or wishlist.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/footer.php'; ?>
