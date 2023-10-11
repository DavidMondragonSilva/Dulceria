<?php
session_start();
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

 $sql = "SELECT MAX(id)  FROM compras";

 $res = $con->query($sql);
 $row = $res->fetch_row();
 $sesion=$row[0];
 $_SESSION["sesion"] = $sesion+1;
 $sesion=$_SESSION["sesion"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
<br><br><br><br><br>
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img class="carrusel" src="https://cdn.shopify.com/s/files/1/0430/5489/1157/collections/DeLaRosa_BannerMazapan-03_1512x.png?v=1621980961" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img class="carrusel" src="https://cdn.shopify.com/s/files/1/0430/5489/1157/collections/DeLaRosa_BannerCacahuates-03_1080x.png?v=1607199081" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h3>Cacahuate Japones</h3>
        <p>S</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img class="carrusel" src="https://cdn.shopify.com/s/files/1/0430/5489/1157/collections/DeLaRosa_BannerChocolates-03_1512x.png?v=1607198978" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br><br><br><br><br>
<div id="historia">
    <br>
    <h1 class="txt">
        Dulceria Davicos 
    </h1>
    <br>
    <h3 class="txt"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, eveniet architecto nam, mollitia maxime eum iusto quibusdam explicabo aliquam praesentium repellendus? Ipsam nostrum assumenda illo culpa tenetur? Fuga, id deserunt.</h3>
</div>
</body>
</body>
</html>
<style >
        #imgbarra{
            width: 80px;
            height: 80px;
            border:2px;
        }
        .carrusel{
            width:100%;
            height:600px;
        }
        #historia{
            width:50%;
            border:10px dotted #DEB887;
            padding:8px;
            margin:auto;
        }
        .txt{
            font-style:oblique;
            text-align: center;
        }
    </style>