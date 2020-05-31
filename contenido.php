<?php
   session_start();
    require_once('conexion.php'); //incluye en archivo conexion DB

   
    $query = $conn->prepare("SELECT * FROM contenido ");   //lee todos los usuarios de la tabla usuario
    $query->execute(); //ejecuta el query
    if(!empty($_POST)and !empty($_FILES)){
      $titulo =$_POST['titulo'];
     $img = $_FILES['archivo']['name'];  
      $ruta = $_FILES['archivo']['tmp_name'];
      $destino = "images/".$img;
      copy($ruta,$destino);
      $desc =$_POST['desc'];
      $id_usuario = $_POST['id_user'];

      
      $queryUser = "INSERT INTO contenido (titulo,foto,descripcion,id_usuario) VALUES('$titulo','$img', '$desc','$id_usuario')";  //query para registrar 
      $conn->exec($queryUser);
   
      header('Location:contenido.php'); 
     
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
    <title>Contenido</title>
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
            <li><a href="admin.php">Usuarios</a></li>
            <li><a href="contenido.php">Contenidos</a></li>
            <li><a href="reportes.php">Reporte</a></li>
            <li><a href="cerrarsesion.php">Salir</a></li>
            
            
            
        </ul>
    </div>




<div class="container">
<div class="row"> <button style="margin-left:250px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Registrar Contenido</button></div><br><br>
<div class="container"> 
   <div class="row">
        <table style="width: 100%;"> <!-- tabla de usuarios registrados -->
            <thead>
                <tr>
                    
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Foto</td>
                    <td>Descripcion</td>
                   
                   
                </tr>
                <?php 
                while($res = $query->fetch()) { 
                    $img = $res['foto'];		
                    echo "<tr>";
                    echo "<td>".$res['id_contenido']."</td>"; //nombre de los campos de la base de datos.
                    echo "<td>".$res['titulo']."</td>";
                    echo "<td>"."<img src='images/$img' >"."</td>";
                   
                    echo "<td>".$res['descripcion']."</td>";
                    
                    	                             
                    echo "<td> <a href='modificarContenido.php?id=$res[id_contenido]'><button type='button' class='btn btn-success'>Editar</button></td>"; //boton editar, al dar clic manda al archivo editar.php mandando el id del registro que se va editar	            
                   echo "<td><a href='eliminarContenido.php?id_cont=$res[id_contenido]'  onClick=\"return confirm('Seguro que deseas eliminarlo?')\"> <button type='button' class='btn btn-danger'>Eliminar</button></a></td>";		
                    //echo "<td><a href=\"eliminar.php?id=$res[id]\" onClick=\"return confirm('Seguro que deseas eliminarlo?')\"><button type='button' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></a></td>";
                    
                    echo "</tr>";  
                
                     
                    
                }
            ?>
            </thead>
          </table>
      </div> 
              </div>
 
 
 
 
 
 
 
 
 <!-- The Modal -->
 <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Crear Contenido</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Contenido</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="titulo"  placeholder="Titulo">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
      <input type="file"  name="archivo" placeholder="Foto">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="desc" placeholder="Descripcion">

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