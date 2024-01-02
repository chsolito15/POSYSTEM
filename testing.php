<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart Sample</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="views/bower_components/chart.js/Chart.js"></script>
    <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
    <div style="width: 90%;">
    
    <canvas id="acquisitions"></canvas>


  </div>

    <!-- <script type="module" src="dimensions.js"></script> -->

    
    <script>

(async function() {

  const data = [

    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 20 },
    { year: 2014, count: 22 },
    { year: 2015, count: 21 },
    { year: 2016, count: 15 }

  ];

  new Chart(
    document.getElementById('acquisitions'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count),
            fill: false
           
          }
        ]
      }
    }
  );
})();

    </script>


</body>
</html>