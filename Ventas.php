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
    $query = "SELECT * FROM compras WHERE Estatus=1";
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
<table class="table">
        <thead>
        <tr>
        <th scope="col">#id</th>
        <th scope="col">fecha</th>
        <th scope="col">Status</th>
        <th scope="col">Ver detalle</th>

        </tr>
    </thead>
    <?php
    if ($result = $con->query($query)) {
        while ($row = $result->fetch_assoc()) {
        $id = $row["idpedido"];
        $fecha = $row["fecha"];
        //$Total=$row["Total"];
        $estatus = $row["estatus"];
        if($estatus==1){
            $estatus="Cerrado";
        }
        echo '<tr> 
        <td>'.$id.'</td> 
        <td>'.$fecha.'</td>
        <td>'.$estatus.'</td>
        <td> <a class="btn btn-dark" href="VerDetallePedidos.php?id='.$id.'" role="button">Ver deatlle</a> <br>
        </tr>';
        }
        
        }
        $result->free();
        ?>
        <a class="btn btn-primary" href="VentaDia.php" role="button">Venta del Dia</a>
</body>