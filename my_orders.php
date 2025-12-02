<?php
require_once __DIR__ . '/db.php';
include __DIR__ . '/header.php';

if (empty($_SESSION['user_id'])) {
    echo '<p>Please <a href="login.php">log in</a> to view your orders.</p>';
    include __DIR__ . '/footer.php';
    exit;
}

$pdo = get_db_connection();
$stmt = $pdo->prepare("SELECT id, total_amount, status, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();
?>
<h2>My Orders</h2>
<?php if (!$orders): ?>
    <p>You have not placed any orders yet.</p>
<?php else: ?>
    <table class="data-table">
        <tr><th>Order ID</th><th>Total</th><th>Status</th><th>Date</th></tr>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td>#<?php echo (int)$o['id']; ?></td>
                <td>£<?php echo number_format($o['total_amount'], 2); ?></td>
                <td><?php echo htmlspecialchars($o['status']); ?></td>
                <td><?php echo htmlspecialchars($o['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
