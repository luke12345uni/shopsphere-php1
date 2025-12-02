<?php
require_once __DIR__ . '/db.php';
include __DIR__ . '/header.php';

if (empty($_SESSION['user_id'])) {
    echo '<p>Please <a href="login.php">log in</a> to checkout.</p>';
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
<h2>Checkout</h2>
<?php if (!$items): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <p>Total amount: <strong>£<?php echo number_format($total, 2); ?></strong></p>
    <form method="post" action="api/place_order.php" class="form-card">
        <label>Select Payment Method</label>
        <select name="payment_method" required>
            <option value="card">Credit / Debit Card</option>
            <option value="paypal">PayPal</option>
            <option value="wallet">Wallet</option>
        </select>
        <button type="submit" class="btn-primary">Confirm & Pay</button>
    </form>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
