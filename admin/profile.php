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
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    $page = "Profile";
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
                <img src="/assets//images/adminlte//avatar5.png" alt="" class="img-circle elevation-2">
              </div>
            </div>
            <div class="col-md-8 offset-md-1 col-sm-6 col-12">
              <div class="row">
                <div class="col-6">
                  <strong>First Name</strong>
                  <p>Ashutosh</p>
                </div>
                <div class="col-6">
                  <strong>Last Name</strong>
                  <p>Sharma</p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <strong>Email</strong>
                  <p>asrma.sharma@gmail.com</p>
                </div>
                <div class="col-6">
                  <strong>Contact No.</strong>
                  <p>+977-9868288387</p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <strong>Gender</strong>
                  <p>Male</p>
                </div>
                <div class="col-6">
                  <strong>Role</strong>
                  <p>Administrator</p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                <a href="editprofile.php"><button class="btn btn-secondary mb-2">Edit Profile</button></a>
                </div>
                <div class="col-6">
                <a href="changepass.php"><button class="btn btn-secondary mb-2">Change Password</button></a>
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
  <!-- AdminLTE for demo purposes -->
  <script src="/js/adminlte/demo.js"></script>
</body>

</html>