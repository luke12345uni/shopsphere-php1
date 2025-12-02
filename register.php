<?php include __DIR__ . '/header.php'; ?>
<h2>Create an Account</h2>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
<?php endif; ?>
<form method="post" action="register_process.php" class="form-card">
    <label>Full Name</label>
    <input type="text" name="full_name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit" class="btn-primary">Register</button>
</form>
<?php include __DIR__ . '/footer.php'; ?>
