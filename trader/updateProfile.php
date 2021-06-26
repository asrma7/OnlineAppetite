<?php
include '../utils/database.php';
session_start();
if (!isset($_SESSION['trader'])) {
    header('Location: /trader/login.php');
} else {
    $user_id = $_SESSION['trader']['user_id'];
}
$old = $_POST;
extract($_POST);
$image = $_FILES['profileImage'];
$errors = [];
if (!empty($full_name)) {
    if (strlen($full_name) < 3) {
        $errors['full_name'] = "Business Name must be atleast 3 characters long.";
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
if (!empty($contact_no)) {
    if (strlen($contact_no) > 15) {
        $errors['contact_no'] = "Enter a valid contact number.";
    }
}
if (empty($business_type)) {
    $errors['business_type'] = "Business type is required.";
}
if (empty($payments)) {
    $errors['payments'] = "Atleast one payment method is required.";
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
        else if ($width > "250" || $height > "250") {
            $errors['profileImage'] = "Image dimension should be within 300X200.";
        }
        if (empty($errors['profileImage'])) {
            $target = "../uploads/users/" . $user_id . '.' . $file_extension;
            if (move_uploaded_file($image["tmp_name"], $target)) {
                $profileImage = '/uploads/users/'. $user_id . '.' . $file_extension;
            } else {
                $errors['profileImage'] = "Problem in uploading image files.";
            }
        }
    }
}
if (sizeof($errors) == 0) {
    $sql1 = "UPDATE users SET";
    if (!empty($full_name))
        $sql1 .= " full_name = '$full_name',";
    if (!empty($email))
        $sql1 .= " email = '$email',";
    if (!empty($username))
        $sql1 .= " username = '$username',";
    if (!empty($profileImage))
        $sql1 .= " image = '$profileImage',";
    $sql1 .= " gender = '$gender', street = '$street', city = '$city', postal = '$postal', state = '$state', country = '$country' WHERE user_id = '$user_id'";
    if (!empty($contact_no)) {
        $sql2 = "UPDATE traders SET contact_no = '$contact_no', trading_since = '" . toDate($trading_since, "YYYY-MM-DD") . "', business_type = '$business_type', preferred_payments = '" . implode(', ', $payments) . "'";
        $res2 = query($sql2);
    } else {
        $res2 = true;
    }
    if (!query($sql1))
        $_SESSION['message'] = ["message" => "Error while updating User", 'color' => "danger"];
    elseif (!$res2)
        $_SESSION['message'] = ["message" => "Error while updating Management", 'color' => "danger"];
    else
        $_SESSION['message'] = ["message" => "Profile Updated successfully", 'color' => "success"];
    $updatedUser = fetch_row("SELECT user_id, full_name, username, email, image FROM users WHERE user_id = '$user_id'");
    $_SESSION['trader'] = $updatedUser;
} else {
    $_SESSION['message'] = ["message" => "Please fix the following errors", 'color' => "danger"];
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
}
header('Location:/trader/editprofile.php');
function checkUsernameUnique($username)
{
    $row = fetch_row("SELECT COUNT(*) as count FROM users WHERE username == '$username'");
    $count = $row['count'];
    if ($count > 0) return false;
    return true;
}

function checkEmailUnique($email)
{
    $row = fetch_row("SELECT COUNT(*) as count FROM users WHERE email == '$email'");
    $count = $row['count'];
    if ($count > 0) return false;
    return true;
}
