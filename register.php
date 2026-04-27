<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $message = '';

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $message = "Username already taken.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'customer')");
            if ($stmt->execute([$username, $hashedPassword])) {
                header("Location: login.php");
                exit;
            } else {
                $message = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ShopFree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/auth.css">
    <style>
        :root {
            --primary: #27ae60;
            --primary-dark: #229954;
        }
    </style>
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
            <h1>Create Account</h1>
            <p>Join us today and start shopping</p>
        </div>

        <?php if (isset($message) && !empty($message)) : ?>
            <div class="alert <?= strpos($message, 'failed') === false && strpos($message, 'taken') === false && strpos($message, 'match') === false ? 'alert-success' : 'alert-error' ?>">
                <i class="fas <?= strpos($message, 'failed') === false && strpos($message, 'taken') === false && strpos($message, 'match') === false ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i> <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <i class="fas fa-user prefix-icon"></i>
                    <input type="text" name="username" id="username" placeholder="Choose a username" required>
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

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock prefix-icon"></i>
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-pwd" id="toggleConfirmPassword"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">Sign Up</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Sign in here</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordField = document.getElementById('confirmPassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>