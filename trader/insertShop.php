<?php
include '../utils/database.php';
session_start();
if (!isset($_SESSION['trader'])) {
    header('Location: /trader/login.php');
  }
$old = $_POST;
extract($_POST);
$errors = [];

$trader_id = $_SESSION['trader']['user_id'];

//shop name
if (empty($shopName)) {
    $errors['shopName'] = "Shop Name is required.";  
} elseif (strlen($shopName) < 3) {
    $errors['shopName'] = "Shop Name must be atleast 3 characters long.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $shopName)) {
    $errors['shopName'] = "Please enter a valid shop name.";
}
//Pan no.
if (empty($govNum)) {
    $errors['govNum'] = "Pan no./Vat no. is required.";
} 
//address
if (empty($address)) {
    $errors['address'] = "Address is required.";
} 
//Contact number
if (empty($contact)) {
    $errors['contact'] = "Contact number is required.";
}
//Shop type
if (empty($shop_type)) {
    $errors['shop_type'] = "Shop type is required.";
}
//description
if (empty($description)) {
    $errors['description'] = "Description is required.";
}
elseif (strlen($description) < 20) {
    $errors['description'] = "Description must be atleast 20 characters long.";
}



//error size
if (sizeof($errors) == 0) {
   $sql = "INSERT INTO shops (trader_id, shop_name, gov_no, address, contact_no, shop_type, description) VALUES ('$trader_id', '$shopName', '$govNum', '$address', '$contact', '$shop_type', '$description')";
   $res = query($sql);
    if (!$res)
        $_SESSION['message'] = ["message" => "Error while inserting Shop", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Shop added Successfully!", 'color' => "success"];
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/trader/addShop.php');
