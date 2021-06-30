<?php
require_once '../utils/sessionManager.php';

if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
    exit();
} else {
    $cart = $_SESSION['user']['cart'] ?? [];
}

$shop = $_POST['shop'];
$product = $_POST['product'];
$product_id = $product['product_id'];
unset($product['product_id']);

if (array_key_exists($shop['shop_id'], $cart)) {
    if (array_key_exists($product_id, $cart[$shop['shop_id']]['products'])) {
        $response = ['status' => 'error', 'message' => "Product already exists! Goto Cart?"];
        echo json_encode($response);
        exit();
    } else {
        $cart[$shop['shop_id']]['products'] += [$product_id => $product];
    }
} else {
    $cart += [
        $shop['shop_id'] => [
            'shop_name' => $shop['shop_name'],
            'products' => [
                $product_id => $product
            ]
        ]
    ];
}

$_SESSION['user']['cart'] = $cart;

$response = ['status' => 'success', 'message' => "Product added to cart"];
echo json_encode($response);