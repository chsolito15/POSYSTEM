<?php

error_reporting(0);

if (isset($_GET["initialDate"])) {

    $initialDate = $_GET["initialDate"];
    $finalDate = $_GET["finalDate"];
} else {

    $initialDate = null;
    $finalDate = null;
}

$answer = ControllerSales::ctrSalesDatesRange($initialDate, $finalDate);

$arrayDates = array();
$arraySales = array();
$addingMonthPayments = array();

foreach ($answer as $key => $value) {

    #We capture only year and month
    $singleDate = substr($value["saledate"], 0, 7);

    #Introduce dates in arrayDates
    array_push($arrayDates, $singleDate);

    #We capture the sales
    $arraySales = array($singleDate => $value["totalPrice"]);

    #we add payments made in the same month
    foreach ($arraySales as $key => $value) {

        $addingMonthPayments[$key] += $value;
    }
}

$noRepeatDates = array_unique($arrayDates);

?>

<!--=====================================
SALES GRAPH
======================================-->

<div class="card">

    <div class="card-body">

        <div class="container">

            <canvas id="line-chart-Sales"></canvas>

        </div>

    </div>

</div>

<script>

    (async function() {

        <?php

        if ($noRepeatDates != null) {

            echo "const data = [";

            foreach ($noRepeatDates as $key => $date) {
                echo "{ year: '" . $date . "', 
                        Sales: " . $addingMonthPayments[$date] . " },";
            }

            echo "];";
        } else {

            echo "const data = [{ year: '0', Sales: '0' }];";
        }

        ?>
     
        var ctx = document.getElementById('line-chart-Sales');
       
        ctx.height = 300;
        ctx.width = 350;
    
        new Chart(ctx, {

            type: 'line',
           
            data: {
                labels: data.map(row => row.year),

                datasets: [{
                    label: 'Total of Sales',
                    data: data.map(row => row.Sales),
                    fill: true,
                    borderColor: '#36A2EB',
                    backgroundColor: '#9BD0F57A'
                }]
            },
            options:{
                responsive: true,
                maintainAspectRatio: false
            }
        })
    })();
</script>