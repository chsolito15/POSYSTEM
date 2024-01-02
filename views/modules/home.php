<nav class="navbar navbar-expand-lg bg-light mb-2 p-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

    <?php if ($_SESSION['profile'] == 'administrator') : ?>

        <h2>Welcome <?= $_SESSION['profile'] ?> dashboard</h2>

    <?php endif; ?>

        <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
            <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
</nav>

<section class="container">

    <div class="row">

        <?php

        if ($_SESSION["profile"] == "administrator") {

            include "home/top-boxes.php";
        }

        ?>

    </div>

    <div class="row">

        <div class="col-12 mb-2">

            <?php

            if ($_SESSION["profile"] == "administrator") {

                include "reports/sales-graph.php";
            }

            ?>

        </div>

        <div class="col-lg-6">

            <?php

            if ($_SESSION["profile"] == "administrator") {

                include "reports/bestseller-products.php";
            }

            ?>

        </div>

        <div class="col-lg-6">

            <?php

            if ($_SESSION["profile"] == "administrator") {

                include "home/recent-products.php";
            }

            ?>

        </div>

    </div>

</section>