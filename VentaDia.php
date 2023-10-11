<?php
session_start();
$idsesion= $_SESSION['sesion'];
require('Barra.php');
$servername = "localhost";
 $database = "dulceria";
 $username = "root";
 $password = "";
 // Create connection
 $con = mysqli_connect($servername, $username, $password, $database);
 // Check connection
 if (!$con) {
     die("Conexion a fallado: " . mysqli_connect_error());
 }
 else{ 
    
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");


    $fecha = date("Y")."/".date("m")."/".date("d");
    $query = "SELECT * FROM compras WHERE  fecha='$fecha'";
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
    <br><br><br>
    <table class="table">
  <thead>
  <tr>
  <th scope="col">idCompra</th>
  <th scope="col">Cantidad </th>
  <th scope="col">Precio</th>
  <th scope="col">Subtotal</th>
  
  </tr>
  </thead> 
    <?php
    global $total;
    $total=0;
    $cont=0;
        if ($result = $con->query($query)) {
            //$cuantos=$result->fecth_rows();
            //echo $cuantos;
            while ($row = $result->fetch_array()) {
                $id = $row["idpedido"];
                $cont+=1;
                $sql2="SELECT * FROM comprasproductos WHERE idcompra=$id";
                $result2=$con->query($sql2);
                $row2=$result2->fetch_assoc();
                $cantidad=$row2["cantidad"];
                $precio=$row2["precio"];
                $idcompra=$row2["idcompra"];
                $subtotal = $precio * $cantidad;
                $total += $subtotal;
                echo "<tr> 
                <td>$idcompra</td> 
                <td>$cantidad</td>
                <td>$precio</td>
                <td>$subtotal</td>
                </tr>"; 
            }
        }
        echo"<h1>Ventas del dia:$cont</h1>
        <h1>Total:$total</h1>";
    ?>
</body>