</head>

<body>

    <header class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <script src="navigation.js" async></script>
        <ul class="navbar-nav me-sm-5">
            <li class="nav-item">
                <a class="ms-sm-2 ms-md-4 nav-link" href="index.php">
                    <img src="src/index/logo.png" width="100" height="31" alt="Melbourne Hotel">
                </a>
            </li>
            <li class="nav-link mt-1">
                <select id="menuSelect" name="menuSelect" onchange="navigate()">
                    <option value="" disabled selected>Select Option</option>
                    <option value="index.php">Home</option>
                    <option value="facilities.php">Facilities</option>
                    <?php if (isset($_SESSION['username']) && isset($_COOKIE['access_token']) && $_SESSION['access_token'] === $_COOKIE['access_token']) { ?>
                        <option value="add.php">Add more</option>
                    <?php } ?>
                    <option value="gallery.php">Gallery</option>
                </select>
            </li>
            <?php if (isset($_SESSION['username']) && isset($_COOKIE['access_token']) && $_SESSION['access_token'] === $_COOKIE['access_token']) { ?>
                <li class="nav-item mt-1">
                    <a class="nav-link <?php if ($pageName == "logout.php") echo "active"; ?>" href="logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item mt-1">
                    <a class="nav-link  <?php if ($pageName == "login.php") {
                                            echo "active";
                                        } ?>" href="login.php">Login</a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link  <?php if ($pageName == "register.php") {
                                            echo "active";
                                        } ?>" href="register.php">Register</a>
                </li>

            <?php } ?>
        </ul>

        <!-- <div class="ms-auto me-5 ">
            <form class="header_search">
                <input type="text" id="search_box" placeholder="Enter search value">
                <button type="submit" class="search_button">
                    <span class="material_symbols_outlined">search</span>
                </button>
            </form>
        </div> -->




    </header>