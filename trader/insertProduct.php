<?php
include '../utils/database.php';
session_start();
$old = $_POST;
extract($_POST);
$errors = [];

//product name
if (empty($productName)) {
    $errors['productName'] = "Product Name is required.";  
} elseif (strlen($productName) < 3) {
    $errors['productName'] = "Product Name must be atleast 3 characters long.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $productName)) {
    $errors['productName'] = "Please enter a valid product name.";
}
//price
if (empty($price)) {
    $errors['price'] = "Price is required.";
} 
elseif (!is_numeric($price)) {
    $errors['price'] = "Price must be in numeric format."; 
}
//category
if (empty($category)) {
    $errors['category'] = "Category is required.";
} 
//quantity
if (empty($quantity)) {
    $errors['quantity'] = "Quantity is required.";
} 
elseif (!is_numeric($quantity)) {
    $errors['quantity'] = "Please enter a valid quantity."; 
}
//shop
if (empty($shop)) {
    $errors['shop'] = "Shop is required.";
} 
//description
if (empty($description)) {
    $errors['description'] = "Description is required.";
}
elseif (strlen($description) < 3) {
    $errors['description'] = "Description must be atleast 3 characters long.";
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

header('Location:/trader/addProduct.php');
