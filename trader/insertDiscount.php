<?php
include '../utils/database.php';
session_start();
$old = $_POST;
extract($_POST);
$errors = [];

$user_id = $_SESSION['trader']['user_id'];

//discount name
if (empty($discountName)) {
    $errors['discountName'] = "Discount Name is required.";
} elseif (strlen($discountName) < 3) {
    $errors['discountName'] = "Discount Name must be atleast 3 characters long.";
}
//rate.
if (empty($rate)) {
    $errors['rate'] = "Discount rate is required.";
} else if (!is_numeric($rate)) {
    $errors['rate'] = "Discount rate must be numeric.";
}
//target
if ($discount_type == "category" && empty($target)) {
    $errors['target'] = "Target is required.";
}
//starts on
if (empty($starts)) {
    $errors['starts'] = "Start Date is required.";
}
//expires on
if (empty($expires)) {
    $errors['expires'] = "Expiry Date is required.";
}



//error size
if (sizeof($errors) == 0) {
    $sql = "INSERT INTO discounts (discount_name, rate, target_id, discount_type, starts_on, expires_on, created_by) VALUES ('$discountName', '$rate', '$target', 'product', '$starts', '$expires', $user_id)";
    $res = query($sql);
    if (!$res)
        $_SESSION['message'] = ["message" => "Error while inserting Discount", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Discount added Successfully!", 'color' => "success"];
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/trader/addDiscount.php');
