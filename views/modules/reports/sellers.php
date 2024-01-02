<?php
error_reporting(0);
$item = null;
$value = null;

$sales = ControllerSales::ctrShowSales($item, $value);
$users = ControllerUsers::ctrShowUsers($item, $value);

$arraySellers = array();
$arraySellersList = array();
$addingTotalSales = array();

foreach ($sales as $key => $valueSales) {

  foreach ($users as $key => $valueUsers) {

    if($valueUsers["id"] == $valueSales["idSeller"]){

        #We capture sellers in an array
        array_push($arraySellers, $valueUsers["name"]);

        #We capture the names and net values in the same array
        $arraySellersList = array($valueUsers["name"] => $valueSales["netPrice"]);

        #We add the netprice of each seller

        foreach ($arraySellersList as $key => $value) {

           $addingTotalSales[$key] += $value;
        

         }

    }
  
  }

}

#Avoiding repeated names
$dontrepeatnames = array_unique($arraySellers);

?>

<!--=====================================
                Sellers
======================================-->

<div class="card">
	
  	<div class="card-body">
  				
			<canvas id="barChartSellers"></canvas>

  	</div>

</div>

<script>

  (async function() {

    <?php

    echo "var data = [";

    foreach ($dontrepeatnames as $value) {

      echo "{s: '" . $value . "', v: '" . $addingTotalSales[$value] . "'},";

    }

    echo "];";

    ?>

    new Chart(document.getElementById('barChartSellers'), {

      type: 'bar',
      data: {
        labels: data.map(row => row.s),
        datasets: [{
          label: 'Sell',
          data: data.map(row => row.v),
          backgroundColor: ["#36a2eb", "#ff6384", "#4bc0c0", "#ff9f40", "#9966ff", "#ffcd56", "#c9cbcf"]
        }]
      }

    })
  })();
</script>