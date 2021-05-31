<header>
    <div class="top-row">
        <div class="header-logo">
            <a href="/"><img src="assets/images/logo.png" alt="logo"></a>
        </div>
        <div class="header-address">
            <img src="assets/images/mappin.png" alt="mappin">
            <div>
                <span>Kathmandu, Nepal</span><br>
                <span>21st Jan, 2021</span>
            </div>
        </div>
        <form class="search">
            <input type="text" name="search" class="searchbar">
            <button type="submit"><img src="assets/images/search.png" alt="search"></button>
        </form>
        <div class="buttons">
            <button onclick="location.href='signin.php'"class="signin">Sign in</button>
            <button onclick="location.href='signup.php'" class="signup">Sign up</button>
        </div>
        <div class="cart">
            <img src="assets/images/cart.png" alt="cart">
            <span id="cart-count">5</span>
        </div>
    </div>
    <nav>
            <div id="navspacer"></div>
            <div class="hamburger" onclick="openNav()"></div>
            <ul class="nav small-nav" id="navbar">
                <li class="nav-link small-logo nav-small">
                    <a href="/"><img src="assets/images/smalllogo.png" alt="logo"></a>
                </li>
                <li class="nav-link <?php echo $page=='home'?'active':'';?>">
                    <a href="/">Home</a>
                </li>
                <li class="nav-link <?php echo $page=='deal'?'active':'';?>">
                    <a href="index.php">Today's Deal</a>
                </li>
                <li class="nav-link <?php echo $page=='caregories'?'active':'';?>">
                    <a href="index.php">Categories</a>
                </li>
                <li class="nav-link <?php echo $page=='customerCare'?'active':'';?>">
                    <a href="customerCare.php">Customer Care</a>
                </li>
                <li class="nav-link <?php echo $page=='seller'?'active':'';?>">
                    <a href="index.php">Become a seller</a>
                </li>
                <!-- <li class="nav-link nav-small">
                    <a href="signin.php">Sign in</a>
                </li>
                <li class="nav-link nav-small">
                    <a href="signup.php">Sign up</a>
                </li> -->
                <li class="nav-link nav-small">
                    <form class="search">
                        <input type="text" name="search" class="searchbar">
                        <button type="submit"><img src="assets/images/search.png" alt="search"></button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>