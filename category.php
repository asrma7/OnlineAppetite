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
    <div class="text-center py-5">
        <h2>Category: <?= $pageCategory ?></h2>
        <div class="products">
            <?php
            foreach ($products as $product) {
                $discounts = fetch_all_row("SELECT rate FROM discounts WHERE ((discount_type = 'all') OR (discount_type = 'category' AND target_id = '" . $product['category_id'] . "') OR (discount_type = 'product' AND target_id = '" . $product['product_id'] . "') AND starts_on < CURRENT_DATE AND expires_on > CURRENT_DATE)");
                $discounted_price = $product['price'];
                foreach ($discounts as $discount) {
                    $discounted_price = $discounted_price * (100 - $discount['rate']) * 0.01;
                }
                $discount_rate = ($product['price'] - $discounted_price) * 100 / $product['price'];
            ?>
                <div class="product" onclick="window.location.href='/product.php?id=<?= $product['product_id'] ?>'">
                    <img class="product-image" src="<?= $product['image1'] ?>" alt="">
                    <span class="product-name py-2"><?= $product['product_name'] ?></span>
                    <span class="price pb-2"><?= $product['price'] - $discounted_price ?></span>
                    <div>
                        <span class="discount"><?= $product['product_name'] ?></span> -
                        <span class="rate"><?= $discount_rate ?>%</span>
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