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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
     <section class="login-clean">
        <form method="post" style="background: #c5c3c3;">
            <h1 class="text-center" style="margin: 30px;margin-top: -2px; color: black;">Login</h1>
            <div class="mb-3"><input class="form-control" type="email" name="username" placeholder="username"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Log In</button></div>
            <a class="forgot" href="forgotpassword.php" style="font-size: 17px;color: #fb7925;">Forgot password?</a><a class="forgot" href="#">Terms and condition</a>
        </form>
    </section>
    <?php include 'footer.php'?>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>