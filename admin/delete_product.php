<?php
include '../includes/db.php';
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage_products.php");
