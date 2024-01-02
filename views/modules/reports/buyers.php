<?php
error_reporting(0);
$item = null;
$value = null;

$sales = ControllerSales::ctrShowSales($item, $value);
$Customers = ControllerCustomers::ctrShowCustomers($item, $value);

$arrayCustomers = array();
$arrayCustomersList = array();
$addingTotalSales = array();

foreach ($sales as $key => $valueSales) {

  foreach ($Customers as $key => $valueCustomers) {

    if ($valueCustomers["id"] == $valueSales["idCustomer"]) {

      #We capture Customers in an array
      array_push($arrayCustomers, $valueCustomers["name"]);

      #We capture the names and net values in the same array
      $arrayCustomersList = array($valueCustomers["name"] => $valueSales["netPrice"]);

      #We add the netprice of each Customer

      foreach ($arrayCustomersList as $key => $value) {

            $addingTotalSales[$key] += $value;   
      }
    }
  }
}

#Avoiding repeated names
$dontrepeatnames = array_unique($arrayCustomers);

?>

<!--=====================================
                 Customers
======================================-->

<div class="card mt-4">

  <div class="card-body">

      <canvas id="barChartCustomers"></canvas>

  </div>

</div>

<script>

  (async function() {

    <?php

    echo "var data = [";

    foreach ($dontrepeatnames as $value) {

      echo "{value: '" . $value . "', a: '" . $addingTotalSales[$value] . "'},";

    }

    echo "];";

    ?>

    new Chart(document.getElementById('barChartCustomers'), {

      type: 'bar',
      data: {
        labels: data.map(row => row.value),
        datasets: [{
          label: 'Buy',
          data: data.map(row => row.a),
          backgroundColor: ["#36a2eb", "#ff6384", "#4bc0c0", "#ff9f40", "#9966ff", "#ffcd56", "#c9cbcf"]
        }]
      }

    })
  })();
</script>