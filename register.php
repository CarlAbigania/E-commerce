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
    <title>Register - ShopFree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1abc9c, #3498db);
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            position: relative;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-animation span {
            position: absolute;
            display: block;
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.1);
            animation: animate 20s linear infinite;
        }

        .background-animation span:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.2);
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(-2000px) rotate(720deg);
            }
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .form-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #27ae60;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            background: #f4f4f9;
            border-radius: 8px;
            padding: 10px;
            position: relative;
        }

        .input-field i {
            margin-right: 10px;
            color: #27ae60;
        }

        input {
            border: none;
            background: transparent;
            outline: none;
            flex: 1;
            padding: 10px;
        }

        .toggle-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .btn {
            background-color: #27ae60;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #229954;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .success {
            color: red;
            margin-bottom: 15px;
        }

        .login-link {
            margin-top: 20px;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="background-animation">
        <?php for ($i = 0; $i < 50; $i++) : ?>
            <span style="left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%;"></span>
        <?php endfor; ?>
    </div>

    <div class="form-container">
        <h2>Create Account</h2>
        <?php if (isset($message) && !empty($message)) : ?>
            <p class="<?= strpos($message, 'failed') === false ? 'success' : 'error' ?>"><?= $message ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-icon" id="togglePassword"></i>
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required>
                <i class="fas fa-eye toggle-icon" id="toggleConfirmPassword"></i>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordField = document.getElementById('confirmPassword');

        togglePassword.addEventListener('click', function(e) {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function(e) {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);

            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>