<?php
require_once '../sessionManager.php';
require_once '../utils/database.php';
if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
    exit();
} else {
    $user_id = $_SESSION['user']['user_id'];
}

$review_id = $_GET['id'];
$user_review = fetch_row("SELECT * FROM reviews WHERE review_id = '$review_id' AND user_id = '$user_id'");
if (!empty($user_review)) {
    $sql = "DELETE FROM reviews WHERE review_id = '$review_id'";
}
query($sql);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
