<?php
require_once 'utils/database.php';
$count = $_GET['more'] ?? '' == 'true' ? 24 : 12;
$latestProducts = fetch_all_row("SELECT PRODUCTS.*, (SELECT AVG(RATING) FROM REVIEWS WHERE REVIEWS.PRODUCT_ID = PRODUCTS.PRODUCT_ID) AS RATING FROM PRODUCTS WHERE CONFIRMED_ON IS NOT NULL ORDER BY CREATED_AT " . limit_result(4));
$products = fetch_all_row("SELECT PRODUCTS.*, (SELECT AVG(RATING) FROM REVIEWS WHERE REVIEWS.PRODUCT_ID = PRODUCTS.PRODUCT_ID) AS RATING FROM PRODUCTS WHERE CONFIRMED_ON IS NOT NULL ORDER BY " . random_order() . " " . limit_result($count));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>OnlineAppetite</title>
</head>

<body>
    <?php
    $page = 'home';
    include 'header.php';
    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="assets/images/slider1.jpg" alt="slider1">
    </div>

    <div class="item">
      <img src="assets/images/slider2.jpg" alt="slider2">
    </div>

    <div class="item">
      <img src="assets/images/slider3.jpg" alt="slider3">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <div class="container text-center py-5">
        <div class="latest-container">
            <h3 class="text-start" style="padding-left: 25px;">Categories</h3>
            <div class="index-categories">
                <?php
                foreach ($categories as $category) {
                ?>
                    <div class="index-category" onclick="window.location.href='/category.php?id=<?= $category['CATEGORY_ID'] ?>'">
                        <img class="category-image" src="<?= $category['IMAGE'] ?>" alt="Category Image">
                        <div class="category-data">
                            <span class="category-name py-2"><?= $category['CATEGORY_NAME'] ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="latest-container">
            <h3 class="text-start" style="padding-left: 25px;">Latest Products</h3>
            <div class="products">
                <?php
                foreach ($latestProducts as $product) {
                    $discounts = fetch_all_row("SELECT RATE FROM DISCOUNTS WHERE ((DISCOUNT_TYPE = 'all') OR (DISCOUNT_TYPE = 'category' AND TARGET_ID = '" . $product['CATEGORY_ID'] . "') OR (DISCOUNT_TYPE = 'product' AND TARGET_ID = '" . $product['PRODUCT_ID'] . "')) AND STARTS_ON < CURRENT_DATE AND EXPIRES_ON > CURRENT_DATE ORDER BY DISCOUNT_TYPE");
                    $discounted_price = round($product['PRICE'] / 100.0, 2);
                    foreach ($discounts as $discount) {
                        $discounted_price = $discounted_price * (100 - $discount['RATE']) * 0.01;
                    }
                    $discount_rate = (round($product['PRICE'] / 100.0, 2) - $discounted_price) * 100 / round($product['PRICE'] / 100.0, 2);
                ?>
                    <div class="product" onclick="window.location.href='/product.php?id=<?= $product['PRODUCT_ID'] ?>'">
                        <img class="product-image" src="<?= $product['IMAGE1'] ?>" alt="">
                        <div class="product-data">
                            <span class="product-name py-2"><?= $product['PRODUCT_NAME'] ?></span>
                            <span class="price pb-2">£ <?= number_format((float)$discounted_price, 2, '.', '') ?></span>
                            <?php
                            if (round($product['PRICE'] / 100.0, 2) != $discounted_price) {
                            ?>
                                <div>
                                    <span class="discount">£ <?= number_format((float)$product['PRICE'] / 100, 2, '.', '') ?></span> -
                                    <span class="rate"><?= round($discount_rate, 2) ?>%</span>
                                </div>
                            <?php
                            }
                            ?>
                            <?php if ($product['RATING'] > 0) { ?>
                                <div class="stars d-inline-block">
                                    <?php
                                    for ($i = 0; $i < (int)$product['RATING']; $i++) {
                                        echo '<small class="fas fa-star text-warning"></small>';
                                    }
                                    $remaining = 5 - (int)$product['RATING'];
                                    if ($product['RATING'] != (int)$product['RATING']) {
                                        echo '<small class="fas fa-star-half-alt text-warning"></small>';
                                        $remaining--;
                                    }
                                    for ($i = 0; $i < $remaining; $i++) {
                                        echo '<small class="far fa-star text-warning"></small>';
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="products-container">
            <h3 class="text-start" style="padding-left: 20px;">Just For You</h3>
            <div class="products">
                <?php
                foreach ($products as $product) {
                    $discounts = fetch_all_row("SELECT RATE FROM DISCOUNTS WHERE ((DISCOUNT_TYPE = 'all') OR (DISCOUNT_TYPE = 'category' AND TARGET_ID = '" . $product['CATEGORY_ID'] . "') OR (DISCOUNT_TYPE = 'product' AND TARGET_ID = '" . $product['PRODUCT_ID'] . "')) AND STARTS_ON < CURRENT_DATE AND EXPIRES_ON > CURRENT_DATE");
                    $discounted_price = round($product['PRICE'] / 100.0, 2);
                    foreach ($discounts as $discount) {
                        $discounted_price = $discounted_price * (100 - $discount['RATE']) * 0.01;
                    }
                    $discount_rate = (round($product['PRICE'] / 100.0, 2) - $discounted_price) * 100 / round($product['PRICE'] / 100.0, 2);
                ?>
                    <div class="product" onclick="window.location.href='/product.php?id=<?= $product['PRODUCT_ID'] ?>'">
                        <img class="product-image" src="<?= $product['IMAGE1'] ?>" alt="">
                        <div class="product-data">
                            <span class="product-name py-2"><?= $product['PRODUCT_NAME'] ?></span>
                            <span class="price pb-2">£ <?= number_format((float)$discounted_price, 2, '.', '') ?></span>
                            <?php
                            if (round($product['PRICE'] / 100.0, 2) != $discounted_price) {
                            ?>
                                <div>
                                    <span class="discount">£ <?= number_format((float)$product['PRICE'] / 100, 2, '.', '') ?></span> -
                                    <span class="rate"><?= round($discount_rate, 2) ?>%</span>
                                </div>
                            <?php
                            }
                            ?>
                            <?php if ($product['RATING'] > 0) { ?>
                                <div class="stars d-inline-block">
                                    <?php
                                    for ($i = 0; $i < (int)$product['RATING']; $i++) {
                                        echo '<small class="fas fa-star text-warning"></small>';
                                    }
                                    $remaining = 5 - (int)$product['RATING'];
                                    if ($product['RATING'] != (int)$product['RATING']) {
                                        echo '<small class="fas fa-star-half-alt text-warning"></small>';
                                        $remaining--;
                                    }
                                    for ($i = 0; $i < $remaining; $i++) {
                                        echo '<small class="far fa-star text-warning"></small>';
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <button class="loadmore" onclick="window.location.href='/?more=true'">LOAD MORE</button>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>