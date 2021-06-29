<?php
require_once '../utils/sessionManager.php';
require_once '../utils/database.php';
if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
    exit();
} else {
    $user_id = $_SESSION['user']['user_id'];
}

extract($_POST);

if (!empty($rating) && !empty($review)) {
    $user_review = fetch_row("SELECT * FROM reviews WHERE product_id = '$product_id' AND user_id = '$user_id'");
    if (empty($user_review)) {
        $sql = "INSERT INTO reviews (user_id, product_id, rating, review) VALUES ('$user_id', '$product_id', '$rating', '$review')";
    } else {
        $sql = "UPDATE reviews SET rating = '$rating', review = '$review'";
    }
    query($sql);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
