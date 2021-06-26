<?php
include '../utils/database.php';
session_start();
$old = $_POST;
extract($_POST);
$errors = [];

//category name
if (empty($categoryName)) {
    $errors['categoryName'] = "Category Name is required.";  
} else if (strlen($categoryName) < 3) {
    $errors['categoryName'] = "Category Name must be atleast 3 characters long.";
} else if (!preg_match('/^[a-zA-Z ]+$/', $categoryName)) {
    $errors['categoryName'] = "Please enter a valid Category name.";
}
//description
if (empty($description)) {
    $errors['description'] = "Description is required.";
}
else if (strlen($description) < 20) {
    $errors['description'] = "Description must be atleast 20 characters long.";
}



//error size
if (sizeof($errors) == 0) {
   $sql = "INSERT INTO categories (category_name, description) VALUES ('$categoryName', '$description')";
   $res = query($sql);
    if (!$res)
        $_SESSION['message'] = ["message" => "Error while inserting Category", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Category added Successfully!", 'color' => "success"];
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/admin/addCategory.php');
