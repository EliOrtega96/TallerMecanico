<?php
    require_once('conexion.php');
    $id = $_GET['id']; //obtiene el id del registro que se va editar
    $query = $conn->prepare("SELECT * FROM contenido WHERE id_contenido ='$id'"); //query para obtener los datos del registro a editar
    $query->execute(); //ejecuta query
    while($res = $query->fetch()) {  //obtiene datos del registro a editar		
         // se asigna a la variable $usuario el dato del campo usuario de la tabla usuarios
        $titulo = $res['titulo']; // se asigna a la variable $correo el dato del campo correo de la tabla usuarios
        $img = $res['foto']; 
        $desc = $res['descripcion'];
       
        
        $id_usuario =$res['id_usuario'];
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="actualizar.php" method="post" enctype="multipart/form-data">
       <input style="display: none"  type="text" value="<?php echo $id;?>" name="id"><br>
      
       <label >Foto: </label><br>
       <img src="images/<?php echo $img ; ?>" alt=""><br>
      
       <label >Titulo: </label>
       <input  type="text" name="titulo" value="<?php echo $titulo;?>"><br>
       <label >Contenido: </label>
       <input style="width: 30%" type="text" name="descripcion" value="<?php echo $desc;?>" ><br>
       <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>"> 

      
       <button class="img-center" type="submit">Guardar</button>
       </form>
       
</body>
</html>