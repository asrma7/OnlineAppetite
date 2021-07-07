<?php
require_once 'utils/sessionManager.php';
require_once 'utils/database.php';
$categories = fetch_all_row("SELECT * FROM categories");
$page = $page ?? '';
$userCart = $_SESSION['user']['cart'] ?? [];
$cartSize = 0;
foreach ($userCart as $cartShop) {
    $cartSize += count($cartShop['products']);
}

?>
<header>
    <div class="top-row d-none d-lg-flex">
        <div class="header-logo d-none d-lg-block">
            <a href="/"><img src="assets/images/logo.png" alt="logo"></a>
        </div>
        <div class="header-logo d-block d-lg-none">
            <a href="/"><img src="assets/images/logosmall.png" alt="logo"></a>
        </div>
        <div class="header-address d-none d-lg-flex">
            <img src="assets/images/mappin.png" alt="mappin">
            <div>
                <span id='address'>Kathmandu, Nepal</span><br>
                <span id='date'></span>
            </div>
        </div>
        <form action="search.php" class="search">
            <input type="text" name="q" placeholder="Search in OnlineAppetite" value="<?= $searchbar ?? '' ?>" class="searchbar">
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
    <nav id="navbar">
        <div class="d-none d-md-flex nav">
            <ul class="nav-left">
                <li class="my-nav-link small-logo d-inline-block d-lg-none">
                    <a href="/"><img src="assets/images/logosmall.png" alt="logo"></a>
                </li>
                <li class="my-nav-link <?php echo $page == 'home' ? 'active' : ''; ?>">
                    <a href="/">Home</a>
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
            </ul>
            <ul class="nav-right d-lg-none">
                <li>
                    <div class="collapsible-search">
                        <div class="search-btn" onclick="showSearch()">
                            <img src="assets/images/search.png" id="search-btn" alt="">
                        </div>
                        <div class="collapsible-section" id="collapsible-search">
                            <input type="text" name="search" autocomplete="off" />
                            <button class="btn-search">Search</button>
                        </div>
                    </div>
                </li>
                <?php if (!isset($_SESSION['user'])) { ?>

                    <li>
                        <button onclick="location.href='signin.php'" class="signin">Sign in</button>
                    </li>
                    <li>
                        <button onclick="location.href='signup.php'" class="signin">Sign up</button>
                    </li>
                <?php
                } else {
                ?>
                    <li>
                        <a href="/profile.php" class="greetings">Hi <?= explode(' ', $_SESSION['user']['FULL_NAME'])[0] ?></a>
                    </li>
                    <li>
                        <button onclick="location.href='logout.php'" class="signup">Sign Out</button>
                    </li>
                    <li>
                        <div class="cart" onclick="window.location.href='/cart.php'">
                            <img src="assets/images/cart.png" alt="cart">
                            <span id="cart-count"><?= $cartSize ?></span>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="d-block d-md-none small-nav">
            <div class="hamburger">
                <div class="fa fa-bars"></div>
            </div>
            <img src="assets/images/smalllogo.png" onclick="window.location.href='/'" alt="">
        </div>
    </nav>
    <div id="navspacer"></div>
</header>