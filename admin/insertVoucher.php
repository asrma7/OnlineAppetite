<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
if (!isset($_SESSION['admin'])) {
    header('Location: /admin/login.php');
}
$old = $_POST;
extract($_POST);
$errors = [];

$user_id = $_SESSION['admin']['user_id'];

//voucher name
if (empty($voucherCode)) {
    $errors['voucherCode'] = "Voucher Code is required.";
} elseif (strlen($voucherCode) < 3) {
    $errors['voucherCode'] = "Voucher Code must be atleast 3 characters long.";
} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $voucherCode)) {
    $errors['voucherCode'] = "Voucher code can only be alphanumeric";
} elseif(!checkCodeUnique($voucherCode)) {
    $errors['voucherCode'] = "Voucher code already exists";
}
//amount.
if (empty($amount)) {
    $errors['amount'] = "Discount amount is required.";
} else if (!is_numeric($amount)) {
    $errors['amount'] = "Discount amount must be numeric.";
}
//minimum
if (empty($minimum)) {
    $errors['minimum'] = "Minimum Amount is required.";
} else if (!is_numeric($minimum)) {
    $errors['amount'] = "Minimum amount must be numeric.";
}


//error size
if (sizeof($errors) == 0) {
    $sql = "INSERT INTO vouchers (voucher_code, discount_amount, minimum) VALUES ('$voucherCode', '$amount'*100, '$minimum'*100)";
    $res = query($sql);
    if (!$res)
        $_SESSION['message'] = ["message" => "Error while inserting Voucher", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Voucher added Successfully!", 'color' => "success"];
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}

function checkCodeUnique($code)
{
    $row = fetch_row("SELECT COUNT(*) as count FROM vouchers WHERE voucher_code == '$code'");
    $count = $row['count'];
    if ($count > 0) return false;
    return true;
}
header('Location:/admin/addVoucher.php');
