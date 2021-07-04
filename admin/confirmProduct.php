<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
require_once '../utils/mail.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
} else {
    $product_id = $_GET['id'] ?? '';
}

query("UPDATE PRODUCTS SET CONFIRMED_ON = ".toDate(date('Y-m-d'),"YYYY-MM-DD")." WHERE PRODUCT_ID = '$product_id'");

$user_email = fetch_row("SELECT EMAIL FROM PRODUCTS INNER JOIN USERS ON USERS.USER_ID = PRODUCTS.TRADER_ID WHERE PRODUCT_ID = '$product_id'")['EMAIL'];

header('Location: viewProducts.php');