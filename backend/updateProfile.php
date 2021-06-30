<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
if (!isset($_SESSION['user'])) {
    header('Location: /signin.php');
} else {
    $user_id = $_SESSION['user']['USER_ID'];
}
$old = $_POST;
extract($_POST);
$image = $_FILES['profileImage'];
$errors = [];
if (!empty($full_name)) {
    if (strlen($full_name) < 3) {
        $errors['full_name'] = "Full Name must be atleast 3 characters long.";
    } elseif (!preg_match('/^[a-zA-Z]+ [a-zA-Z ]+$/', $full_name)) {
        $errors['full_name'] = "Please enter a valid Name.";
    }
}
if (!empty($username)) {
    if (strlen($username) < 6) {
        $errors['username'] = "Username must be atleast 6 characters long.";
    } elseif (!preg_match('/^[a-zA-Z0-9_\.]*$/', $username)) {
        $errors['username'] = "Please enter a valid Username.";
    } elseif (!checkUsernameUnique($username)) {
        $errors['username'] = "This Username has already been taken.";
    }
}
if (!empty($email)) {
    if (!preg_match('/^\S+@\S+\.\S+$/', $email)) {
        $errors['email'] = "Please enter a valid email.";
    } elseif (!checkEmailUnique($email)) {
        $errors['email'] = "This Email already exists.";
    }
}
if (file_exists($image["tmp_name"])) {

    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    // Get image file extension
    $file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);

    // Validate file input to check if is with valid extension
    if (!in_array($file_extension, $allowed_image_extension)) {
        $errors['profileImage'] = "Upload valid images. Only PNG and JPEG are allowed.";
    }    // Validate image file size
    else {
        $fileinfo = getimagesize($image["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];

        if (($image["size"] > 2000000)) {
            $errors['profileImage'] = "Image size exceeds 2MB.";
        }    // Validate image file dimension
        else if ($width != $height) {
            $errors['productImage2'] = "Image should be a square iamge.";
        } else if ($width > "250" || $height > "250") {
            $errors['profileImage'] = "Image dimension should be within 250X250.";
        }
    }
}
if (sizeof($errors) == 0) {
    $target = "../uploads/users/" . $user_id . '.' . $file_extension;
    if (move_uploaded_file($image["tmp_name"], $target)) {
        $profileImage = '/uploads/users/' . $user_id . '.' . $file_extension;
    } else {
        $errors['profileImage'] = "Problem in uploading image files.";
    }
}

//error size
if (sizeof($errors) == 0) {
    $sql1 = "UPDATE USERS SET";
    if (!empty($full_name))
        $sql1 .= " FULL_NAME = '$full_name',";
    if (!empty($email))
        $sql1 .= " EMAIL = '$email',";
    if (!empty($username))
        $sql1 .= " USERNAME = '$username',";
    if (!empty($profileImage))
        $sql1 .= " IMAGE = '$profileImage',";
    $sql1 .= " GENDER = '$gender', STREET = '$street', CITY = '$city', POSTAL = '$postal', STATE = '$state', COUNTRY = '$country' WHERE USER_ID = '$user_id'";
    if (!query($sql1))
        $_SESSION['message'] = ["message" => "Error while updating User", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Profile Updated successfully", 'color' => "success"];
    $updatedUser = fetch_row("SELECT USER_ID, FULLNAME, USERNAME, EMAIL, IMAGE FROM USERS WHERE USER_ID = '$user_id'");
    $_SESSION['user'] = $updatedUser;
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/editprofile.php');
function checkUsernameUnique($username)
{
    $row = fetch_row("SELECT COUNT(*) as C FROM USERS WHERE USERNAME == '$username'");
    $count = $row['C'];
    if ($count > 0) return false;
    return true;
}

function checkEmailUnique($email)
{
    $row = fetch_row("SELECT COUNT(*) as C FROM USERS WHERE EMAIL == '$email'");
    $count = $row['C'];
    if ($count > 0) return false;
    return true;
}
