<?php
include '../utils/database.php';
session_start();
$old = $_POST;
extract($_POST);
$errors = [];

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
   
    
    if (!$res1)
        $_SESSION['message'] = ["message" => "Error while user registeration", 'color' => "danger"];
    else if(!query($sql2))
        $_SESSION['message'] = ["message" => "Error while trader registeration", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Registered Successfully! Wait for verification", 'color' => "success"];
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/trader/addShop.php');
