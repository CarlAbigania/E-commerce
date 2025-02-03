<?php
include '../includes/db.php';
include '../includes/customer_header.php';

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Orders - ShopFree</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            overflow-y: scroll;
        }

        .orders-container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .order-items {
            font-size: 14px;
            color: #7f8c8d;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .no-orders {
            text-align: center;
            color: #7f8c8d;
            margin: 50px 0;
        }

        .view-order-btn {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }

        .view-order-btn:hover {
            background-color: #8e44ad;
        }
    </style>
</head>

<body>
    <div class="orders-container">
        <h2>My Orders</h2>

        <?php if (empty($orders)) : ?>
            <p class="no-orders">You have no past orders.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) :
                        $items = json_decode($order['items'], true);
                        $date = date("F j, Y", strtotime($order['created_at']));
                    ?>
                        <tr>
                            <td><?= $order['order_id'] ?></td>
                            <td class="order-items">
                                <?php foreach ($items as $item) : ?>
                                    <?= $item['name'] ?> (x<?= $item['quantity'] ?>)<br>
                                <?php endforeach; ?>
                            </td>
                            <td>₱<?= number_format($order['total'], 2) ?></td>
                            <td><?= $date ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?>