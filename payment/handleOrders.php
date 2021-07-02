<?php
include '../utils/database.php';
include '../utils/sessionManager.php';
$method = $_POST['method'];
$slot = $_POST['slot'];
$txn_id = $_POST['txn_id'];
$payment_fee = $_POST['payment_fee'];
$code = $_POST['voucher_code'];
$amount = $_POST['payment_gross'];
$voucher = query("SELECT * FROM VOUCHERS WHERE VOUCHER_CODE = '$code'");
$voucher_discount = $_POST['voucher_discount'];

$cart = $_SESSION['user']['cart'] ?? '';

$order = query("INSERT INTO ORDERS (SLOT_ID, AMOUNT, VOUCHER_CODE, VOUCHER_DISCOUNT) VALUES ('$slot', '$amount', '$code', '$voucher_discount')");

if(!$order) {
    die("Error while processing order");
}

foreach ($cart as $shop) {
    foreach ($shop['products'] as $product_id => $product) {
        query("INSERT INTO ORDER_PRODUCT (ORDER_ID, PRODUCT_ID, PRICE, SITE_DISCOUNT, PRODUCT_DISCOUNT) VALUES (ORDERS_seq.currval, '$product_id', '".$product['price']."', '".$product['site_discount']."', '".$product['product_discount']."')");
    }
}

$payment = query("INSERT INTO PAYMENTS (ORDER_ID, AMOUNT, PAYMENT_METHOD, TXN_ID, PAYMENT_FEE) VALUES (ORDERS_seq.currval, '$amount', '$method', '$txn_id', '$payment_fee')");

if(!$payment) {
    die("Error while processing order");
}
else {
    header('Location: /paymentSuccess.php');
}