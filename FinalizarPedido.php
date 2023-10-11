<?php
session_start();
$ses_id = $_SESSION["sesion"];
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

$sql= "INSERT INTO compras(idpedido,fecha, estatus) 
VALUES ($ses_id,'$fecha',1)";

$res = $con->query($sql);

echo $res;

}
?>