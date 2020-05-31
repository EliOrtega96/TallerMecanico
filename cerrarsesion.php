<?php
    session_start();  
    session_destroy();  
    
    header('Location: login.php') // al destriur la sesion redirecciona al login.
?>