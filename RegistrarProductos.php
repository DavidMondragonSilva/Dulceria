<?php
session_start();
$_SESSION['sesion'];
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
<script>
     function anular(e) {
          tecla = (document.all) ? e.keyCode : e.which;
          return (tecla != 13);
     }

       function Guardar(){
        var codigo=$("$codigo").val();
        var nombre=$("$nombre").val();
        alert("entro:"+codigo+nombre);
        if(nombre==""){
            alert("Te Faltan campos por llenar");
            return false;
        }
       }
function VerificarCodigo(){
    var codigo=$('#codigo').val();
    if($('#precio').val==""){
        $('#btnGuardar').attr('disable',true);
    }
    else{
        $('#btnGuardar').attr('disable',false);
    }
    if(codigo){
        $.ajax({
            url:'../DB/Verificar_Codigo.php?codigo='+codigo,
            type:'post',
            dataType:'text',
            data: 'codigo='+codigo,
            success:function (res){
                
                if(res>0){
                    $('#MensajeCodigo').html("Este Codigo "+codigo+" de producto ya existe");
                    setTimeout("$('#MensajeCodigo').html('')",7000);
                    $('#codigo').val("");
                }
                else{
                    $('#MensajeCodigo').html("Correcto");
                    setTimeout("$('#MensajeCodigo').html('')",7000);
                }
            }
        });
    }
}
</script>
<body>
<div class="text-bg-success p-3">Aqui es la seccion de alta Productos</div>
    <br>
    <form action="../DB/SalvaProductos.php" method="POST" enctype="multipart/form-data" name="fomularioadmins" onkeypress="return anular(event)">
        <div class="col-md-3 text-center">
            <label for="">Nombre:
                <input id="nombre" require class="form-control form-control-lg" type="text" placeholder="nombre" aria-label=".form-control-lg example" name="nombre">
            </label>
            <label for="">Codigo de Barras:
                <input onblur='VerificarCodigo();' id="codigo" class="form-control form-control-lg" type="text" placeholder="codigo" aria-label=".form-control-lg example" name="codigo">
                <div id="MensajeCodigo"></div>
            </label>
            <label for="">Descripcion:
                <input id="descripcion" class="form-control" type="text"  aria-label="default input example" name="descripcion" >
            </label>
            <label for="">Precio:
                <input id="precio"  require class="form-control" type="text"  aria-label="default input example" name="precio" >
            </label>
            <label for="">Stock:
                <input id="stock" class="form-control" type="number"  aria-label="default input example" name="stock" >
            </label>

            <br>
        <button  type="submit"  class="btn btn-dark" id="btnGuardar" onclick="Guardar();" >Guardar</button>
        <div id="Mensaje"></div>
        <input type="textarea">

    </form>
</body>
<?php
 }
?>
