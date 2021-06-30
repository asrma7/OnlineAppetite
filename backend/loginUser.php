<?php
include '../utils/database.php';
require_once '../utils/sessionManager.php';
$old = $_POST;
extract($_POST);
$errors = [];

if (empty($login)) {
    $errors['login'] = "Username/Email is required.";
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
    header('Location: /signin.php');
} else {
    $sql = "SELECT USER_ID, FULL_NAME, USERNAME, EMAIL, PASSWORD_HASH, IMAGE FROM USERS WHERE (USERNAME='$login' OR EMAIL ='$login') AND USER_ROLE='3'";
    $user = fetch_row($sql);
    if (!$user) {
        $errors['login'] = "Username/Email does not exists.";
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header('Location: /signin.php');
    } else if (!password_verify($password, $user['PASSWORD_HASH'])) {
        $errors['password'] = "Password Does not match.";
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header('Location: /signin.php');
    } else {
        unset($user['PASSWORD_HASH']);
        $_SESSION['user'] = $user;
        header('Location: /');
    }
}
