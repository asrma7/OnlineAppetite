<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
$categories = fetch_all_row("SELECT * FROM categories");
$page = $page??'';
$userCart = $_SESSION['user']['cart']??[];
$cartSize = 0;
foreach($userCart as $cartShop)
{
    $cartSize += count($cartShop['products']);
}

?>
<header>
    <div class="top-row">
        <div class="header-logo">
            <a href="/"><img src="assets/images/logo.png" alt="logo"></a>
        </div>
        <div class="header-address">
            <img src="assets/images/mappin.png" alt="mappin">
            <div>
                <span id='address'>Kathmandu, Nepal</span><br>
                <span id='date'></span>
            </div>
        </div>
        <form class="search">
            <input type="text" name="search" class="searchbar">
            <button type="submit"><img src="assets/images/search.png" alt="search"></button>
        </form>
        <div class="top-buttons">
            <?php
            if (!isset($_SESSION['user'])) {
            ?>
                <div class="buttons">
                    <button onclick="location.href='signin.php'" class="signin">Sign in</button>
                    <button onclick="location.href='signup.php'" class="signup">Sign up</button>
                </div>
            <?php
            } else {
            ?>
                <div class="buttons">
                    <a href="/profile.php" class="greetings">Hi <?= explode(' ', $_SESSION['user']['FULL_NAME'])[0] ?></a>
                    <button onclick="location.href='logout.php'" class="signup">Sign Out</button>
                </div>
            <?php
            }
            ?>
            <div class="cart" onclick="window.location.href='/cart.php'">
                <img src="assets/images/cart.png" alt="cart">
                <span id="cart-count"><?= $cartSize ?></span>
            </div>
        </div>
    </div>
    <nav>
        <div id="navspacer"></div>
        <div class="hamburger" onclick="openNav()"></div>
        <ul class="my-nav small-nav" id="navbar">
            <li class="my-nav-link small-logo nav-small">
                <a href="/"><img src="assets/images/smalllogo.png" alt="logo"></a>
            </li>
            <li class="my-nav-link <?php echo $page == 'home' ? 'active' : ''; ?>">
                <a href="/">Home</a>
            </li>
            <li class="my-nav-link <?php echo $page == 'deal' ? 'active' : ''; ?>">
                <a href="todaydeal.php">Today's Deal</a>
            </li>
            <li class="my-nav-dropdown <?php echo $page == 'category' ? 'active' : ''; ?>">
                <span class="my-dropdown-btn">Categories</span>
                <div class="my-dropdown-content">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <a href="/category.php?id=<?= $category['CATEGORY_ID'] ?>"><?= $category['CATEGORY_NAME'] ?></a>
                    <?php
                    }
                    ?>
                </div>
            </li>
            <li class="my-nav-link <?php echo $page == 'customerCare' ? 'active' : ''; ?>">
                <a href="customerCare.php">Customer Care</a>
            </li>
            <li class="my-nav-link <?php echo $page == 'seller' ? 'active' : ''; ?>">
                <a href="traderregister.php">Become a seller</a>
            </li>
            <li class="my-nav-link">
                <a href="/trader">Trader Login</a>
            </li>
            <li class="my-nav-link nav-small">
                <a href="signin.php">Sign in</a>
            </li>
            <li class="my-nav-link nav-small">
                <a href="signup.php">Sign up</a>
            </li>
            <li class="my-nav-link nav-small">
                <form class="search">
                    <input type="text" name="search" class="searchbar">
                    <button type="submit"><img src="assets/images/search.png" alt="search"></button>
                </form>
            </li>
        </ul>
    </nav>
</header>