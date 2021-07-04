<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
require_once '../utils/mail.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
} else {
    $shop_id = $_GET['id'] ?? '';
}

query("UPDATE SHOPS SET VERIFIED_ON = ".toDate(date('Y-m-d'),"YYYY-MM-DD")." WHERE SHOP_ID = '$shop_id'");

$user_email = fetch_row("SELECT EMAIL FROM SHOPS INNER JOIN USERS ON USERS.USER_ID = SHOPS.TRADER_ID WHERE SHOP_ID = '$shop_id'")['EMAIL'];

header('Location: viewShops.php');