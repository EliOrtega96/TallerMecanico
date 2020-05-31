<?php
    $username="root";
    $password="";
    try {  //si la conexion es exitosa 
        $conn = new PDO("mysql:host=localhost;dbname=tallermecanico", $username, $password);
        // set the PDO error mode to exception
       
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){ //si la conexion falla
        echo "Conexion fallo <br>" . $e->getMessage();
    }
?>