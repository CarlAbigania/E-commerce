<?php
include '../includes/db.php';
include '../includes/admin_header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../landing_page.php");
    exit;
}

$stmt = $pdo->query("SELECT COUNT(*) AS total_products FROM products");
$total_products = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) AS total_orders FROM orders");
$total_orders = $stmt->fetchColumn();
?>

<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="stats">
        <div class="card">
            <h3>Total Products</h3>
            <p class="total"><?= $total_products ?></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p class="total"><?= $total_orders ?></p>
        </div>
    </div>
</div>

<style>
    body {
        overflow-y: scroll;
    }

    .container {
        padding: 30px;
        text-align: center;
    }

    .stats {
        display: flex;
        gap: 30px;
        justify-content: center;
        margin-top: 20px;
    }

    .card {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        width: 200px;
    }

    h3 {
        color: #3498db;
    }

    p.total {
        font-size: 24px;
        font-weight: bold;
    }
</style>

<?php include '../includes/footer.php'; ?>