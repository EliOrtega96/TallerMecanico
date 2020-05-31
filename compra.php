<?php
session_start();
 require_once('conexion.php');
 $id = $_GET['id']; //obtiene el id del registro que se va comprar
 $query = $conn->prepare("SELECT * FROM stock WHERE id_stock ='$id' "); //query para obtener los datos del registro a editar
            $query->execute(); //ejecuta query
            while($res = $query->fetch()) {
               	
                $id = $res['id_stock']; //datos de la base de datos
                $img = $res['foto']; 
                $producto=$res['nombreProducto'];
                $desc=$res['descripcion'];
                $costo="$".$res['costo'].".00";
            }           
 ?>
<?php
if( isset($_SESSION['id_usuario']) ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        img
        {
         width: 200px;
         height: 150px;
        }
    </style>
</head>
<body>
  <div class="contenedor-form">
       <h1>Comprar</h1>
       <form action="" method="post" id="form">
       <input style="display: none" id="id_stock" type="text" value="<?php echo $id;?>" name="id_stock"><br>
      
       <label >Foto: </label><br>
       <img src="images/<?php echo $img ; ?>" alt=""><br>
      
       <label >Producto: </label>
       <input  type="text" id="producto" name="nombreProducto" value="<?php echo $producto;?>"  readonly><br>
       <label >Descripcion: </label>
       <input style="width: 30%" id="descripcion" type="text" name="descripcion" value="<?php echo $desc;?>" readonly ><br>
       <label >Costo: </label>
       <input  type="text" name="costo" id="costo" value="<?php echo $costo;?>" readonly><br>
       <label >Cantidad: </label>
       <input required type="number" id="cantidad" name="cantidad"  min="1" max="300"><br>
       <label for="start">Ingrese fecha:</label>

         <input required type="date" id="fecha" name="cita"
         value="2020-01-01"
         min="2020-01-01" max="2020-12-31">
       
         <button type="button" id="enviar" >Comprar</button>
       </form>    
   </div>
    <div id="res"></div>
<script>
  $(document).ready(function()
  {
    $("button").click(function()
    {
        var id_stock=document.getElementById('id_stock').value;
        var producto=document.getElementById('producto').value;
        var fecha=document.getElementById('fecha').value;
        var cantidad=document.getElementById('cantidad').value;
        var ruta="Id_stock"+id_stock+"&Cantidad"+cantidad+"&Cita"+fecha+"&NombreProducto"+producto;
        if(cantidad >0){
            $.ajax({
            url: 'registraCompra.php',
            type: 'POST',
            data: $('#form').serialize(),
        })
        .done(function(res){
            $('#res').html(res)
        })
        .fail(function(){
            console.log("error");
        })
        .always(function(){
            console.log("completo");
        })
        }else{
            alert("debes comprar al menos un producto");
        } 
    });
 });
</script>
</body>
</html>
<?php
}
else{
    header("Location: login.php");
}
?>
 