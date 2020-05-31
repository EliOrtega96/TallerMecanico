<?php
 require_once('conexion.php');
 $id = $_GET['id']; //obtiene el id del registro que se va comprar
 $query = $conn->prepare("SELECT * FROM stock WHERE id_stock ='$id' "); //query para obtener los datos del registro a editar
            $query->execute(); //ejecuta query
            while($res = $query->fetch()) {
               	
                $id = $res['id_stock']; //datos de la base de datos
                $img = $res['foto']; 
                $producto=$res['nombreProducto'];
                $desc=$res['descripcion'];
                $costo="$".$res['costo'].".00";
               

            }
 



           
           
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img
        {
         width: 200px;
         height: 150px;
        }
    </style>
</head>
<body>
  <div class="contenedor-form">
       <h1>Comprar</h1>
       <form action="registraCompra.php" method="post" enctype="multipart/form-data">
       <input style="display: none"  type="text" value="<?php echo $id;?>" name="id_stock"><br>
      
       <label >Foto: </label><br>
       <img src="images/<?php echo $img ; ?>" alt=""><br>
      
       <label >Producto: </label>
       <input  type="text" name="nombreProducto" value="<?php echo $producto;?>"  readonly><br>
       <label >Descripcion: </label>
       <input style="width: 30%" type="text" name="descripcion" value="<?php echo $desc;?>" readonly ><br>
       <label >Costo: </label>
       <input  type="text" name="costo" value="<?php echo $costo;?>" readonly><br>
       <label >Cantidad: </label>
       <input required type="number" name="cantidad"  min="1" max="300"><br>
       <label for="start">Ingrese fecha:</label>

         <input required type="date" id="start" name="cita"
         value="2020-01-01"
         min="2020-01-01" max="2020-12-31">

         <button type="submit" >Comprar</button>
      
       </form>
      
       
   </div>
    <div id="res"></div>
</body>
</html>


 