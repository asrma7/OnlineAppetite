<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Login-Form.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <section class="login-clean">
        <form method="post" style="background: #c5c3c3;">
            <h4 class="text-center" style="font-size:22px; margin: 30px;margin-top: -2px; color: black;">Change Password</h4>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="New Password"></div>
            <div class="mb-3"><input class="form-control" type="password" name="confirm" placeholder="Confirm New Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Change Password</button></div>
        </form>
    </section>
    <?php include 'footer.php'?>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>