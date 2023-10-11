<?php
$codigo=($_GET['codigo']);

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
    $sql = "DELETE FROM comprasproductos WHERE  codigoproducto=$codigo";
    $con->query($sql); 
    $res="entro";
    echo $res;
}
?>