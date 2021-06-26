<?php
require_once '../sessionManager.php';
require_once '../utils/database.php';
if (!isset($_SESSION['trader'])) {
  header('Location: /trader/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/css/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte/adminlte.min.css">
  <style>
    select.form-control:invalid {
      color: #aaa;
    }

    ;
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    $page = "Profile";
    include 'header.php';

    $username = $_SESSION['trader']['username'];
    $user = fetch_row("SELECT * FROM users LEFT JOIN traders on users.user_id = traders.user_id WHERE username =='$username'");
    $user['payments'] = explode(', ', $user['preferred_payments']);
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <h5 class="mb-2">Profile</h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="img">
                <img src="<?= $user['image'] ?? '/assets/images/adminlte//avatar2.png'?>" alt="" class="img-circle elevation-2">
              </div>
              <div class="form-group mt-4">
                <label for="profileImage">Profile Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="profileImage" class="custom-file-input" id="profileImage">
                    <label class="custom-file-label" for="profileImage">Choose image</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 offset-md-1 col-sm-6 col-12">
              <div class="form-group">
                <label for="name">Business Name</label>
                <input type="text" id="name" name="full_name" class="form-control" value="<?=$user['full_name']?>">
              </div>
              <div class="form-group">
                <label for="email">Business Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?=$user['email']?>">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?=$user['username']?>">
              </div>
              <div class="form-group">
                <label for="contact">Contact No.</label>
                <input type="text" id="contact" name="contact_no" class="form-control" value="<?=$user['contact_no']?>">
              </div>
              <div class="form-group">
                <label for="category">Gender</label>
                <select id="category" name="category" class="form-control">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
              <div class="form-group">
                <div class="my-2">
                  <strong>Address</strong>
                  <input type="text" id="st1" name="street" class="form-control" placeholder="Street Address" value="<?=$user['street']?>">
                </div>
                <div class="row my-2">
                  <div class="col-6">
                    <input type="text" id="city" name="city" class="form-control" placeholder="City" value="<?=$user['city']?>">
                  </div>
                  <div class="col-6">
                    <input type="text" id="state" name="state" class="form-control" placeholder="State/Province" value="<?=$user['state']?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <input type="text" id="postal" name="postal" class="form-control" placeholder="Postal Code" value="<?=$user['postal']?>">
                  </div>
                  <div class="col-6">
                    <select id="country" name="country" class="form-control" required>
                      <option value="nepal">Nepal</option>
                      <option value="india">India</option>
                      <option value="bhutan">Bhutan</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="trading_since">Trading Since</label>
                <input type="date" id="trading_since" name="trading_since" class="form-control" value="<?=date('Y-m-d', strtotime($user['trading_since']))?>">
              </div>
              <div class="form-group">
                <label>Business Type</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="small" name="business_type" <?= $user['business_type'] == 'small' ? 'checked' : ''; ?>  class="custom-control-input">
                  <label class="custom-control-label" for="small">Small</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="medium" name="business_type" <?= $user['business_type'] == 'medium' ? 'checked' : ''; ?> class="custom-control-input">
                  <label class="custom-control-label" for="medium">Medium</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="large" name="business_type" <?= $user['business_type'] == 'large' ? 'checked' : ''; ?> class="custom-control-input">
                  <label class="custom-control-label" for="large">Large</label>
                </div>
              </div>
              <div class="form-group">
                <label>Business Type</label><br>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" name="payments[]" <?=in_array('card', $user['payments'])?'checked':''?> id="card">
                  <label class="custom-control-label" for="card">Card</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" name="payments[]" <?=in_array('cash', $user['payments'])?'checked':''?> id="cash">
                  <label class="custom-control-label" for="cash">Cash</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" name="payments[]" <?=in_array('paypal', $user['payments'])?'checked':''?> id="paypal">
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-secondary mb-2" type="submit">Update</button>
                </div>
                <div class="col-6">
                  <button class="btn btn-secondary mb-2" type="reset">Reset</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'footer.php'; ?>
  </div>
  <!-- ./wrapper -->


  <!-- jQuery -->
  <script src="/js/adminlte/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/js/adminlte/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/js/adminlte/adminlte.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="/js/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/js/adminlte/demo.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>