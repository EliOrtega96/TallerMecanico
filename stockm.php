<?php
    Session_start();
    
    require("conexion.php");
    $query = $conn->prepare("SELECT * FROM stock ");   //lee todos los usuarios de la tabla usuario
    $query->execute(); //ejecuta el query
    if(!empty($_POST)and !empty($_FILES)){
      $nombre =$_POST['nombre'];
      $desc =$_POST['desc'];
      $costo =$_POST['costo'];
      $cant =$_POST['cant'];
      $img = $_FILES['archivo']['name'];  
      $ruta = $_FILES['archivo']['tmp_name'];
      $destino = "images/".$img;
      copy($ruta,$destino);
      $id_usuario = $_POST['id_user'];

      
      $queryUser = "INSERT INTO stock (nombreProducto,descripcion,costo,cantidad,foto,id_usuario) VALUES('$nombre','$desc', '$costo','$cant','$img', '$id_usuario')";  //query para registrar 
      $conn->exec($queryUser);
   
      header('Location:stockm.php'); 
     
    }
    


   
?>



<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="#">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
              
      <style>
                img{width: 200px;
                height: 150px;
                }
            </style>
        <title> Registro </title>
    </head>
      <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <ul class="navbar-nav">
            <li class="nav-item ">
            <a class="nav-link" href="stockm.php">Inicio</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="cerrarsesion.php">Salir</a>
            </li>

          </ul>
        </nav>
            <h1>Stockm</h1>
            <button style="margin-left:250px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Registrar Producto</button>
            
            
            <div class="container">

           <div class="container"> 
   <div class="row">
        <table style="width: 100%;"> <!-- tabla de usuarios registrados -->
            <thead>
                <tr>
                    
                    <td>id</td>
                    <td>Producto</td>
                    <td>Descripcion</td>
                    <td>Costo</td>
                    <td>Cantidad</td>
                    <td>Foto</td>
                   
                   
                </tr>
               
            </thead>
            <?php 
                        while($res = $query->fetch()) 
                        {  
                            $img = $res['foto'];
                            echo "<tr>";
                            echo "<td>".$res['id_stock']."</td>";   
                            echo "<td>".$res['nombreProducto']."</td>";
                            echo "<td>".$res['descripcion']."</td>";
                            echo "<td>".$res['costo']."</td>";
                            echo "<td>".$res['cantidad']."</td>";
                            echo "<td>"."<img src='images/$img' >"."</td>";
                           
                            echo "<td><a href='eliminarProducto.php?id_stock=$res[id_stock]'> <button type='button' class='btn btn-danger'>Eliminar</button></a></td>";		
                            echo "</tr>";  
                
                            
                          



                        }
                ?>  
          </table>
      </div> 
              </div>





            <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registrar Producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre"  placeholder="Nombre">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="desc" placeholder="Descripcion">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Costo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="costo" placeholder="Costo">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Cantidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cant" placeholder="Cantidad">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
      <input type="file"  name="archivo" placeholder="Foto">
    </div>
    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_usuario'] ?>"> 
  </div>
 
  
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary col-sm-12">Crear</button>
    </div>
  </div>
</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

      </body>
</html>       
              
  
            
              
            