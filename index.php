<?php
require_once 'utils/database.php';
$count = $_GET['more'] ?? '' == 'true' ? 30 : 15;
$latestProducts = fetch_all_row("SELECT * FROM PRODUCTS ORDER BY CREATED_AT ".limit_result(5));
$products = fetch_all_row("SELECT * FROM PRODUCTS ORDER BY ".random_order()." ".limit_result($count));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
        <img id="sliderimage" src="/assets/images/slider1.jpg">
        <div id="sliderpoints">
            <div class="sliderpoint active" data-index="0"></div>
            <div class="sliderpoint" data-index="1"></div>
            <div class="sliderpoint" data-index="2"></div>
            <div class="sliderpoint" data-index="3"></div>
        </div>
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
                    $discounts = fetch_all_row("SELECT RATE FROM DISCOUNTS WHERE ((DISCOUNT_TYPE = 'all') OR (DISCOUNT_TYPE = 'category' AND TARGET_ID = '" . $product['CATEGORY_ID'] . "') OR (DISCOUNT_TYPE = 'product' AND TARGET_ID = '" . $product['PRODUCT_ID'] . "') AND STARTS_ON < CURRENT_DATE AND EXPIRES_ON > CURRENT_DATE)");
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
                            if ($product['PRICE'] != $discounted_price) {
                            ?>
                                <div>
                                    <span class="discount">£ <?= number_format((float)$product['PRICE'] / 100, 2, '.', '') ?></span> -
                                    <span class="rate"><?= round($discount_rate, 2) ?>%</span>
                                </div>
                            <?php
                            }
                            ?>
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
                    $discounts = fetch_all_row("SELECT RATE FROM DISCOUNTS WHERE ((DISCOUNT_TYPE = 'all') OR (DISCOUNT_TYPE = 'category' AND TARGET_ID = '" . $product['CATEGORY_ID'] . "') OR (DISCOUNT_TYPE = 'product' AND TARGET_ID = '" . $product['PRODUCT_ID'] . "') AND STARTS_ON < CURRENT_DATE AND EXPIRES_ON > CURRENT_DATE)");
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
                            if ($product['PRICE'] != $discounted_price) {
                            ?>
                                <div>
                                    <span class="discount">£ <?= number_format((float)$product['PRICE'] / 100, 2, '.', '') ?></span> -
                                    <span class="rate"><?= round($discount_rate, 2) ?>%</span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <button class="loadmore" onclick="window.location.href='/?more=true'">LOAD MORE</button>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/adminlte/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
</body>

</html>