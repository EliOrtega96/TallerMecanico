<?php
  require_once('conexion.php');

 if(!empty($_POST)){  //valida que el formulario tenga datos
     $nombre = $_POST['nombre']; // obtiene dato ingresado en el campo   
     $correo = $_POST['correo'];  // obtiene dato ingresado en el campo correo del formulario  
     $pass = $_POST['password']; // obtiene dato ingresado en el contraseña usuario del formulario  
     $rol = $_POST['id_rol'];
     $queryUser = "INSERT INTO usuario (nombre,correo,password,id_rol) VALUES('$nombre','$correo', '$pass','$rol')";  //query para registrar 
     $conn->exec($queryUser); //ejecuta query
     
     header('Location: login.php');  // despues de registrar redirecciona a login.php
 }
 ?>
 
 
 
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css/login2.css">
    
</head>
<body>
   <div class="contenedor-form">
       <h1>Registrar</h1>
       <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
       <input type="text" name="nombre" class="input-control"  placeholder="Usuario:">
       
       <input type="email" name="correo" class="input-control"  placeholder="Correo electronico:">
      
       <input type="password" name="password" class="input-control"  placeholder="Contraseña:">

       <input type="hidden" name="id_rol" value="1">
       
       <input type="submit" value="Registrar"  name="registrar" class="log-btn">
       </form>
       <div class="registrar">
           <a href="login.php">¿Ya tienes cuenta?</a>
       </div>
       
   </div>
    
</body>
</html>