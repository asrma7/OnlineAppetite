
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
  <link rel="stylesheet" href="/css/select2/select2.min.css">
  <style>
    @media only screen and (min-width: 992px) {
      .addForm {
        width: 500px;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    $page = "AddShop";
    include 'header.php';
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
                <li class="breadcrumb-item">Shops</li>
                <li class="breadcrumb-item active">Add Shop</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <h5 class="mb-2">Change Password</h5>
      
          <form class="addForm" action="insertShop.php" method="POST">
            <!--shop name-->
            <div class="form-group">
              <label for="shopName">Old Password</label>
              <input type="text" id="shopName" name="oldPassword" class="form-control <?= isset($errors['shopName']) ? 'is-invalid' : ''; ?>"  value="<?= $old['shopName'] ?? ''; ?>">
              <?= isset($errors['shopName']) ? '<div class="invalid-feedback">' . $errors['shopName'] . '</div>' : ''; ?> 
            </div>

              <!--shop name-->
              <div class="form-group">
              <label for="shopName">New Password</label>
              <input type="text" id="shopName" name="newPassword" class="form-control <?= isset($errors['shopName']) ? 'is-invalid' : ''; ?>"  value="<?= $old['shopName'] ?? ''; ?>">
              <?= isset($errors['shopName']) ? '<div class="invalid-feedback">' . $errors['shopName'] . '</div>' : ''; ?> 
            </div>

              <!--shop name-->
              <div class="form-group">
              <label for="shopName">Confirm New Password</label>
              <input type="text" id="shopName" name="confirmPassword" class="form-control <?= isset($errors['shopName']) ? 'is-invalid' : ''; ?>"  value="<?= $old['shopName'] ?? ''; ?>">
              <?= isset($errors['shopName']) ? '<div class="invalid-feedback">' . $errors['shopName'] . '</div>' : ''; ?> 
            </div>

           
            
            <!--submit button-->
            <button type="submit" class="btn btn-outline-secondary mb-3">Change Password</button>
          </form>

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
  <!-- AdminLTE for demo purposes -->
  <script src="/js/adminlte/demo.js"></script>
  <!-- Select2 -->
  <script src="/js/select2/select2.full.min.js"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
  </script>
</body>

</html>