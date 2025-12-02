<?php include __DIR__ . '/header.php'; ?>
<h2>Login</h2>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>
<form method="post" action="login_process.php" class="form-card">
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit" class="btn-primary">Login</button>
</form>
<?php include __DIR__ . '/footer.php'; ?>
