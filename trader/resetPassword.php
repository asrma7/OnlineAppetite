<?php
require_once '../utils/sessionManager.php';
require_once '../utils/database.php';
if (isset($_SESSION['user'])) {
  header('Location: /');
  exit();
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
$email = $_GET['email'];
$token = $_GET['token'];
$reset = fetch_row("SELECT * FROM RESET_PASSWORD WHERE EMAIL = '$email'");
$user = fetch_row("SELECT * FROM USERS WHERE EMAIL = '$email' AND USER_ROLE = 2");
if (!empty($reset)) {
  $expires = strtotime('+1 hour', strtotime($reset['CREATED_AT']));
}
if (empty($reset)) {
  $message = ['message' => "Reset link is invalid", 'color' => "danger"];
} else if (empty($user)) {
  $message = ['message' => "Reset link is invalid", 'color' => "danger"];
} elseif ($reset['TOKEN'] != $token) {
  $message = ['message' => "Reset token is invalid", 'color' => "danger"];
} else if ($expires < strtotime("now")) {
  $message = ['message' => "Reset token expired", 'color' => "danger"];
}

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OnlineAppetite | Change Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/css/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Online</b>Appetite</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <?php if (!empty($message)) { ?>
        <div class="alert alert-<?= $message['color'] ?> text-center" role="alert">
          <?= $message['message']; ?>
        </div>
      <?php } ?>
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

        <form action="updateResetPassword.php" method="post">
          <input type="hidden" name="email" value="<?= $email ?>">
          <input type="hidden" name="token" value="<?= $token ?>">
          <?= isset($errors['password']) ? '<div class="text-danger">' . $errors['password'] . '</div>' : '' ?>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>" placeholder="New Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?= isset($errors['confirm']) ? '<div class="text-danger">' . $errors['confirm'] . '</div>' : '' ?>
          <div class="input-group mb-3">
            <input type="password" name="confirm" class="form-control<?= isset($errors['confirm']) ? ' is-invalid' : '' ?>" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</body>

</html>