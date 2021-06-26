<?php
require_once '../sessionManager.php';
if (!isset($_SESSION['trader'])) {
  header('Location: /trader/login.php');
} else {
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
    $page = "AddProduct";
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
                <li class="breadcrumb-item">Products</li>
                <li class="breadcrumb-item active">Add Product</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <h5 class="mb-2">Add Product</h5>

          <form class="addForm" action="insertProduct.php" method="POST">
            <?php if (isset($message)) { ?>
              <div class="alert alert-<?= $message['color'] ?> text-center" role="alert">
                <?= $message['message']; ?>
              </div>
            <?php } ?>
            <!--product name-->
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" id="productName" name="productName" class="form-control <?= isset($errors['productName']) ? 'is-invalid' : ''; ?>" value="<?= $old['productName'] ?? ''; ?>">
              <?= isset($errors['productName']) ? '<div class="invalid-feedback">' . $errors['productName'] . '</div>' : ''; ?>
            </div>
            <!--price-->
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" id="price" name="price" class="form-control <?= isset($errors['price']) ? 'is-invalid' : ''; ?>" value="<?= $old['price'] ?? ''; ?>">
              <?= isset($errors['price']) ? '<div class="invalid-feedback">' . $errors['price'] . '</div>' : ''; ?>
            </div>
            <!--category-->
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control select2 select2-danger <?= isset($errors['category']) ? 'is-invalid' : ''; ?>" id="category" name="category" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option <?php echo !isset($old['category']) ? 'selected' : ''; ?> disabled>Select one</option>
                <option <?php if (isset($old['category'])) echo $old['category'] == '1' ? 'selected' : '';?> value="1">Alaska</option>
                <option <?php if (isset($old['category'])) echo $old['category'] == '2' ? 'selected' : '';?> value="2">California</option>
                <option <?php if (isset($old['category'])) echo $old['category'] == '3' ? 'selected' : '';?> value="3">Delaware</option>
              </select>
              <?= isset($errors['category']) ? '<div class="invalid-feedback">' . $errors['category'] . '</div>' : ''; ?>
            </div>
            <!--quantity-->
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" id="quantity" name="quantity" class="form-control <?= isset($errors['quantity']) ? 'is-invalid' : ''; ?>" value="<?= $old['quantity'] ?? ''; ?>">
              <?= isset($errors['quantity']) ? '<div class="invalid-feedback">' . $errors['quantity'] . '</div>' : ''; ?>
            </div>
            <!--shop-->
            <div class="form-group">
              <label for="shop">Shop</label>
              <select class="form-control select2 select2-danger <?= isset($errors['shop']) ? 'is-invalid' : ''; ?>" id="shop" name="shop" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option <?php echo !isset($old['shop']) ? 'selected' : ''; ?> disabled>Select one</option>
                <option <?php if (isset($old['shop'])) echo $old['shop'] == '1' ? 'selected' : '';?> value="1">Alaska</option>
                <option <?php if (isset($old['shop'])) echo $old['shop'] == '2' ? 'selected' : '';?> value="2">California</option>
                <option <?php if (isset($old['shop'])) echo $old['shop'] == '3' ? 'selected' : '';?> value="3">Delaware</option>
              </select>
              <?= isset($errors['shop']) ? '<div class="invalid-feedback">' . $errors['shop'] . '</div>' : ''; ?>
            </div>
            <!--description-->
            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea id="inputDescription" class="form-control <?= isset($errors['description']) ? 'is-invalid' : ''; ?>" value="<?= $old['description'] ?? ''; ?>" name="description" rows="4"></textarea>
              <?= isset($errors['description']) ? '<div class="invalid-feedback">' . $errors['description'] . '</div>' : ''; ?>
            </div>
            <!--product image-->
            <div class="form-group">
              <label for="productImage">Product Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="productImage" class="custom-file-input" id="productImage">
                  <label class="custom-file-label" for="productImage">Choose product image</label>
                </div>
              </div>
            </div>
            <!--submit button-->
            <button type="submit" class="btn btn-outline-secondary mb-3">Add Product</button>
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