<?php
require 'utils/database.php';
$category_id = $_GET['id'];
$pageCategory = fetch_row("SELECT * FROM categories WHERE category_id = '$category_id'")['category_name'];
$count = $_GET['more'] ?? '' == 'true' ? 30 : 15;
$products = fetch_all_row("SELECT * FROM products WHERE category_id = '$category_id' ORDER BY created_at LIMIT '$count'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title><?= $pageCategory ?></title>
</head>

<body>
    <?php
    $page = 'category';
    include 'header.php';
    ?>
    <div class="container text-center py-5">
        <h2 class="text-start" style="padding-left: 25px;">Category: <?= $pageCategory ?></h2>
        <div class="products">
            <?php
            foreach ($products as $product) {
                $discounts = fetch_all_row("SELECT rate FROM discounts WHERE ((discount_type = 'all') OR (discount_type = 'category' AND target_id = '" . $product['category_id'] . "') OR (discount_type = 'product' AND target_id = '" . $product['product_id'] . "') AND starts_on < CURRENT_DATE AND expires_on > CURRENT_DATE)");
                $discounted_price = round($product['price'] / 100.0, 2);
                foreach ($discounts as $discount) {
                    $discounted_price = $discounted_price * (100 - $discount['rate']) * 0.01;
                }
                $discount_rate = (round($product['price'] / 100.0, 2) - $discounted_price) * 100 / round($product['price'] / 100.0, 2);
            ?>
                <div class="product" onclick="window.location.href='/product.php?id=<?= $product['product_id'] ?>'">
                    <img class="product-image" src="<?= $product['image1'] ?>" alt="">
                    <div class="product-data">
                        <span class="product-name py-2"><?= $product['product_name'] ?></span>
                        <span class="price pb-2">£ <?= number_format((float)$discounted_price, 2, '.', '') ?></span>
                        <?php
                        if ($product['price'] != $discounted_price) {
                        ?>
                            <div>
                                <span class="discount">£ <?= number_format((float)$product['price'] / 100, 2, '.', '') ?></span> -
                                <span class="rate"><?= round($discount_rate, 2) ?>%</span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="loadmore" onclick="window.location.href='/category.php?id=<?= $category_id ?>&more=true'">LOAD MORE</button>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    </script>
</body>

</html>