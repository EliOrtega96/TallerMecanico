<?php
    require_once('conexion.php');
    
    $id_usuario = $_GET['id_usuar'];  //obtiene el id del elemento que se va a eliminar
  

   
   $user = "DELETE FROM usuario WHERE id_usuario='$id_usuario' ";   
    $conn->exec($user); //ejecuta el query

    header("Location: admin.php");  //una vez eliminado redirecciona a admin.
?>