<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
require_once '../utils/mail.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
} else {
    $user_id = $_GET['id'] ?? '';
}

query("UPDATE TRADERS SET VERIFIED_AT = ".toDate(date('Y-m-d'),"YYYY-MM-DD").", STATUS = '3' WHERE USER_ID = '$user_id'");

$user_email = fetch_row("SELECT EMAIL FROM USERS WHERE USER_ID = '$user_id'")['EMAIL'];

header('Location: viewTraders.php');