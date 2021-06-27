<?php
require_once 'utils/database.php';
$product_id = $_GET['id'];
$product = fetch_row("SELECT * FROM products INNER JOIN shops ON shops.shop_id = products.shop_id WHERE product_id = '$product_id'");
$discounts = fetch_all_row("SELECT rate FROM discounts WHERE ((discount_type = 'all') OR (discount_type = 'category' AND target_id = '" . $product['category_id'] . "') OR (discount_type = 'product' AND target_id = '" . $product['product_id'] . "') AND starts_on < CURRENT_DATE AND expires_on > CURRENT_DATE)");
$discounted_price = $product['price'];
foreach ($discounts as $discount) {
    $discounted_price = $discounted_price * (100 - $discount['rate']) * 0.01;
}
$discount_rate = ($product['price'] - $discounted_price) * 100 / $product['price'];
$products = fetch_all_row("SELECT * FROM products WHERE product_id != '$product_id' ORDER BY created_at LIMIT 10");
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-free/css/all.min.css">
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
    <div class="text-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-3 col-md-5 d-flex align-items-center" style="background-color:#c4c4c4">
                    <div style="display:inline-block; text-align:start;">
                        <img src="<?= $product['image1'] ?>" class="product-preview" id="product1">
                        <br>
                        <img src="<?= $product['image1'] ?>" onclick="setPreview(this.src)" class="thumbnail">
                        <img src="<?= $product['image2'] ?>" onclick="setPreview(this.src)" class="thumbnail">
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-7 text-start  d-flex align-items-center" style="background-color:#c4c4c4">
                    <div>
                        <h1 style="font-family: Gill Sans, sans-serif;font-size: 28px;margin-top:10%"><?= $product['product_name'] ?></h1>
                        <div class="stars">
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star-half-alt"></span>
                            <span class="far fa-star"></span><br><br>
                        </div>
                        <span style="color:#F1592A; font-weight:500; font-size:20px;"> <?= $product['price'] - $discounted_price ?> </span><br>
                        <span style="text-decoration:line-through"> <?= $product['price'] ?></span> -
                        <span><?= $discount_rate ?>%</span><br><br>
                        <span>Quantity:</span>
                        <form class="quantity-form">
                            <button class="value-button" onclick="decreaseValue()" value="Decrease Value">-</button>
                            <input type="number" class="number-count" id="number" value="0" />
                            <button class="value-button" onclick="increaseValue()" value="Increase Value">+</button>
                        </form>
                        <div class="product-buttons">
                            <div style="margin-top:20px">
                                <button type="button" class="btn btn-primary">Buy Now</button>
                            </div>
                            <div style="margin-top:20px">
                                <button type="button" class="btn btn-primary">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-12 offset-lg-1 py-4" style="text-align:start;background-color:#c4c4c4">
                    <div style="color:#5B5B5B">Sold By</div>
                    <a href="shopProfile.php?id=<?= $product['shop_id'] ?>">
                        <h3 style="color:#5B5B5B"><?= $product['shop_name'] ?></h3>
                    </a>
                    <div style="color:#5B5B5B">Recent Reviews:</div>
                    <div class="reviews">
                        <?php
                        for ($i = 0; $i < 4; $i++) {
                        ?>
                            <div class="customer-review p-2">
                                <img src="assets/images/placeholder.png" class="profilepic" alt="">
                                <span class="customer-name">Customer Name</span>
                                <div class="stars d-inline-block px-3">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star-half-alt"></span>
                                    <span class="far fa-star"></span>
                                </div>
                                <span class="review">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua.</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="add-review">
                        <form>
                            <textarea name="review" class="reviewbox" placeholder="Enter your review here..." id="reviewbox" rows="4"></textarea>
                            <button class="btn btn-primary">Post</button>
                        </form>
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
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/adminlte/jquery.min.js"></script>
    <script>
        function setPreview(src) {
            preview = document.getElementById('product1');
            preview.src = src;
        }

        function increaseValue() {
            event.preventDefault();
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number').value = value;
        }

        function decreaseValue() {
            event.preventDefault();
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('number').value = value;
        }

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
        magnify.magnifyImg('#product1', 3, 400);
    </script>
</body>

</html>