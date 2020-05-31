<?php
    require_once('conexion.php');
    //session_start();
    $id_cont = $_GET['id_cont'];  //obtiene el id del elemento que se va a eliminar
  

   
   $contenido = "DELETE FROM contenido WHERE id_contenido='$id_cont' ";   //query para eliminar el usuario que se va eliminar
    $conn->exec($contenido); //ejecuta el query

    header("Location: contenido.php");  //una vez eliminado redirecciona a index.
?>