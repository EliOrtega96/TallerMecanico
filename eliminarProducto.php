<?php
    require_once('conexion.php');
    session_start();
    $id_produc = $_GET['id_stock'];  //obtiene el id del elemento que se va a eliminar
  

   
   $producto = "DELETE FROM stock WHERE id_stock='$id_produc' ";   //query para eliminar el usuario que se va eliminar
    $conn->exec($producto); //ejecuta el query

    header("Location: stockm.php");  //una vez eliminado redirecciona a index.
?>