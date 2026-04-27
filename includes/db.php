<?php
// Detect if we are running online or offline
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
    // LOCAL SETTINGS
    $host = 'localhost';
    $dbname = 'shop_free';
    $username = 'root';
    $password = '';
} else {
    // PRODUCTION SETTINGS (InfinityFree)
    // NOTE: Make sure you created a database named 'if0_41769329_shop_free' in your panel
    $host = 'sql100.infinityfree.com';
    $dbname = 'if0_41769329_shop_free';
    $username = 'if0_41769329';
    $password = 'ByrwPqY0fs';
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
