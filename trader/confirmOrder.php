<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
require_once '../utils/mail.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
} else {
    $id = $_GET['id'] ?? '';
}

query("UPDATE ORDER_PRODUCT SET STATUS = 2 WHERE ID = '$id'");

$user_email = fetch_row("SELECT EMAIL FROM ORDER_PRODUCT INNER JOIN ORDERS USING (ORDER_ID) INNER JOIN USERS USING (USER_ID) WHERE ID = '$id'")['EMAIL'];

header('Location: viewOrders.php');