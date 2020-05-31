<?php
session_start();
require_once("conexion.php");

if(!empty($_POST)){
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
       echo $restaStock;
       if($restaStock >= 0 ){
           echo "te lo vendo";
           $val = $conn->prepare("SELECT count(*) as total FROM `agenda` ");   //lee todos los usuarios de la tabla usuarios
           $val->execute();
           $registros = $val->fetch();

           $valor= $registros['total'];
           if($valor == 0){
            $query2 =$conn->prepare("INSERT INTO compra (piezas,id_stock,id_usuario) VALUES('$pedido','$stock', '$id')");
            $query2->execute();
            $query3 =$conn->prepare("INSERT INTO agenda (fecha,servicio,id_usuario) VALUES('$cita','$producto','$id')");
            $query3->execute();
           $query4 = "UPDATE stock SET cantidad=$restaStock WHERE id_stock=$stock"; //query para actualizar datos
            $conn->exec($query4); //ejecuta query
           }else{
            $date = $conn->prepare("SELECT fecha FROM agenda");   //lee todos los usuarios de la tabla usuarios
            $date->execute();
           
            while($resDate = $date->fetch()) {
                $getDate= $resDate['fecha'];
             echo $getDate;
             if($cita == $getDate){
                 echo "fecha ocupada";
             }else{
                 echo "fecha agendada ";
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
           }

           
           
       }else{
           echo "tas wey no me alcanza";
          echo"    <script>";
          echo"  document.getElementById('res').innerHTML('noooooooooooooooooooooooooo'); ";
          echo"  </script>";
           
       }
   }else{
       echo "no";
   }
    
}else{
    header("Location: index.php");
}
     
?>
