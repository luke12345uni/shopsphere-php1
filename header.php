<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShopSphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a href="/index.php" class="logo">ShopSphere</a>
        <nav>
            <a href="/products.php">Products</a>
            <a href="/wishlist.php">Wishlist</a>
            <a href="/cart.php">Cart</a>
            <a href="/my_orders.php">My Orders</a>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <span class="nav-user">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="/logout.php" class="btn-link">Logout</a>
            <?php else: ?>
                <a href="/login.php" class="btn-link">Login</a>
                <a href="/register.php" class="btn-primary">Sign Up</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="page">
    <div class="container">
