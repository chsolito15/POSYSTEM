<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

        <div class="sb-sidenav-menu">

            <div class="nav">

             <!-- only see in web responsive app d-block d-sm-none -->

                <div class="sb-sidenav-menu-heading d-block d-sm-none">

                    <?php

                    if ($_SESSION["photo"] != "") {
                        echo '<img src="' . $_SESSION["photo"] . '"class="user-image">';
                    } else {
                        echo '<img class="user-image" src="views/img/users/default/anonymous.png">';
                    }
                        echo ' '. $_SESSION['name'];
                    ?>

                </div>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <ul class="sidebar-menu">

                    <!--=====================================
                              Administrator Account
                    ======================================-->

                    <?php if ($_SESSION['profile'] == "administrator") : ?>

                        <a class="nav-link" href="home">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-home"></i></div>
                            Home
                        </a>

                        <a class="nav-link" href="categories">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
                            Categories
                        </a>

                        <a class="nav-link" href="products">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                            Products
                        </a>

                        <a class="nav-link" href="suppliers">
                            <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                            Supplier
                        </a>

                        <a class="nav-link" href="customers">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Customers
                        </a>

                        <a class="nav-link" href="reports">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                            Sales report
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                            Sales
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="sales">Manage Sales</a>
                                <a class="nav-link" href="create-sale">Create Sale</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="users">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            User Management
                        </a>

                        <!--=====================================
                                        Special Account
                            ======================================-->

                    <?php elseif ($_SESSION['profile'] == "special") : ?>

                        <a class="nav-link" href="categories">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
                            Categories
                        </a>

                        <a class="nav-link" href="products">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                            Products
                        </a>

                        <!--=====================================
                                        Seller Account
                        ======================================-->

                    <?php elseif ($_SESSION['profile'] == "seller") : ?>


                        <a class="nav-link" href="customers">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Customers
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                            Sales
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="sales">Manage Sales</a>
                                <a class="nav-link" href="create-sale">Create Sale</a>
                            </nav>
                        </div>

                    <?php endif; ?>

                </ul>

                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Login</a>
                                <a class="nav-link" href="">Register</a>
                                <a class="nav-link" href="">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">401 Page</a>
                                <a class="nav-link" href="">404 Page</a>
                                <a class="nav-link" href="">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> -->

                <div class="sb-sidenav-menu-heading">Addons</div>

                <a class="nav-link" href="charts.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>

                <!-- only see in web responsive app d-block d-sm-none -->

                <a class="nav-link d-block d-sm-none" href="logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    Logout
                </a>
            </div>
        </div>

      <!--   <div class="sb-sidenav-footer">
            <div class="small"></div>
            Start Bootstrap
        </div> -->
    </nav>
</div>