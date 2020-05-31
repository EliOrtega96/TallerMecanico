<?php
session_start();
require_once("conexion.php");

if(!empty($_POST))
{
      $stock=$_POST['id_stock'];
      $pedido =$_POST['cantidad']; //
      $cita=$_POST['cita'];
      $id=$_SESSION['id_usuario'];
      $producto=$_POST['nombreProducto'];
      
    $query = $conn->prepare("SELECT cantidad FROM stock where id_stock=$stock");   //lee todos los usuarios de la tabla usuarios
    $query->execute(); //ejecuta el query
    $result = $query->fetch();//obtiene dato de piezas
   $total= $result['cantidad'];

   if($total>0){
       $restaStock = $total-$pedido;
       if($restaStock >= 0 )
       {
           $val = $conn->prepare("SELECT count(*) as total FROM `agenda` ");   //lee todos los usuarios de la tabla usuarios
           $val->execute();
           $registros = $val->fetch();

           $valor= $registros['total'];
           if($valor == 0)
           {
            echo '<div class="alert alert-success" role="alert">Se realizó la compra correctamente y se agendo la cita en la fecha seleccionada </div>';
                $query2 =$conn->prepare("INSERT INTO compra (piezas,id_stock,id_usuario) VALUES('$pedido','$stock', '$id')");
                $query2->execute();
                $query3 =$conn->prepare("INSERT INTO agenda (fecha,servicio,id_usuario) VALUES('$cita','$producto','$id')");
                $query3->execute();
                $query4 = "UPDATE stock SET cantidad=$restaStock WHERE id_stock=$stock"; //query para actualizar datos
                $conn->exec($query4); //ejecuta query
           }else{
            $date = $conn->prepare("SELECT *  FROM `agenda` WHERE fecha='$cita' ");   //lee todos los usuarios de la tabla usuarios
            $date->execute();
            $resDate = $date->fetch();
            $getDate= $resDate['fecha'];
            
             if($cita == $getDate){
                 echo '<div class="alert alert-danger" role="alert">fecha ocupada, por favor seleccione una fecha diferente</div>';
             }else{
                echo '<div class="alert alert-success" role="alert">Se realizó la compra correctamente y se agendo la cita en la fecha seleccionada.. </div>';
                 $query2 =$conn->prepare("INSERT INTO compra (piezas,id_stock,id_usuario) VALUES('$pedido','$stock', '$id')");
                $query2->execute();
                 $query3 =$conn->prepare("INSERT INTO agenda (fecha,servicio,id_usuario) VALUES('$cita','$producto','$id')");
                 $query3->execute();
                 $query4 = "UPDATE stock SET cantidad=$restaStock WHERE id_stock=$stock"; //query para actualizar datos
                 $conn->exec($query4); //ejecuta query
                 $query5 =$conn->prepare("INSERT INTO notificacion (asunto,descripcion,id_usuario) VALUES('$cita','$producto','$id')");
                $query5->execute();


             }
             
           }

           
           
       }else{
           echo  '<div class="alert alert-danger" role="alert">No alcanzan los productos existentes en stock para realizar la compra</div>';
        
           
       }
   }else{
       echo '<div class="alert alert-danger" role="alert">Lo sentimos... no hay productos en stock</div>';
   }
    
}else{
    header("Location: index.php");
}
     
?>
