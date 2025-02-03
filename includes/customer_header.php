<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../landing_page.php");
    exit;
}
$username = $_SESSION['username'];
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopFree - Customer Panel</title>
    <style>
        /* Reset and general styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .header {
            background: linear-gradient(90deg, #3498db, #8e44ad);
            padding: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 2.5rem;
            display: inline-block;
            vertical-align: middle;
        }

        .header img {
            height: 60px;
            vertical-align: middle;
            margin-right: 15px;
            border-radius: 40px;
        }

        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #8e44ad;
            transform: translateY(-2px);
        }

        .welcome-message {
            margin-left: auto;
            font-weight: bold;
        }

        .cart-icon {
            display: flex;
            align-items: center;
            position: relative;
        }

        .cart-icon svg {
            width: 24px;
            height: 21px;
            margin-right: 8px;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="../assets/logo.webp" alt="ShopFree Logo">
        <h1>ShopFree Customer Panel</h1>
        <div class="nav">
            <a href="../customer/products.php" class="btn">Shop</a>
            <a href="../customer/orders.php" class="btn">My Orders</a>

            <a href="../customer/cart.php" class="btn cart-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                    <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zM7.062 14l.938-2h8.197l1.528 3h-10.663zm10.301-5h-9.364l-.984-2h11.667l-1.319 2zm-10.92 2h9.656l-.664 2h-9.324l.332-.8.666-1.2zm-4.443 0h3.083l2.859 5h10.941l-1.719-3.375c-.175-.343-.568-.563-.984-.563h-9.401l-.633 1.152-.792 1.823h-2.049v2h2c.027 0 .054 0 .08-.001l.08-.001h11.296c.328 0 .627-.195.751-.486l2.377-4.658c.093-.182.148-.381.148-.585v-4h-14v4zm14 4h-12v-4h12v4z"/>
                </svg>
                Cart
                <?php if ($cart_count > 0) : ?>
                    <span class="cart-count"><?= $cart_count ?></span>
                <?php endif; ?>
            </a>

            <span class="welcome-message">Welcome, <?= htmlspecialchars($username) ?></span>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>

</html>
