<?php
include '../includes/db.php';
include '../includes/admin_header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../landing_page.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<div class="container">
    <h2>Manage Products</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><img src="../uploads/<?= $product['image'] ?>" alt="Product Image" width="50"></td>
                <td><?= $product['name'] ?></td>
                <td>₱<?= number_format($product['price'], 2) ?></td>
                <td><?= substr($product['description'], 0, 50) ?>...</td>
                <td class="actions">
                    <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn edit">Edit</a>
                    <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table><br>

    <a href="add_product.php" class="primary-btn">Add Product</a>
</div>

<style>
    body {
        overflow-y: scroll;
    }

    .container {
        padding: 30px;
        background-color: #fff;
        margin: 20px auto;
        max-width: 1200px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #3498db;
        margin-bottom: 20px;
    }

    /* Add Product Button */
    .primary-btn {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        transition: background 0.3s ease;
    }

    .primary-btn:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #3498db;
        color: #fff;
    }

    /* Actions column */
    .actions {
        width: 150px;
        /* Set a fixed width for the actions column */
    }

    /* Edit button */
    .edit {
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        background-color: #27ae60;
        transition: background-color 0.3s;
        display: block;
        /* Display in block for vertical stacking */
        margin-bottom: 10px;
        /* Space between Edit and Delete */
    }

    .edit:hover {
        background-color: #229954;
    }

    /* Delete button */
    .delete {
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        background-color: #e74c3c;
        transition: background-color 0.3s;
        display: block;
        /* Display in block for vertical stacking */
    }

    .delete:hover {
        background-color: #c0392b;
    }
</style>

<?php include '../includes/footer.php'; ?>