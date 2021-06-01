<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Registration-Form.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
<section class="register-photo">
        <div class="form-container" style="min-width: 500px;max-width: 500px;color: rgb(33, 37, 41);">
            <form method="post" style="background: #c5c3c3;">
                <h2 class="text-center"><strong>Register</strong></h2>
                <div class="mb-3"><input class="form-control" type="email" placeholder="Name:" name="name" required="" style="background: rgb(255, 255, 255);"></div>
                <div class="mb-3"><input class="form-control" type="email" name="username" placeholder="Username:" required=""></div>
                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email:" required=""></div>
                <div class="mb-3"><input class="form-control" type="email" name="Address" placeholder="Address:" required=""></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password:" required=""></div>
                <div class="mb-3"><input class="form-control" type="password" name="confirm password" placeholder="Confirm Password:" required=""></div>
                <div class="mb-3">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to the to the terms and condition</label></div>
                </div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Register</button></div><a class="already" href="signin.php" style="color: #fb7925;">Already have an account?</a>
            </form>
        </div>
    </section>
    <?php include 'footer.php'?>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>