<?php
include '../includes/customer_header.php';
?>

<div class="confirmation-container">
    <h2>Order Confirmed</h2>
    <p>Thank you for your purchase! Your order has been successfully placed.</p>
    <a href="products.php" class="continue">Continue Shopping</a>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
    }

    .confirmation-container {
        width: 80%;
        max-width: 800px;
        margin: 40px auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #2ecc71;
        font-size: 28px;
        margin-bottom: 20px;
    }

    p {
        color: #7f8c8d;
        font-size: 18px;
        margin: 20px 0;
    }

    .continue {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        margin-top: 20px;
    }

    .continue:hover {
        background-color: #8e44ad;
    }

    .empty-cart {
        color: #7f8c8d;
        font-size: 18px;
    }
</style>

<?php include '../includes/footer.php'; ?>