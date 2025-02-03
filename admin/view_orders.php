<?php
include '../includes/db.php';
include '../includes/admin_header.php';

$stmt = $pdo->prepare("SELECT * FROM orders ORDER BY created_at ASC");
$stmt->execute();
$orders = $stmt->fetchAll();
?>

<div class="container">
    <h2>Order List</h2>
    <?php if (empty($orders)) : ?>
        <p>No orders found.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) :
                    $items = json_decode($order['items'], true);
                    $orderDate = date("F j, Y, g:i a", strtotime($order['created_at']));
                ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td>₱<?= number_format($order['total'], 2) ?></td>
                        <td><?= $orderDate ?></td>
                        <td>
                            <button class="details" onclick="toggleDetails('order-<?= $order['order_id'] ?>')" class="btn">View Details</button>
                        </td>
                    </tr>
                    <tr id="order-<?= $order['order_id'] ?>" class="order-details">
                        <td colspan="5">
                            <ul>
                                <?php foreach ($items as $item) : ?>
                                    <li><?= htmlspecialchars($item['name']) ?> - Quantity: <?= $item['quantity'] ?> - Price: ₱<?= number_format($item['price'], 2) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    function toggleDetails(orderId) {
        const detailsRow = document.getElementById(orderId);
        detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
    }
</script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        overflow-y: scroll;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #3498db;
        color: white;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    .details {
        background-color: #3498db;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        border: none;
    }

    .order-details {
        display: none;
    }
</style>

<?php include '../includes/footer.php';?>