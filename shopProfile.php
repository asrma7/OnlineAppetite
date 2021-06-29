<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
$shop_id = $_GET['id'];
$shop = fetch_row("SELECT shops.*, users.full_name, users.email, users.user_id FROM shops LEFT JOIN users on shops.trader_id = users.user_id WHERE shops.shop_id =='$shop_id'");
if (!$shop) {
    header('Location: 404.php');
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

    <title><?= $shop['shop_name'] ?></title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="w-75 p-5 my-5 bg-dark text-light">
            <div class="row">
                <div class="col-md-4 offset-md-1 col-sm-6 col-12">
                    <div class="img">
                        <img src="/assets/images//onlineStore.jpg" alt="" class="w-100 elevation-2">
                    </div>
                    <div class="mt-4 text-center">
                        <strong>Registered on: </strong>
                        <hr>
                        <span><?= date('jS M Y', strtotime($shop['created_at'])) ?></span>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <i>Shop Name</i>
                            <p><?= $shop['shop_name'] ?></p>
                            <i>Address</i><br>
                            <p><?= $shop['address']; ?></p>
                            <i>Shop type</i><br>
                            <p><?= $shop['shop_type']; ?></p>
                        </div>
                        <div class="col-6">
                            <i>Trader Name</i>
                            <p><a class="text-light" href="traderProfile.php?id=<?= $shop['user_id'] ?>"><?= $shop['full_name'] ?></a></p>
                            <i>Trader Email</i>
                            <p><?= $shop['email'] ?></p>
                            <i>Contact No.</i>
                            <p><?= $shop['contact_no'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <i>About shop</i>
                        <p><?= $shop['description'] ?></p>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div><!-- /.container-fluid -->
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </script>
</body>

</html>