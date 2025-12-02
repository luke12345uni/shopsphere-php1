<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($full_name && $email && $password) {
        $pdo = get_db_connection();
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Email already registered.";
            header("Location: register.php");
            exit;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$full_name, $email, $hash]);
        $_SESSION['success'] = "Account created. Please log in.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "All fields are required.";
        header("Location: register.php");
        exit;
    }
}
?>
