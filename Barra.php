<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <!-- Navbar content -->
  <div class="container-fluid">
    <a class="navbar-brand" > <img id="imgbarra" src="https://cdn-icons-png.flaticon.com/512/169/169871.png" href="RegistrarProductos.php"> Dulceria</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Funciones/Ventas.php">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Funciones/RealizarCompra.php">Realizar Compra</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Funciones/RegistrarProductos.php">Registrar Productos</a>
        </li>
      </ul>
    </div>
</nav>
</nav>
</html>