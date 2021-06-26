<?php
require_once 'sessionManager.php';
require_once 'utils/database.php';
if (!isset($_SESSION['user'])) {
  header('Location: /signin.php');
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
      <div class="w-75 p-5 my-5 bg-dark text-light">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
              <div class="img">
                <img src="<?=$user['image']??'/assets//images/adminlte//avatar2.png'?>" alt="" class="img-circle elevation-2">
              </div>
              <div class="mt-4 text-center">
                <strong>Registered on: </strong><hr>
                <span><?= date('jS M Y', strtotime($user['created_at'])) ?></span>
              </div>
            </div>
            <div class="col-md-7 offset-md-1 col-sm-6 col-12">
              <div class="row">
                <div class="col-12">
                  <strong>Full Name</strong>
                  <p><?= $user['full_name'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <strong>Email</strong>
                  <p><?= $user['email'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <strong>Gender</strong>
                  <p><?php
                      switch ($user['gender']) {
                        case 1:
                          echo 'Male';
                          break;
                        case 2:
                          echo 'Female';
                          break;
                        case 3:
                          echo 'Other';
                          break;
                        case 4:
                          echo 'Not Specified';
                          break;
                      }
                      ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <strong>Address</strong><br>
                  <i>Street Address</i><br>
                  <p><?=$user['street'];?></p>
                  <i>City</i><br>
                  <p><?=$user['city'];?></p>
                  <i>Postal Code</i><br>
                  <p><?=$user['postal'];?></p>
                </div>
                <div class="col-6">
                  <br>
                  <i>State/Province</i><br>
                  <p><?=$user['state'];?></p>
                  <i>Country</i><br>
                  <p><?=$user['country'];?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <a href="/editprofile.php"><button class="btn btn-secondary mb-2">Edit Profile</button></a>
                </div>
                <div class="col-6">
                  <a href="changepass.php"><button class="btn btn-secondary mb-2">Change Password</button></a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
      </div>
        </div><!-- /.container-fluid -->

    <?php include 'footer.php';?>
    <script src="js/script.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </script>
</body>
</html>