<?php
require_once '../utils/database.php';

$code = $_POST['code'];
$subtotal = $_POST['subtotal'];

$error = '';

$voucher = fetch_row("SELECT * FROM vouchers WHERE voucher_code = '$code'");

if (!$voucher) {
    $error = "Voucher Code does not exists.";
} else if ($subtotal < round($voucher['minimum'] / 100, 2)) {
    $error = "Purchase minimum of £ " . round($voucher['minimum'] / 100, 2) . ' to apply this voucher';
}

if (empty($error)) {
    $amount = number_format($voucher['discount_amount'] / 100, 2, '.', '');
    $response = ['status' => 'success', 'amount' => $amount];
}
else {
    $response = ['status' => 'error', 'message' => $error];
}
echo json_encode($response);