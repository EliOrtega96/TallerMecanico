<?php
     require_once('conexion.php'); //incluye el archivo de conexion a la base de datos
     if(!empty($_POST)){  //valida que el formulario no se haya enviado vacio.
         $titulo = $_POST['titulo'];   //obtiene el dato del campo usuario del formulario 
         $desc = $_POST['descripcion']; //obtiene el dato del campo correo del formulario  
         $id = $_POST['id']; //obtiene el dato del campo id del formulario 
         $queryUser = "UPDATE contenido SET titulo='$titulo', descripcion='$desc' WHERE id_contenido=$id"; //query para actualizar datos
         $conn->exec($queryUser); //ejecuta query
         header('Location: contenido.php'); //una vez actualizados los datos redirecciona a index.php
     }
  
?>

