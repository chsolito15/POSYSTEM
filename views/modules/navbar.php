<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark ">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home">Home</a>

    <!-- Sidebar Toggle-->
    <div class="container">

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            <li class="nav-item dropdown">

                <!-- only see in web browsers app d-none d-sm-block -->

                <a class="nav-link dropdown-toggle d-none d-sm-block" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <?php

                    $item = null;
                    $value = null;

                    $users = ControllerUsers::ctrShowUsers($item, $value);

                    foreach ($users as $value) {

                        if ($value["photo"] != "") {
                            echo '<img src="' . $value["photo"] . '"class="user-image">';
                        } else {
                            echo '<img class="user-image" src="views/img/users/default/anonymous.png">';
                        }
                        echo ' ' . $value['name'];

                        break;
                    }
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