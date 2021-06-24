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
                <img src="/assets//images/adminlte//avatar2.png" alt="" class="img-circle elevation-2">
              </div>
              <div class="form-group mt-4">
                <label for="productImage">Product Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="productImage" class="custom-file-input" id="productImage">
                    <label class="custom-file-label" for="productImage">Choose image</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 offset-md-1 col-sm-6 col-12">
              <div class="form-group">
                <label for="name">Business Name</label>
                <input type="text" id="name" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Business Email</label>
                <input type="email" id="email" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="contact">Contact No.</label>
                <input type="text" id="contact" name="contact" class="form-control">
              </div>
              <div class="form-group">
              <label for="category">Gender</label>
              <select id="category" name="category" class="form-control">
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
              </select>
              <div class="form-group">
                <strong>Address</strong>
                <div class="row">
                  <div class="col-6">
                    <input type="text" id="st1" name="st1" class="form-control" placeholder="Street Address 1">
                  </div>
                  <div class="col-6">
                    <input type="text" id="st2" name="st2" class="form-control" placeholder="Street Address 2">
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-6">
                    <input type="text" id="city" name="city" class="form-control" placeholder="City">
                  </div>
                  <div class="col-6">
                    <input type="text" id="state" name="state" class="form-control" placeholder="State/Province">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <input type="text" id="postal" name="postal" class="form-control" placeholder="Postal Code">
                  </div>
                  <div class="col-6">
                    <input type="text" id="country" name="country" class="form-control" placeholder="Country">
                  </div>
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