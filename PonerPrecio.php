<?php
$codigo=($_GET["codigo"]);
$servername = "localhost";
$database = "dulceria";
$username = "root";
$password = "";
// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
  die("MAMES no se Conecto: " . mysqli_connect_error());
}
else{
    $query = "SELECT Precio FROM productos WHERE Estatus=1 AND Codigo='$codigo'";
    $result = $con->query($query);
    $row=$result->fetch_assoc();
    $Precio=$row['Precio'];
    if($Precio<0){
      $Precio=0;
    }
    echo $Precio;
}
  