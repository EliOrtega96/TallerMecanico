<?php
    session_start();
    require_once('conexion.php'); //incluye en archivo conexion DB

    $query = $conn->prepare("SELECT * FROM stock");   //lee todos los usuarios de la tabla usuarios
    $query->execute(); //ejecuta el query

    $query2 = $conn->prepare("SELECT * FROM contenido");   //lee todos los usuarios de la tabla usuarios
    $query2->execute(); //ejecuta el query
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <title>Index</title>
    <style>
        img
        {
         width: 200px;
         height: 150px;
        }
        #menu{
            background-color:#000;
        }
        #menu ul{
            list-style: none;
            margin:0;
            padding:0;
        }
        #menu ul li{
            display:inline-block;
        }
        #menu ul li a{
            color:white;
            display:block;
            padding:20px 40px;
            text-decoration :none;
        }
        #menu ul li a:hover{
            background-color:#42B881;
        }
        .item-r{
            float:right;
        }
    </style>
</head>
<body>
    <div id="menu">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li class="item-r"><a href="cerrarsesion.php">Cerrar Sesion</a></li>
            <li class="item-r"><a href="#"><?php echo $_SESSION['nombre'];?></a></li>
            


        </ul>
    </div>

    <div class="row">
    <?php
    while($inf =$query2->fetch()){
   echo "<div class='col-md-4'>";
   echo "<div class='thumbnail'>" ;
   $img = $inf['foto'];
   echo "<div>"."<img src='images/$img' >"."</div>";
   echo "<div class='caption'>";
   echo "<div>".$inf['descripcion']."</div>";
   echo "</div>" ;
   echo "</div>" ;
   echo "</div>" ;
    }
      ?>
    </div>
  

<header>
    <div class="container">
        <div class="row">
           
            <?php 
                while($res = $query->fetch()) { 
                  echo "<div class='col-md-3'>" ;	
                   
                    $img = $res['foto'];
                    echo "<div>"."<img src='images/$img' >"."</div>"; 
                    echo "<div>".$res['nombreProducto']."</div>";
                    echo "<div>".$res['descripcion']."</div>";
                    echo "<div>"."$".$res['costo'].".00"."</div>";
                 
                    echo "<div> <a href='compra.php?id=$res[id_stock]'><button type='button' class='btn btn-danger'>Comprar</button></a></div>"; 
                   
                    echo  "</div>" ;
                  
                  
                }
            ?>
                  

           
           
        </div>
    </div>
</header> 

    
</body>
</html>