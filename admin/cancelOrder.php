<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
require_once '../utils/mail.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
} else {
    $order_id = $_GET['id'] ?? '';
}

query("UPDATE ORDERS SET STATUS = 3 WHERE ORDER_ID = '$order_id'");

$user_email = fetch_row("SELECT EMAIL FROM ORDERS INNER JOIN USERS USING (USER_ID) WHERE ORDER_ID = '$order_id'")['EMAIL'];

header('Location: viewOrders.php');