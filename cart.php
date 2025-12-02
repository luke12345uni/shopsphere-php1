<?php
require_once __DIR__ . '/db.php';
include __DIR__ . '/header.php';

if (empty($_SESSION['user_id'])) {
    echo '<p>Please <a href="login.php">log in</a> to view your cart.</p>';
    include __DIR__ . '/footer.php';
    exit;
}

$pdo = get_db_connection();
$stmt = $pdo->prepare("SELECT c.id, p.name, p.price, c.quantity
                       FROM cart_items c
                       JOIN products p ON c.product_id = p.id
                       WHERE c.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$items = $stmt->fetchAll();

$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<h2>My Cart</h2>
<?php if (!$items): ?>
    <p>Your cart is empty. <a href="products.php">Browse products</a>.</p>
<?php else: ?>
    <table class="data-table">
        <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td>£<?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo (int)$item['quantity']; ?></td>
                <td>£<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
            <td><strong>£<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </table>
    <a href="checkout.php" class="btn-primary">Proceed to Checkout</a>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
