<?php
session_start();
$idsesion= $_SESSION['sesion'];
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
    
    $codigo = $_REQUEST['codigo'];
    $cantidad = $_REQUEST['cantidad'];
    $precio = $_REQUEST['precio'];
        
    $sql = "SELECT * FROM comprasproductos WHERE codigoproducto = $codigo AND idcompra = $idsesion ";

    $res = $con->query($sql);
    $rowData = $res->fetch_array();
        
    if ($rowData != "") {
        $plus = $rowData['cantidad'];
        $cantidad += $plus;
        $sql = "UPDATE comprasproductos SET cantidad = $cantidad WHERE codigoproducto = $codigo AND idcompra = $idsesion ";
        $res = $con->query($sql);
        }
    else{
        $sql = "INSERT INTO comprasproductos (codigoproducto, idcompra, cantidad,precio) 
        VALUES ('$codigo', $idsesion,$cantidad,$precio)";
        $con->query($sql);
        }
    echo $cantidad;
   header("Location: ../Funciones/RealizarCompra.php");
}