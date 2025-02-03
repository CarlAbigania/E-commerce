<?php
include '../includes/db.php';
include '../includes/customer_header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }
    header("Location: products.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<div class="container">
    <h2>Our Products</h2>
    <div class="product-grid">
        <?php foreach ($products as $product) : ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-details">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p class="price">₱<?= number_format($product['price'], 2) ?></p>
                </div>
                <div class="add-to-cart">
                    <form method="POST" action="">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                        <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                        <button type="submit" name="add_to_cart" class="btn add">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .container {
        margin: auto;
        padding: 25px;
    }

    h2 {
        text-align: center;
        color: #3498db;
        margin-bottom: 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    .product-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .product-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .product-details {
        flex-grow: 1;
    }

    .price {
        color: #2ecc71;
        font-weight: bold;
    }

    .add-to-cart {
        margin-top: 20px;
    }

    .add {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: 0.3s ease;
        width: 100%;
    }

    .add:hover {
        background-color: #2980b9;
    }
</style>

<?php include '../includes/footer.php'; ?>