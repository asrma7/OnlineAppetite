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
    $sql = "SELECT user_id, full_name, username, email, password_hash, image FROM users WHERE (username=='$login' OR email =='$login') AND user_role=='3'";
    $user = fetch_row($sql);
    if (!$user) {
        $errors['login'] = "Username/Email does not exists.";
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header('Location: /signin.php');
    } else if (!password_verify($password, $user['password_hash'])) {
        $errors['password'] = "Password Does not match.";
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header('Location: /signin.php');
    } else {
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location: /');
    }
}
