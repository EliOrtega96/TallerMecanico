<?php
require_once("conexion.php");
 $query = $conn->prepare("select count(*) as total from usuario");
 $query->execute();
 $total;
 while($res = $query->fetch()) {$total= $res['total'];}

 
 
 //echo " [' ". $categorias[0] . "'," .$num[0]." ], "
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Total',    <?php echo $total ?> ],
            
          ]);

          var options = {
            title: 'Total de usuarios <?php echo $total ?>',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('total'));
          chart.draw(data, options);
        }

      </script>
</head>
<body>
        <div id="total"></div>
</body>
</html>