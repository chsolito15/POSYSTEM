<?php

if ($_SESSION["profile"] == "special" || $_SESSION["profile"] == "seller") {

  echo '<script>

    window.location = "home";

  </script>';

  return;
}

?>

<nav class="navbar navbar-expand-lg bg-light mb-3 p-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

  <?php if ($_SESSION['profile'] == 'administrator') : ?>

    <h3>Welcome <?= $_SESSION['profile'] ?> dashboard</h3>

  <?php endif; ?>

  <ol class="breadcrumb navbar ms-auto mb-2 mb-lg-0 list-unstyled ">
    <li class="breadcrumb-item"><a href="home" class="text-dark text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Reports</li>
  </ol>
</nav>


<div class="container">

  <div class="d-flex justify-content-between mb-2">

    <div class="d-flex justify-content-between">

      <button type="button" class="btn btn-primary btn-default" id="daterange-btn2">

        <span><i class="fa fa-calendar"></i> Date range</span>

        <i class="fa fa-caret-down"></i>

      </button>

    </div>

    <div class="d-flex justify-content-between">

      <?php

      if (isset($_GET["inicialDate"])) {

        echo '<a href="views/modules/download-report.php?report=report&inicialDate=' . $_GET["inicialDate"] . '&finalDate=' . $_GET["finalDate"] . '">';
      } else {

        echo '<a href="views/modules/download-report.php?report=report">';
      }

      ?>

      <button class="btn btn-success" style="margin-top:5px">Export to Excel</button>

      </a>

    </div>

  </div>




  <div class="cotainer">

    <div class="row">

      <div class="col-xs-12 mb-3">

        <?php

        include "reports/sales-graph.php";

        ?>

      </div>

      <div class="col-md-6 col-xs-12">

        <?php

        include "reports/bestseller-products.php";

        ?>

      </div>

      <div class="col-md-6 col-xs-12">

        <?php

        include "reports/sellers.php";

        ?>

        <?php

        include "reports/buyers.php";

        ?>

      </div>

    </div>

  </div>

</div>