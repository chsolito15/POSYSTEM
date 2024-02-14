<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark loader">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home">Home</a>

    <!-- Sidebar Toggle-->
    <div class="container">

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            <div class="dropdown mx-4 ">

                    <button class="btn bg-dark" data-bs-toggle="dropdown" aria-expanded="false">

                        <?php

                        $item = null;
                        $value = null;
                        $order = "id";

                        $products = ControllerProducts::ctrShowProducts($item, $value, $order);

                        $lowStock = 0;

                        for ($i = 0; $i < count($products); $i++) {

                            if ($products[$i]['stock'] <= 10 || $products[$i]['stock'] <= 15) {
                                $lowStock++;
                            }
                        }

                        echo "<a class='text-white'>
                        <i class='fa-solid fa-cart-shopping fa-1x'></i><span id='notificationCount' class='badge rounded-pill badge-notification bg-danger position-absolute'>$lowStock</span>
                    </a>";

                        ?>

                    </button>

                    <ul class="dropdown-menu">

                        <?php

                        for ($i = 0; $i < count($products); $i++) {

                            if ($products[$i]['stock'] <= 10) {

                                echo '<li class="dropdown-item ">

                                        <div class="row">

                                            <div class="list-group list-group-flush">

                                                <a class="list-group-item list-group-item-action" href="products">

                                                    <div class="col">

                                                        <img src="' . $products[$i]["image"] . '" alt="Product Image" class="" width="40px">

                                                        ' . $products[$i]["description"] . '

                                                        <span class="bg-danger text-white p-1 " style="float:right;">Stock ' . $products[$i]["stock"] . '</span>

                                                    </div>

                                                </a>

                                            </div>

                                        </div>

                                 </li>';

                            } elseif ($products[$i]["stock"] <= 15){
                                echo '<li class="dropdown-item ">

                                        <div class="row">

                                            <div class="list-group list-group-flush">

                                                <a class="list-group-item list-group-item-action" href="products">

                                                    <div class="col">

                                                        <img src="' . $products[$i]["image"] . '" alt="Product Image" class="" width="40px">

                                                        ' . $products[$i]["description"] . '

                                                        <span class="bg-warning text-white p-1 " style="float:right;">Stock ' . $products[$i]["stock"] . '</span>

                                                    </div>

                                                </a>

                                            </div>

                                        </div>

                                 </li>';
                            }
                        }

                        ?>

                    </ul>
 
            </div>

            <li class="nav-item dropdown">

                <!-- only see in web browsers app d-none d-sm-block -->

                <a class="nav-link dropdown-toggle d-none d-sm-block" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <?php

                    if ($_SESSION["photo"] != "") {
                        echo '<img src="' . $_SESSION["photo"] . '"class="user-image">';
                    } else {
                        echo '<img class="user-image" src="views/img/users/default/anonymous.png">';
                    }
                    echo ' ' . $_SESSION['name'];
                    ?>

                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="profile">Profile</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>