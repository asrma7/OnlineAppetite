<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/trader_register_style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Customer Care</title>
</head>

<body>
    <?php
    $page = 'customerCare';
    include 'header.php';
    ?>
    <form class="trader-form my-3">
        <h2 class="text-center">Trader Registeration Form</h2>
        <br>
        <div class="row mb-3">
            <label for="businessName" class="col-sm-3 col-form-label" required>Business Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="businessName" id="businessName">
            </div>
        </div>
        <div class="row mb-3">
            <label for="areaCode" class="col-sm-3 col-form-label">Contact number</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="areaCode" id="areaCode" aria-label="State">
                <label for="areaCode" class="label d-flex justify-content-center">Area Code</label>

            </div>
            <div class="col-sm-1">
                <span class="label_dash d-flex justify-content-center"> - </span>

            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="number" name="number" aria-label="Zip">
                <label for="number" class="label mr-2 d-flex justify-content-center">Phone number</label>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label" required>Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>

        <div class="row mb-1">
            <label for="street1" class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="street1" name="street1">
                <label for="street1" class="form-label d-flex justify-content-center">Street Address 1</label>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-sm-9 offset-sm-3">
                <input type="text" class="form-control" id="street2" name="street2">
                <label for="street2" class="form-label d-flex justify-content-center">Street Address 2</label>
            </div>
        </div>
        <div class="mb-1 row">
            <div class="col-sm-5 offset-sm-3 justify-content-end">
                <input type="text" class="form-control col-4" id="city" name="city" aria-describedby="emailHelp">
                <label for="city" class="label mr-2 d-flex justify-content-center">City</label>
            </div>

            <div class="col-sm-4">
                <input type="text" class="form-control col-4" id="state" name="state" aria-describedby="emailHelp">
                <label for="state" class="label mr-2 d-flex justify-content-center">State</label>
            </div>

        </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-5 offset-sm-3 justify-content-end">
                <input type="text" class="form-control col-4" id="postal" name="postal" aria-describedby="emailHelp">
                <label for="postal" class="label mr-2 d-flex justify-content-center">Postal Code/Zip Code</label>
            </div>

            <div class="col-sm-4">
                <select id="country" name="country" class="form-select" aria-label="Default select example">
                    <option selected disabled>Choose one</option>
                    <option value="nepal">Nepal</option>
                    <option value="india">India</option>
                    <option value="bhutan">Bhutan</option>
                </select>
                <label for="country" class="label mr-2 d-flex justify-content-center">Country</label>
            </div>

        </div>

        <!--Trading since-->

        <div class=" row">
            <div class="col-sm-3">
                Trading Since
            </div>


            <div class="col-sm-3 mb-3 justify-content-end">
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label class="label mr-2 d-flex justify-content-center">Month</label>
            </div>
            <div class="col-sm-3 mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>1</option>
                    <?php for ($i = 2; $i <= 31; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <label class="label mr-2 d-flex justify-content-center">Day</label>
            </div>
            <div class="col-sm-3 mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option value="1999" selected>1999</option>
                    <?php for ($i = 1999; $i <= 2021; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <label class="label mr-2 d-flex justify-content-center">Year</label>
            </div>
        </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-5 offset-sm-3 check">
                <label class="label mr-2 d-flex justify-content-start">Type of Bussiness</label>
                <div class="form-check">
                    <input class="form-check-input" name="type" type="radio" value="small" id="small">
                    <label class="form-check-label" for="small">
                        Small
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="type" type="radio" value="medium" id="medium">
                    <label class="form-check-label" for="medium">
                        Medium
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="type" type="radio" value="large" id="large">
                    <label class="form-check-label" for="large">
                        Large
                    </label>
                </div>
            </div>
            <div class="col-sm-4 check">
                <label class="label mr-2 d-flex justify-content-start">Preferred Payment</label>
                <div class="form-check">
                    <input class="form-check-input" name="payments[]" type="checkbox" value="card" id="card">
                    <label class="form-check-label" for="card">
                        Card
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="payments[]" type="checkbox" value="cash" id="cash">
                    <label class="form-check-label" for="cash">
                        Cash
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="payments[]" type="checkbox" value="paypal" id="paypal">
                    <label class="form-check-label" for="paypal">
                        Paypal
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="message" class="col-sm-3 col-form-label">Message</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="message" rows="6"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="toc">
                    <label class="form-check-label" for="toc">
                        I agree the <a class="toc" href="toc.php">Terms and condition</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="w-100 traderbtn">Register</button>
            </div>
        </div>
        </div>
    </form>

    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    </script>
</body>

</html>