<?php
error_reporting(E_ALL);

$item = null;
$value = null;
$order = "sales";

$products = ControllerProducts::ctrShowProducts($item, $value, $order);

$colours = array("#36a2eb", "#ff6384", "#4bc0c0", "#ff9f40", "#9966ff", "#ffcd56", "#c9cbcf");

$salesTotal = ControllerProducts::ctrShowAddingOfTheSales();

?>

<!--=====================================
  BEST SELLING PRODUCTS
======================================-->

<div class="card">

  <div class="card-body">

    <canvas id="pieChart"></canvas>

    <ul class="list-unstyled">

      <?php

      for ($i = 0; $i < count($products); $i++) {

        echo '<li>
          <div class="row">
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action">
                  <div class="col">

                    <img src="' . $products[$i]["image"] . '" class="img-thumbnail" width="40px"> 
                    ' . $products[$i]["description"] . '
              
                    <span class="text-white p-1" style="background-color:' . $colours[$i] . '; float: right;">   
                    ' . ceil($products[$i]["sales"] * 100 / $salesTotal["total"]) . '%
                    </span>

                   </div>
                </a> 
            </div>
          </div>
        </li>';
      }

      ?>

    </ul>

  </div>

</div>

<script>
  (async function() {

    <?php

    echo "const data = [";

    for ($i = 0; $i < count($products); $i++) {
      echo "{
        value    : " . $products[$i]["sales"] . ",
        label    : '" . $products[$i]["description"] . "'
        },";
    }

    echo "];";

    ?>

    new Chart(document.getElementById('pieChart'), {

      type: 'pie',
      data: {
        labels: data.map(row => row.label),
        datasets: [{
          label: '',
          data: data.map(row => row.value),
          backgroundColor: ["#36a2eb", "#ff6384", "#4bc0c0", "#ff9f40", "#9966ff", "#ffcd56", "#c9cbcf"]
        }]
      },
      options: {
        legend: {
          display: true,
          position: 'right',

        },
        title: {
          display: true,
          text: 'Bestseller Products'
        }
      }

    })
  })();
</script>