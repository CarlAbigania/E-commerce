<?php
include '../includes/db.php';
include '../includes/admin_header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../landing_page.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$image");
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $image, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $id]);
    }

    header("Location: manage_products.php");
}
?>

<div class="container">
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data" class="form">
        <label>Product Name</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4" required><?= $product['description'] ?></textarea>

        <label>Product Image (optional)</label>
        <input type="file" name="image">

        <button type="submit" class="btn primary-btn">Update Product</button>
    </form>
</div>

<style>
    body {
        overflow-y: scroll;
    }

    .container {
        padding: 30px;
        background-color: #fff;
        margin: 20px auto;
        max-width: 600px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #3498db;
        margin-bottom: 20px;
    }

    .form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input,
    textarea {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .primary-btn {
        background-color: #27ae60;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .primary-btn:hover {
        background-color: #229954;
    }
</style>

<?php include '../includes/footer.php'; ?>