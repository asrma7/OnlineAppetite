<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
require_once 'mailTemplate.php';
if (isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
$old = $_POST;
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$user = fetch_row("SELECT * FROM USERS WHERE (USERNAME = '$username' OR EMAIL = '$email') AND USER_ROLE = 3");
if (empty($user)) {
    $_SESSION['message'] = ['message' => 'User not found!', 'color' => 'danger'];
    $_SESSION['old'] = $old;
    header('Location: forgotpassword.php');
    exit();
} else if ($user['USERNAME'] != $username || $user['EMAIL'] != $email) {
    $_SESSION['message'] = ['message' => 'Username and email do not match!', 'color' => 'danger'];
    $_SESSION['old'] = $old;
    header('Location: forgotpassword.php');
    exit();
} else {
    $token = md5(RAND(4000, 5000));
    $useremail = $user['EMAIL'];
    if (!empty(fetch_row("SELECT * FROM RESET_PASSWORD WHERE EMAIL = '$useremail'")))
        query("UPDATE RESET_PASSWORD SET TOKEN = '$token', CREATED_AT = " . toDate(date('Y-m-d'), 'YYYY-MM-DD'));
    else
        query("INSERT INTO RESET_PASSWORD (EMAIL, TOKEN) VALUES ('$useremail', '$token')");
    $message = "We're glad you're here,<br>" . $user['EMAIL'];
    $link = "http://localhost:3000/resetPassword.php?email=$useremail&token=$token";
    echo makeMail($message, $link, "Activate Account", "(Just confirming you're you.)");
}
