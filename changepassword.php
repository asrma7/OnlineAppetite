<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
if (!isset($_SESSION['user'])) {
  header('Location: /signin.php');
}else {
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
  }
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $old = $_SESSION['old'];
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="/css/adminlte/adminlte.min.css">

  <title>Profile</title>
</head>

<body>
  <?php
  $page = 'profile';
  include 'header.php';
  $user_id = $_SESSION['user']['user_id'];
  $user = fetch_row("SELECT * FROM users WHERE user_id =='$user_id'");
  ?>
  <div class="container-fluid d-flex justify-content-center">
    <div class="w-50 p-5 my-5 bg-dark text-light d-flex flex-column align-items-center">
      <h5 class="my-5">Change Password</h5>
      <form class="w-75" action="/backend/updatePassword.php" method="POST">
        <?php if (isset($message)) { ?>
          <div class="alert alert-<?= $message['color'] ?> text-center" role="alert">
            <?= $message['message']; ?>
          </div>
        <?php } ?>
        <!--shop name-->
        <div class="form-group">
          <label for="oldpass">Old Password</label>
          <input type="password" id="oldpass" name="oldpass" class="form-control <?= isset($errors['oldpass']) ? 'is-invalid' : ''; ?>">
          <?= isset($errors['oldpass']) ? '<div class="invalid-feedback">' . $errors['oldpass'] . '</div>' : ''; ?>
        </div>

        <!--shop name-->
        <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" id="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>">
          <?= isset($errors['password']) ? '<div class="invalid-feedback">' . $errors['password'] . '</div>' : ''; ?>
        </div>

        <!--shop name-->
        <div class="form-group">
          <label for="confirm">Confirm New Password</label>
          <input type="password" id="confirm" name="confirm" class="form-control <?= isset($errors['confirm']) ? 'is-invalid' : ''; ?>">
          <?= isset($errors['confirm']) ? '<div class="invalid-feedback">' . $errors['confirm'] . '</div>' : ''; ?>
        </div>



        <!--submit button-->
        <div class="text-center">
          <button type="submit" class="loadmore">Change Password</button>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->

  <?php include 'footer.php'; ?>
  <script src="js/script.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  </script>
</body>

</html>