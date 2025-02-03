<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to ShopFree</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #1abc9c, #3498db);
            color: #fff;
        }

         /* Background-animation style */
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

        /* Hero section styles */
        .hero {
            text-align: center;
            padding: 80px 20px;
            animation: fadeIn 2s ease-in-out;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 15px;
            text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.4rem;
            max-width: 700px;
            margin: 0 auto 40px auto;
            line-height: 1.5;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY
                (-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .hero-buttons a {
            text-decoration: none;
            background-color: #e74c3c;
            padding: 15px 35px;
            border-radius: 50px;
            color: #fff;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons a:hover {
            background-color: #c0392b;
            transform: translateY(-5px);
        }

        .logo {
            font-size: 2.5rem;
            margin-bottom: 60px;
            color: #f1c40f;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            animation: slideIn 1.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Background-Animation -->
    <div class="background-animation">
        <?php for ($i = 0; $i < 50; $i++) : ?>
            <span style="left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%;"></span>
        <?php endfor; ?>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <div class="logo">ShopFree</div>
        <h1>Welcome to ShopFree</h1>
        <p>Your one-stop destination for the best deals and products. Shop with confidence and enjoy seamless online shopping!</p>
        <div class="hero-buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 ShopFree. All rights reserved.</p>
    </footer>
</body>

</html>