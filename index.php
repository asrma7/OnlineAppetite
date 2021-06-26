<?php
require_once 'sessionManager.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <title>OnlineAppetite</title>
</head>
<body>
    <?php
        $page = 'home'; 
        include 'header.php';
    ?>
    <div class="slider">
        <img id="sliderimage">
        <div id="sliderpoints">
            <div class="sliderpoint active" data-index="0"></div>
            <div class="sliderpoint" data-index="1"></div>
            <div class="sliderpoint" data-index="2"></div>
            <div class="sliderpoint" data-index="3"></div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <?php
            for($i=0; $i<10; $i++){
            ?>
            <div class="product">
                <img class="product-image" src="assets/images/placeholder.png" alt="">
                <span class="product-name">Product Name</span>
                <span class="price">750</span>
                <div>
                    <span class="discount">1000</span> - 
                    <span class="rate">25%</span>
                </div>
            </div>
            <?php } ?>
        </div>
        <button class="loadmore">LOAD MORE</button>
    </div>
    <?php include 'footer.php';?>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
</body>
</html>