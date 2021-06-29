<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/checkout.css">
    <title>Cart</title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <!-- Collection Slot -->
    <div class="py-5">
        <div class="container" style="max-width:700px;background-color:#F1F1F1">
            <h2 class="text-center pt-4"> Select Collection Slot </h1>
                <select name="slot" id="slot" style="width:85%; height: 30px" class="my-4 mx-5">
                    <option value="slot">0-5</option>
                    <option value="slot">5-10</option>
                    <option value="slot">10-15</option>
                    <option value="slot">15-20</option>
                </select>
        </div>
    </div>
    <!-- Payment Method -->
    <div class="container mb-5" style="max-width:700px;background-color:#F1F1F1">
        <h2 class="text-center py-3"> Select Payment Method </h2>
        <div class="container py-4" style="background-color:#cccccc;max-width:600px">
            <h2 class="text-center px-3 mb-3"> Order Summary</h2>
            <div class="amount my-2"><span>Total Amount</span><span>Price</span></div>
            <div class="amount my-2"><span>Discount Amount</span><span>Price</span></div>
            <div class="amount my-2"><span>Sub Total</span><span>Price</span></div>
        </div>
        <div class="row mt-4" style="max-width:790px">
            <div class="col-md-4 text-center">
                <a href="#"><img src="assets/images/card.jpeg" class="image-fluid" style="width:100px;"> </a>
                <p>Credit/debit Card</p>
            </div>

            <div class="col-md-4 text-center" class="px-2">
                <a href="#"><img src="assets/images/cash.png" class="image-fluid" style="width:100px"> </a>
                <p>Cash On Delivery</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="#"><img src="assets/images/paypal.png" class="image-fluid" style="width:100px;"> </a>
                <p class="mx-4">PayPal</p>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>