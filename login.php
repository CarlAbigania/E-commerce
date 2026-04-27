<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: customer/products.php");
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ShopFree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>
    <div class="bg-mesh"></div>
    <div class="bg-shapes">
        <?php for ($i = 0; $i < 5; $i++) : ?>
            <span style="width: <?= rand(100, 300) ?>px; height: <?= rand(100, 300) ?>px; left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%; animation-delay: <?= $i * 2 ?>s;"></span>
        <?php endfor; ?>
    </div>

    <div class="auth-container">
        <div class="auth-header">
            <h1>Welcome Back</h1>
            <p>Please enter your details to sign in</p>
        </div>

        <?php if (isset($error)) : ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <i class="fas fa-user prefix-icon"></i>
                    <input type="text" name="username" id="username" placeholder="Enter your username" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock prefix-icon"></i>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-pwd" id="togglePassword"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">Sign In</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="register.php">Create one for free</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>