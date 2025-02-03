<?php
include '../includes/db.php';
include '../includes/customer_header.php';

$user_id = $_SESSION['user_id'];
$customer_name = $_SESSION['username'];

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cartItems)) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, customer_name, items, total) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $customer_name, json_encode($cartItems), $total]);

    unset($_SESSION['cart']);
    header("Location: confirmation.php");
    exit;
}
?>

<div class="container">
    <h2>Checkout</h2>
    <?php if (empty($cartItems)) : ?>
        <p class="empty-cart">Your cart is empty. <a href="products.php">Shop now</a>.</p>
    <?php else : ?>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₱<?= number_format($item['price'], 2) ?></td>
                            <td>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="checkout-total">Total: ₱<?= number_format($total, 2) ?></div>
            <button type="submit" class="btn place" <?= empty($cartItems) ? 'disabled' : '' ?>>Place Order</button>
        </form>
    <?php endif; ?>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        overflow-y: scroll;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #3498db;
        margin-bottom: 25px;
        font-size: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #3498db;
        color: white;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    .total-row {
        text-align: right;
        font-weight: bold;
        font-size: 1.2em;
    }

    .place {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #3498db, #8e44ad);
        border: none;
        color: white;
        font-size: 1.1em;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .place:hover {
        background: linear-gradient(135deg, #8e44ad, #3498db);
        transform: translateY(-2px);
    }

    .place:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .checkout-total {
        font-weight: bold;
        font-size: 1.3em;
        margin-top: 20px;
    }

    .empty-cart {
        color: #888;
        font-size: 1.2em;
        margin-top: 50px;
    }
</style>

<?php include '../includes/footer.php'; ?>