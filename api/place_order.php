<?php
require_once __DIR__ . '/../db.php';

if (empty($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'] ?? 'card';
    $pdo = get_db_connection();

    $stmt = $pdo->prepare("SELECT c.product_id, p.price, c.quantity
                           FROM cart_items c
                           JOIN products p ON c.product_id = p.id
                           WHERE c.user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $items = $stmt->fetchAll();

    if (!$items) {
        $_SESSION['error'] = "Cart is empty.";
        header("Location: /cart.php");
        exit;
    }

    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $payload = json_encode([
        'amount' => $total,
        'method' => $payment_method,
        'user'   => $_SESSION['user_id']
    ]);

    $ch = curl_init(PAYMENT_FUNCTION_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 || !$response) {
        $_SESSION['error'] = "Payment service unavailable. Please try again.";
        header("Location: /checkout.php");
        exit;
    }

    $data = json_decode($response, true);
    if (($data['status'] ?? '') !== 'approved') {
        $_SESSION['error'] = "Payment declined: " . ($data['message'] ?? 'Unknown reason');
        header("Location: /checkout.php");
        exit;
    }

    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, status, created_at) VALUES (?, ?, 'Processing', NOW())");
        $stmt->execute([$_SESSION['user_id'], $total]);
        $orderId = $pdo->lastInsertId();

        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmtItem->execute([$orderId, $item['product_id'], $item['quantity'], $item['price']]);
        }

        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Order failed: " . $e->getMessage();
        header("Location: /checkout.php");
        exit;
    }

    header("Location: /order_success.php");
    exit;
}
?>
