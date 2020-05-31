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
         width: 250px;
         height: 250px;
         margin-left: 20%;
        }
        #menu{
            background-color:#000;
        }
        #menu ul{
            list-style: none;
            margin:0;
            padding:0;
        }
        #menu ul li{
            display:inline-block;
        }
        #menu ul li a{
            color:white;
            display:block;
            padding:20px 40px;
            text-decoration :none;
        }
        #menu ul li a:hover{
            background-color:#42B881;
        }
        .item-r{
            float:right;
        }
        button{
  background-color: #dcefdc; 
  color: black; 
  border: 2px solid #4CAF50;
  cursor: pointer;
  margin-left: 40%;
  margin-top: 2%;
  width: 20%;
  height: 50px;
}

button:hover{
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

* {
  box-sizing: border-box;
}

input[type=text],input[type=number],input[type=date]  {
  width: 80%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 50px;
  display: inline-block;
}
.container {
  border-radius: 15px;
  background-color: #f2f2f5;
  padding: 20px;
  margin-top:15px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}


.row:after {
  content: "";
  display: table;
  clear: both;
}
h1{
    text-align:center;
}

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
    </style>
</head>
<body>
<div id="menu">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li class="item-r"><a href="cerrarsesion.php">Cerrar Sesion</a></li>
            <li class="item-r"><a href="#"><?php echo $_SESSION['nombre'];?></a></li>
            


        </ul>
    </div>
  <div class="container">
    <h1>Detalles de producto</h1>
    <div id="res"></div>
  <form action="" method="post" id="form">

  <div class="row">
    <div class="col-25">
      <label for="fname"></label>
    </div>
    <div class="col-75">
    <input style="display: none" id="id_stock" type="text" value="<?php echo $id;?>" name="id_stock">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="lname"></label>
    </div>
    <div class="col-75">
    <img src="images/<?php echo $img ; ?>" alt="">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="country">Producto</label>
    </div>
    <div class="col-75">
    <input  type="text" id="producto" name="nombreProducto" value="<?php echo $producto;?>"  readonly>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="subject">descripcion</label>
    </div>
    <div class="col-75">
    <input  id="descripcion" type="text" name="descripcion" value="<?php echo $desc;?>" readonly >
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="subject">Costo</label>
    </div>
    <div class="col-75">
    <input  type="text" name="costo" id="costo" value="<?php echo $costo;?>" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="subject">Cantidad</label>
    </div>
    <div class="col-75">
    <input required type="number" id="cantidad" name="cantidad"  min="1" max="300">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="subject">Fecha de cita</label>
    </div>
    <div class="col-75">
    <input required type="date" id="fecha" name="cita"
         value="2020-01-01"
         min="2020-01-01" max="2020-12-31">
    </div>
  </div>


  <div class="row">
  <br>
  <button type="button" id="enviar" >Comprar</button>
  </div>

  </form>
   </div>
   <br>
<script>
  $(document).ready(function()
  {
    $("button").click(function()
    {
        var id_stock=document.getElementById('id_stock').value;
        var producto=document.getElementById('producto').value;
        var fecha=document.getElementById('fecha').value;
        var cantidad=document.getElementById('cantidad').value;
      //  var ruta="Id_stock"+id_stock+"&Cantidad"+cantidad+"&Cita"+fecha+"&NombreProducto"+producto;
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
 