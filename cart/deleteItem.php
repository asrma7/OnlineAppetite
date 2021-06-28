<?php
require_once '../sessionManager.php';

if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
    exit();
} else {
    $cart = $_SESSION['user']['cart'] ?? [];
}

$products = $_POST['product'];

echo json_encode($products);