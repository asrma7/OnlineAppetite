<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
$product_id = $_GET['id'];
$user_id = $_SESSION['user']['user_id'] ?? "";
$currentProduct = fetch_row("SELECT *, (SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.product_id) AS rating FROM products INNER JOIN shops ON shops.shop_id = products.shop_id WHERE product_id = '$product_id'");
$discounts = fetch_all_row("SELECT rate FROM discounts WHERE ((discount_type = 'all') OR (discount_type = 'category' AND target_id = '" . $currentProduct['category_id'] . "') OR (discount_type = 'product' AND target_id = '" . $currentProduct['product_id'] . "') AND starts_on < CURRENT_DATE AND expires_on > CURRENT_DATE)");
$current_discounted_price = round($currentProduct['price'] / 100, 2);
foreach ($discounts as $discount) {
    $current_discounted_price = $current_discounted_price * (100 - $discount['rate']) * 0.01;
}
$current_discount_rate = (round($currentProduct['price'] / 100, 2) - $current_discounted_price) * 100 / round($currentProduct['price'] / 100, 2);
$products = fetch_all_row("SELECT * FROM products WHERE product_id != '$product_id' AND category_id == '" . $currentProduct['category_id'] . "' ORDER BY created_at LIMIT 10");
$reviews = fetch_all_row("SELECT * FROM reviews INNER JOIN users ON users.user_id = reviews.user_id WHERE product_id == '$product_id' ORDER BY created_at LIMIT 4");
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/star-rating/star-rating.min.css">
    <link rel="stylesheet" href="css/star-rating/theme.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <title>Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <!-- Product Names -->
    <div class="text-center">
        <div class="container-lg py-5">
            <div class="row">
                <div class="col-md-7 py-5" style="background-color:#c4c4c4">
                    <div class="row justify-content-around">
                        <div class="col-sm-5" style="display:inline-block; text-align:start;">
                            <img src="<?= $currentProduct['image1'] ?>" class="img-fluid" id="product1">
                            <br>
                            <img src="<?= $currentProduct['image1'] ?>" onclick="setPreview(this.src)" class="thumbnail">
                            <img src="<?= $currentProduct['image2'] ?>" onclick="setPreview(this.src)" class="thumbnail">
                        </div>
                        <div class="col-sm-7 text-start">
                            <h1 style="font-family: Gill Sans, sans-serif;font-size: 28px;margin-top:10%"><?= $currentProduct['product_name'] ?></h1>
                            <div class="stars">
                                <?php
                                for ($i = 0; $i < (int)$currentProduct['rating']; $i++) {
                                    echo '<span class="fas fa-star"></span>';
                                }
                                $remaining = 5 - (int)$currentProduct['rating'];
                                if ($currentProduct['rating'] != (int)$currentProduct['rating']) {
                                    echo '<span class="fas fa-star-half-alt"></span>';
                                    $remaining--;
                                }
                                for ($i = 0; $i < $remaining; $i++) {
                                    echo '<span class="far fa-star"></span>';
                                }
                                ?>
                            </div>
                            <br>
                            <span style="color:#F1592A; font-weight:500; font-size:20px;"> £ <?= number_format((float)$current_discounted_price, 2, '.', '') ?> </span><br>
                            <?php
                            if ($currentProduct['price'] != $current_discounted_price) {
                            ?>
                                <div>
                                    <span class="discount">£ <?= number_format((float)$currentProduct['price'] / 100.0, 2, '.', '') ?></span> -
                                    <span class="rate"><?= round($current_discount_rate, 2) ?>%</span>
                                </div>
                            <?php
                            }
                            ?>
                            <span>Quantity:</span>
                            <form class="quantity-form">
                                <button class="value-button" onclick="decreaseValue()" value="Decrease Value">-</button>
                                <input type="number" class="number-count" id="number" value="1" />
                                <button class="value-button" onclick="increaseValue(<?= $currentProduct['stock'] ?>)" value="Increase Value">+</button>
                            </form>
                            <div class="stock"><?= $currentProduct['stock'] ?> items in stock</div>
                            <div class="product-buttons">
                                <div>
                                    <button type="button" class="btn btn-secondary" onclick="addCart()">Buy Now</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" onclick="addCart()">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-description p-5">
                        <h2>Product details of <?= $currentProduct['product_name'] ?></h2>
                        <?= $currentProduct['description'] ?>
                    </div>
                </div>
                <div class="col-md-4 offset-md-1 py-4 d-flex flex-column justify-content-between" style="text-align:start;background-color:#c4c4c4">
                    <div>
                        <div style="color:#5B5B5B">Sold By</div>
                        <a href="shopProfile.php?id=<?= $currentProduct['shop_id'] ?>">
                            <h3 style="color:#5B5B5B"><?= $currentProduct['shop_name'] ?></h3>
                        </a>
                        <div style="color:#5B5B5B">Recent Reviews:</div>
                        <div class="reviews">
                            <?php
                            foreach ($reviews as $review) {
                                if ($review['user_id'] == $user_id && $review['product_id'] == $product_id)
                                    $user_review = $review;
                            ?>
                                <div class="customer-review p-2">
                                    <img src="<?= $review['image'] ?>" class="profilepic" alt="">
                                    <span class="customer-name"><?= $review['full_name'] ?></span>
                                    <div class="stars d-inline-block px-3">
                                        <?php
                                        for ($i = 0; $i < (int)$review['rating']; $i++) {
                                            echo '<span class="fas fa-star"></span>';
                                        }
                                        $remaining = 5 - (int)$review['rating'];
                                        if ($review['rating'] != (int)$review['rating']) {
                                            echo '<span class="fas fa-star-half-alt"></span>';
                                            $remaining--;
                                        }
                                        for ($i = 0; $i < $remaining; $i++) {
                                            echo '<span class="far fa-star"></span>';
                                        }
                                        ?>
                                    </div>
                                    <span class="review"><?= $review['review'] ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="add-review">
                        <hr>
                        <form action="backend/addReview.php" method="POST">
                            <input id="rating" name="rating" class="rating-loading" data-size="sm" value="<?= $user_review['rating'] ?? '' ?>" required>
                            <input name="product_id" type="hidden" value="<?= $product['product_id'] ?>">
                            <textarea name="review" class="reviewbox" placeholder="Enter your review here..." id="reviewbox" rows="4" required><?= $user_review['review'] ?? '' ?></textarea>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary">Post</button>
                                <?php
                                if (!empty($user_review))
                                    echo '<button class="btn btn-outline-danger" onclick="event.preventDefault();window.location.href=\'/backend/deleteReview.php?id=' . $user_review['review_id'] . '\'">remove</button>';
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Similar Products -->
    <h1 style="font-family: Gill Sans, sans-serif;font-size: 28px;" class="text-center mt-5">Related Products</h1>
    <div class="container">
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
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/adminlte/jquery.min.js"></script>
    <script src="js/star-rating.min.js"></script>

    <!-- Quantity button script -->
    <script>
        function setPreview(src) {
            preview = document.getElementById('product1');
            preview.src = src;
        }

        function increaseValue(stock) {
            event.preventDefault();
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 1 : value;
            if (value >= stock) {
                alert('Out of stock');
            } else {
                value++;
                document.getElementById('number').value = value;
            }
        }

        $('#number').change(function() {
            var stock = $(this).data('stock');
            if ($(this).val() > stock) {
                alert('Out of stock');
                $(this).val(stock);
            }
        });

        function decreaseValue() {
            event.preventDefault();
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 1 : value;
            value < 2 ? value = 2 : '';
            value--;
            document.getElementById('number').value = value;
        }
    </script>

    <!-- Product magnification script -->
    <script>
        function magnifier() {

            this.magnifyImg = function(ptr, magnification, magnifierSize) {
                var $pointer;
                if (typeof ptr == "string") {
                    $pointer = $(ptr);
                } else if (typeof ptr == "object") {
                    $pointer = ptr;
                }

                if (!($pointer.is('img'))) {
                    alert('Object must be image.');
                    return false;
                }

                $pointer.hover(function() {
                    $(this).css('cursor', 'none');
                    $('.magnify').show();
                    //Setting some variables for later use
                    var width = $(this).width();
                    var height = $(this).height();
                    var src = $(this).attr('src');
                    var imagePos = $(this).offset();
                    var image = $(this);

                    $('.magnify').css({
                        'background-size': width * magnification + 'px ' + height * magnification + "px",
                        'background-image': 'url("' + src + '")',
                        'width': magnifierSize,
                        'height': magnifierSize
                    });

                    //Setting a few more...
                    var magnifyOffset = +($('.magnify').width() / 2);
                    var rightSide = +(imagePos.left + $(this).width());
                    var bottomSide = +(imagePos.top + $(this).height());

                    $(document).mousemove(function(e) {
                        if (e.pageX < +(imagePos.left - magnifyOffset / 6) || e.pageX > +(rightSide + magnifyOffset / 6) || e.pageY < +(imagePos.top - magnifyOffset / 6) || e.pageY > +(bottomSide + magnifyOffset / 6)) {
                            $('.magnify').hide();
                            $(document).unbind('mousemove');
                        }
                        var backgroundPos = "" - ((e.pageX - imagePos.left) * magnification - magnifyOffset) + "px " + -((e.pageY - imagePos.top) * magnification - magnifyOffset) + "px";
                        $('.magnify').css({
                            'left': e.pageX - magnifyOffset,
                            'top': e.pageY - magnifyOffset,
                            'background-position': backgroundPos
                        });
                    });
                }, function() {

                });
            };

            this.init = function() {
                $('body').prepend('<div class="magnify"></div>');
            }

            return this.init();
        }

        var magnify = new magnifier();
        magnify.magnifyImg('#product1', 2, 200);
        $(document).ready(function() {
            $('#rating').rating({
                step: 1,
                hoverEnabled: false,
                starCaptions: {
                    1: 'Very Poor',
                    2: 'Poor',
                    3: 'Ok',
                    4: 'Good',
                    5: 'Very Good'
                },
                starCaptionClasses: {
                    1: 'caption-badge caption-secondary',
                    2: 'caption-badge caption-secondary',
                    3: 'caption-badge caption-secondary',
                    4: 'caption-badge caption-secondary',
                    5: 'caption-badge caption-secondary'
                }
            });
        });
    </script>

    <!-- ajax call to add to cart -->
    <script>
        function addCart() {
            var quantity = document.getElementById('number').value;
            var product = {
                'product_id': '<?= $currentProduct['product_id'] ?>',
                'product_name': '<?= $currentProduct['product_name'] ?>',
                'image': '<?= $currentProduct['image1'] ?>',
                'stock': '<?= $currentProduct['stock'] ?>',
                'price': '<?= round($currentProduct['price'] / 100, 2) ?>',
                'discounted_price': '<?= round($current_discounted_price, 2) ?>',
                'discount_rate': '<?= round($current_discount_rate, 2) ?>',
                'quantity': quantity,
            };
            var shop = {
                'shop_id': '<?= $currentProduct['shop_id'] ?>',
                'shop_name': '<?= $currentProduct['shop_name'] ?>',
            }
            if (quantity == 0) {
                alert("Product quantity cannot be 0");
            } else {
                $.post('cart/addItem.php', {
                        'shop': shop,
                        'product': product
                    },
                    function(data) {
                        response = JSON.parse(data);
                        if (response['status'] == 'success') {
                            cart_counter = $('#cart-count');
                            cart_counter.text(parseInt(cart_counter.text(), 10) + 1);
                            r = confirm(response['message']);
                            if (r == true) {
                                window.location.href = "/cart.php";
                            }
                        } else {
                            r = confirm(response['message']);
                            if (r == true) {
                                window.location.href = "/cart.php";
                            }
                        }
                    });
            }
        }
    </script>
</body>

</html>