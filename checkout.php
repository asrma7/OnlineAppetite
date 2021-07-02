<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
if(!isset($_SESSION['user'])){
    header('Location: signin.php');
}
else {
    $cart = $_SESSION['user']['cart']??[];
    $total = 0.0;
    $discountedPrice = 0.0;
    $code = $_GET['voucher']??'';
    $voucher = fetch_row("SELECT * FROM VOUCHERS WHERE VOUCHER_CODE = '$code'");
    foreach ($cart as $shop){
        foreach ($shop['products'] as $product_id=>$product) {
            $total += $product['price']*$product['quantity'];
            $discountedPrice += $product['discounted_price']*$product['quantity'];
        }
    }
    if(isset($voucher) && $total > $voucher['MINIMUM']) {
        $discountedPrice -= $voucher['DISCOUNT_AMOUNT'];
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">
    <title>Cart</title>
</head>

<body>
    <?php
    include 'header.php';
    $slots = fetch_all_row("SELECT SLOTS.*, (SELECT COUNT(*) FROM ORDERS WHERE ORDERS.SLOT_ID = SLOTS.SLOT_ID) AS ORDER_COUNT FROM SLOTS");
    
    ?>
    <!-- Collection Slot -->
    <div class="py-5">
        <div class="container" style="max-width:700px;background-color:#FFFFFF">
            <h2 class="text-center pt-4"> Select Collection Slot </h1>
                <select name="slot" id="slot" style="width:85%; height: 30px" class="my-4 mx-5">
                    <?php foreach ($slots as $slot) { ?>
                        <option value="slot" <?= $slot['ORDER_COUNT'] >= 20 ? 'disabled' : '' ?>><?= $slot['SLOT_TIME'] ?> <?= $slot['ORDER_COUNT'] >= 20 ? '(Full)' : '' ?></option>
                    <?php } ?>
                </select>
        </div>
    </div>
    <!-- Payment Method -->
    <div class="container mb-5" style="max-width:700px;background-color:#FFFFFF">
        <h2 class="text-center py-3"> Select Payment Method </h2>
        <div class="container py-4" style="background-color:#cccccc;max-width:600px">
            <h2 class="text-center px-3 mb-3"> Order Summary</h2>
            <div class="amount my-2"><span>Total Amount</span><span><?= $total ?></span></div>
            <div class="amount my-2"><span>Discount Amount</span><span><?= $total - $discountedPrice ?></span></div>
            <div class="amount my-2"><span>Sub Total</span><span><?= $discountedPrice ?></span></div>
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