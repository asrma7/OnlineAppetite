<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart_style.css">

    <script src="https://kit.fontawesome.com/64a8d9c207.js" crossorigin="anonymous"></script>
    <title>Customer Care</title>
</head>

<body>
    <?php
    $page = 'customerCare';
    include 'header.php';
    ?>


    <section class="my-cart">
        <div class="cart_flex">

            <!--CART FLEX 1/2-->
            <div class="cart_flex_a">

                <!--flex cart title-->
                <div class="cart_title">
                    
                    <!--flex 1 of flex cart title for selector -->
                    <div class="cart_title_a">
                        <form>
                            <input type="checkbox" id="select_all" name="select_all" value="select_all">
                            <label for="select_all"> Select All (2 items) </label>
                        </form>
                    </div>

                    <!--flex 2 of cart title for delete -->
                    <div class="cart_title_b">
                        <form>
                            <i class="far fa-trash-alt"></i>
                            <label>Delete</label>
                        </form>
                    </div>
                </div>

                <?php
                    for($i=0; $i<4; $i++){
                ?>
                <!--Cart 1-->
                <div class="cart_product">
                    <input type="checkbox" id="seller_name" name="seller" value="seller">
                    <label for="seller_name"> Seller name</label>

                    <!--PRODUCT FLEX-->
                    <div class="product_flex">
                     
                         <!--PRODUCT FLEX 1-->
                        <div class="product_flex_a">
                            <div>
                                <input type="checkbox" id="seller_name" name="seller" value="seller">
                            </div>

                            <!--product image-->
                            <div class="product_img">
                                <img src="assets/images/placeholder.png">
                            </div>

                            <!--product description-->
                            <div class="product_description">
                                <h3> Product Name</h3>
                                <p>Stock availability </p>
                            </div>

                        </div>

                        <!--PRODUCT FLEX 2-->
                        <div class="product_flex_b">
                            <h3 style="color:#F1592A; margin:0">Price</h3>
                            <span style="text-decoration: line-through;">Discount Price</span><br>
                            <span>Discount rate%</span>
                        </div>

                        <!--PRODUCT FLEX 3-->
                        <div class="product_flex_c">
                            <form>
                                <button class="value-button" onclick="decreaseValue(<?=$i?>)" value="Decrease Value">-</button>
                                <input type="number" class="number-count" id="number-<?=$i?>" value="0" />
                                <button class="value-button" onclick="increaseValue(<?=$i?>)" value="Increase Value">+</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>




            <!--CART FLEX 2/2-->
            <div class="cart_flex_b">
                <!--flex for subtotal item and amount -->
                <div class="subtotal">

                    <!--flex for subtotal item -->
                    <div class="subtotal_items">
                        <p style="display:inline" class="subtotal">Subtotal (0 items) </p>
                    </div>

                    <!--flex for subtotal amount -->
                    <div class="subtotal_amt">
                        <p style="display:inline;" class="subtotal_amt"> Rs 0</p>
                    </div>
                </div>

                <input type="text" id="voucher" name="voucher" placeholder="Enter a voucher code">
                <input type="text" id="apply" name="voucher" placeholder="Apply" >

                <!--flex for total items and amount -->
                <div class="total">

                    <!--flex for total item -->
                    <div class="total_items">
                        <p>Total</p>
                    </div>

                    <!--flex for total amount -->
                    <div class="total_amt">
                        <p style="color:#F1592A;"> Rs 0</p>
                    </div>
                </div>

                <button class="loadmore" type="submit">Proceed to checkout</button>


            </div>


        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>


    <!--PRODUCT FLEX 3 JavaScript Portion-->
    <script>
        function increaseValue(i) {
            event.preventDefault();
            var value = parseInt(document.getElementById('number-'+i).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number-'+i).value = value;
        }

        function decreaseValue(i) {
            event.preventDefault();
            var value = parseInt(document.getElementById('number-'+i).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('number-'+i).value = value;
        }
    </script>
</body>

</html>