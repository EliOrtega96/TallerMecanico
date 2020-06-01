<?php
date_default_timezone_set('America/Mexico_City');
require_once("conexion.php");
 $query = $conn->prepare("select count(*) as total from usuario"); 
 $query->execute();
 $total;
 while($res = $query->fetch()) {$total= $res['total'];}

 //$queryProductos  = $conn->prepare("select count(DISTINCT s.nombreProducto) as productos from stock s inner join compra c on s.id_stock = c.id_stock"); 
 $queryProductos  = $conn->prepare("select sum(piezas) as productos from compra "); 
 $queryProductos->execute();
 $prodVen;
 while($pv = $queryProductos->fetch()) {$prodVen= $pv['productos'];} //total productos vendidos

 $nomProd  = $conn->prepare("select DISTINCT  s.nombreProducto from stock s inner join compra c on s.id_stock = c.id_stock"); 
 $nomProd->execute();
 $nombresProducts;
 $ventasProducts;
 while($np = $nomProd->fetch()) {$nombresProducts[]= $np['nombreProducto']; ////nombre de los productos vendidos
 $n = $np['nombreProducto'];
  //$vetasProd  = $conn->prepare("select count(s.nombreProducto)as total, s.nombreProducto from stock s inner join compra c on s.id_stock = c.id_stock where s.nombreProducto = '$n'"); 
  $vetasProd  = $conn->prepare("select sum(piezas) as total from compra c inner join stock s on c.id_stock = s.id_stock where s.nombreProducto = '$n' "); 
  $vetasProd->execute();
 while($vp = $vetasProd->fetch()) {$ventasProducts[]= $vp['total'];} //cantidad de ventas de cada producto
} 

 
$agenda  = $conn->prepare("select * from agenda"); 
$agenda->execute();
$fechas;
$calendario=[];

while($ag = $agenda->fetch()) {$fechas= $ag['fecha'];
  $search  = array('-');
  $replace = array(', ');
  $subject = $fechas;
 $calendario[] = str_replace($search, $replace, $subject);
  }
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

<script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php for($i=0; $i< sizeof($nombresProducts); $i++ ){  echo " [' ". $nombresProducts[$i] . "'," .$ventasProducts[$i]." ], "; } ?>
 
          ]);
          var options = {
            title: 'Productos vendidos <?php echo $prodVen ?>',
            is3D: true,
            noDataPattern: {
           backgroundColor: '#76a7fa',
           color: '#a0c3ff'
         }
          };
          var chart = new google.visualization.PieChart(document.getElementById('productos'));
          chart.draw(data, options);
        }
      </script>
</head>
<body>
        <div id="total"></div>
        <div id="productos"></div>     
</body>
</html>