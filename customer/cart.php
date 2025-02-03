<?php
include '../includes/db.php';
include '../includes/customer_header.php';

$username = $_SESSION['username'];
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (isset($_GET['remove']) && isset($cart[$_GET['remove']])) {
    unset($cart[$_GET['remove']]);
    $_SESSION['cart'] = $cart;
    header("Location: cart.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'], $_POST['quantity'])) {
    $itemId = $_POST['item_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0 && isset($cart[$itemId])) {
        $cart[$itemId]['quantity'] = $quantity;
    }
    $_SESSION['cart'] = $cart;
    header("Location: cart.php");
    exit;
}
?>

<div class="cart-container">
    <h2>Shopping Cart</h2>

    <?php if (empty($cart)) : ?>
        <p class="empty-cart">Your cart is empty. <a href="products.php">Continue Shopping</a></p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart as $itemId => $item) :
                    $subtotal = $item['quantity'] * $item['price'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>₱<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <form method="post" action="cart.php" style="display:inline;">
                                <input type="hidden" name="item_id" value="<?= $itemId ?>">
                                <input type="number" name="quantity" min="1" value="<?= $item['quantity'] ?>" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>₱<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <a href="cart.php?remove=<?= $itemId ?>" class="btn remove-btn">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <p>Total: ₱<?= number_format($total, 2) ?></p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="checkout.php" class="btn cart">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        overflow-y: scroll;
    }

    .cart-container {
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

    input[type="number"] {
        width: 50px;
        padding: 5px;
    }

    .cart {
        background-color: #3498db;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart:hover {
        background-color: #8e44ad;
    }

    .remove-btn {
        background-color: #e74c3c;
    }

    .remove-btn:hover {
        background-color: #c0392b;
    }

    .total {
        text-align: right;
        font-weight: bold;
        margin-top: 20px;
    }

    .empty-cart {
        text-align: center;
        color: #7f8c8d;
        margin: 50px 0;
    }
</style>

<?php include '../includes/footer.php'; ?>