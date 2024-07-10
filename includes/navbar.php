<nav class="navbar navbar-expand-lg nav-underline">
    <div class="container d-flex">
        <a href="index.php" class="navbar-brand">
            <img src="./assets/images/GadgetKu.png" alt="GadgetKu Logo" width="145">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link fs-5 fw-medium <?php echo $currentPage == 'home' ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 fw-medium <?php echo $currentPage == 'categories' ? 'active' : ''; ?>" href="categories.php">Collections</a>
                </li>

                <?php if (isset($_SESSION['auth'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-medium <?php echo $currentPage == 'cart' ? 'active' : ''; ?>" href="cart.php"><i class="fa fa-shopping-cart me-2"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fs-5 fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['auth_user']['name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="myOrders.php">My Orders</a></li>
                            <?php
                            if ($_SESSION['role_as'] == 1) {
                            ?>
                                <li><a class="dropdown-item" href="./admin/index.php">Admin Dashboard</a></li>
                            <?php
                            }
                            ?>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-medium <?php echo $currentPage == 'register' ? 'active' : ''; ?>" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-medium <?php echo $currentPage == 'login' ? 'active' : ''; ?>" href="login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>