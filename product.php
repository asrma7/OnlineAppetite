<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
</head>

<body>
    <?php
        $page = 'customerCare';
        include 'header.php';
    ?>
    <!-- Product Names -->
    <div class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 pb-lg-4 md-4mb-4" style="padding-left:2;background-color:#c4c4c4">
                    <a href="#"> <img src="assets/images/placeholder.png" class="pt-5 " id="product1"></a>
                    <img src="assets/images/placeholder.png" style="width:40%" class="pt-5" id="product2">
                    <img src="assets/images/placeholder.png" style="width:40%" class="pt-5" id="product2">

                </div>
                <div class="col-sm-4 pb-lg-4 md-4mb-4" style="background-color:#c4c4c4" class="pe-2" id="product2">
                    <h1 class="pt-5" style="font-family: Gill Sans, sans-serif;font-size: 28px;margin-top:10%">Product Name</h1>
                    <span class="fa fa-star checked" style="color: orange;"></span>
                    <span class="fa fa-star checked" style="color: orange;"></span>
                    <span class="fa fa-star checked" style="color: orange;"></span>
                    <span class="fa fa-star checked" style="color: orange;"></span>
                    <span class="fa fa-star"></span>
                    <p style="color:red"> Price </p>
                    <span style="text-decoration:line-through"> Original Price</span> -
                    <span>Discount%</span>
                    <div class="row">
                        <div class="col-sm-4 pb-lg-4 md-4mb-4">
                            <button type="button" class="btn btn-primary">Buy Now</button>
                        </div>
                        <div class="col-sm-4 pb-lg-4 md-4mb-4">
                            <span><button type="button" class="btn btn-primary">Add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 pb-lg-4 md-4mb-4"></div>
                <!-- Customer FeedBack -->
                <div class="col-sm-3 pb-lg-4 md-4mb-4" style="background-color:#c4c4c4">
                    <p style="font-family: Gill Sans, sans-serif;color:#5B5B5B" class="pt-5">Sold By</p>
                    <h1 style="font-family: Gill Sans, sans-serif;color:#5B5B5B"> Seller Name and Company</h1>
                    <p style="font-family: Gill Sans, sans-serif;color:#5B5B5B">Recent Reviews</p>
                    <?php
                            for($i=0; $i<4; $i++){
                            ?>
                    <div class="customer">
                        <img src="assets/images/placeholder.png" style="width:20%;border-radius:50%;" alt="">
                        <strong class="customer-name">Customer Name</strong>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</P>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Similar Products -->
    <h1 style="font-family: Gill Sans, sans-serif;font-size: 28px;" class="text-center">Related Products</h1>
    <div class="container">
        <div class="products">
            <?php
            for($i=0; $i<12; $i++){
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
    </div>
        <?php include 'footer.php';?>
        <script src="js/script.js"></script> 
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/index.js"></script>
</body>

</html>