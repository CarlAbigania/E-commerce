<?php
include '../includes/db.php';
include '../includes/admin_header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../landing_page.php");
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $price, $description, $image])) {
            $message = "Product added successfully!";
        } else {
            $message = "Failed to add product.";
        }
    } else {
        $message = "Failed to upload image.";
    }
}
?>

<div class="container">
    <h2>Add New Product</h2>
    <?php if ($message) echo "<p class='success'>$message</p>"; ?>
    <form method="POST" enctype="multipart/form-data" class="form">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" rows="4" placeholder="Description" required></textarea>
        <input type="file" name="image" required>
        <button type="submit" class="btn">Add Product</button>
    </form>
</div>

<style>
    .container {
        background-color: #fff;
        border-radius: 12px;
        padding: 30px;
        max-width: 600px;
        margin: 30px auto;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #3498db;
        margin-bottom: 20px;
    }

    .form {
        display: flex;
        flex-direction: column;
    }

    input,
    textarea {
        margin: 10px 0;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    button.btn {
        background-color: #3498db;
        color: #fff;
        padding: 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    button.btn:hover {
        background-color: #2980b9;
    }

    .success {
        color: #2ecc71;
        text-align: center;
    }
</style>

<?php include '../includes/footer.php'; ?>