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
    $nombre = $_REQUEST['nombre'];
    $codigo = $_REQUEST['codigo'];
    $descripcion = $_REQUEST['descripcion'];
    $precio = $_REQUEST['precio'];
    $stock = $_REQUEST['stock'];
    
    $sql = "INSERT INTO productos (Nombre,codigo,Descripcion,Precio,Stock) 
    VALUES ('$nombre','$codigo','$descripcion',$precio,$stock)";
    $con->query($sql);
    header("Location: ../Index.php");
}