<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cart</title>
</head>

<body>
    <?php
        $page = 'customerCare';
        include 'header.php';
    ?>
    <!-- Collection Slot -->
    <div class="py-5">
        <div class="container" style="min-width:700px;max-width:700px;background-color:#F1F1F1">
            <h1 class="text-center pt-4 " style="font-family: Gill Sans, sans-serif;"> Select Collection Slot </h1>
            <select name="slot" id="slot" style="width:85%;" class="my-4 mx-5">
                <option value="slot">0-5</option>
                <option value="slot">5-10</option>
                <option value="slot">10-15</option>
                <option value="slot">15-20</option>
            </select>
        </div>
    </div>
    <!-- Payment Method -->
    <div class="py-5">
        <div class="container" style="min-width:700px;max-width:700px;background-color:#F1F1F1">
            <h1 class="text-center pt-4 " style="font-family: Gill Sans, sans-serif;"> Select Payment Method </h1>
            <div class=container class="mt-4" style="background-color:#cccccc;min-width:600px;max-width:600px">
                <h1 class="text-center pt-4 px-4" style="font-family: Gill Sans, sans-serif;" class="my-4" id="order"> Order
                    Summary
                </h1>
                <P>Total Amount</p>
                <P>Sub Total</p>
            </div>
            <div class="row" style="min-width:790px;max-width:790px">
                <div class=" col-sm-4 pb-lg-4 md-4 mb-4">
                    <a href="#"><img src="assets/images/card.jpeg" class="image-fluid" style="width:50%;"> </a>
                        <p>Credit/debit Card</p>
                </div>

                <div class=" col-sm-4 pb-lg-4 md-4mb-4" class="px-2">
                    <a href="#"><img src="assets/images/cash.png" class="image-fluid" style="width:50%"> </a>
                        <p>Cash On Delivery</p>
                </div>
                <div class=" col-sm-4 pb-lg-4 md-4mb-4">
                    <a href="#"><img src="assets/images/paypal.png" class="image-fluid" style="width:50%;"> </a>
                        <p class="mx-4">PayPal</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>

</html>