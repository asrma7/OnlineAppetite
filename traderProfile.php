<?php
require_once 'sessionManager.php';
require_once 'utils/database.php';
$user_id = $_GET['id'];
$user = fetch_row("SELECT * FROM users LEFT JOIN traders on users.user_id = traders.user_id WHERE users.user_id =='$user_id'");
if (!$user || $user['user_role'] != 2) {
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

    <title><?= $user['full_name'] ?></title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container-fluid d-flex justify-content-center">
        <div class="w-75 p-5 my-5 bg-dark text-light">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="img">
                        <img src="<?= $user['image'] ?? '/assets//images/adminlte//avatar2.png' ?>" alt="" class="img-circle elevation-2">
                    </div>
                    <div class="mt-4 text-center">
                        <strong>Registered on: </strong>
                        <hr>
                        <span><?= date('jS M Y', strtotime($user['created_at'])) ?></span>
                    </div>
                </div>
                <div class="col-md-8 offset-md-1 col-sm-6 col-12">
                    <div class="row">
                        <div class="col-6">
                            <i>Business Name</i>
                            <p><?= $user['full_name'] ?></p>
                            <i>Gender</i>
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
                            <i>Street Address</i><br>
                            <p><?= $user['street']; ?></p>
                            <i>City</i><br>
                            <p><?= $user['city']; ?></p>
                            <i>Postal Code</i><br>
                            <p><?= $user['postal']; ?></p>
                            <i>Business type</i><br>
                            <p><?= $user['business_type']; ?></p>
                        </div>
                        <div class="col-6">
                            <i>Business Email</i>
                            <p><?= $user['email'] ?></p>
                            <i>Contact No.</i>
                            <p><?= $user['contact_no'] ?></p>
                            <i>State/Province</i><br>
                            <p><?= $user['state']; ?></p>
                            <i>Country</i><br>
                            <p><?= $user['country']; ?></p>
                            <i>Trading Since</i><br>
                            <p><?= $user['trading_since']; ?></p>
                            <i>Preferred Payments</i><br>
                            <p><?= $user['preferred_payments']; ?></p>
                        </div>
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