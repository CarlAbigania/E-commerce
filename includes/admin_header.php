<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../landing_page.php");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopFree Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            overflow-y: scroll;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .header {
            background: linear-gradient(90deg, #3498db, #8e44ad);
            padding: 20px;
            color: white;
            text-align: center;
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
    </style>
</head>

<body>
    <!-- Header Section with Logo -->
    <div class="header">
        <!-- Logo added here -->
        <img src="../assets/logo.webp" alt="ShopFree Logo">
        <h1>ShopFree Admin Panel</h1>
        <div class="nav">
            <a href="../admin/dashboard.php" class="btn">Dashboard</a>
            <a href="../admin/manage_products.php" class="btn">Manage Products</a>
            <a href="../admin/view_orders.php" class="btn">View Orders</a>
            <span class="welcome-message">Welcome, <?= htmlspecialchars($username) ?></span>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>

</html>
