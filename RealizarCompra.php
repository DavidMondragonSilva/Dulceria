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
   
    $sql = "SELECT * FROM comprasproductos WHERE idcompra = $idsesion";
    $res = $con->query($sql);
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
<style>
    #formulario{
        text-align:center;
        width:100%;
        border:10px dotted #9400D3;
        padding:30px;
        margin:auto;
    }
    #MensajeCodigo{
        color:#FF4500;
        font:bold;
        font-size:1.3rem;
    }
</style>
<script>
    function confirmar(n){
    var opc=confirm("Desea eliminar este registro?");
    if(opc==true){
        $.ajax({
            url:'../DB/Eliminar.php?codigo='+n,
            type:'post',
            dataType:'text',
            data: 'codigo='+n,
            success:function (res){
                if(res){
                    alert("Se elimino con exito.");
                }
                else{
                    alert("No se pudo eliminar");
                }
            }
        });
    }
    else{
        alert("no funciono");
    }
}
function VerificarCodigo(){
    var codigo=$('#codigo').val();
    if(codigo){
        $.ajax({
            url:'../DB/Verificar_Codigo.php?codigo='+codigo,
            type:'post',
            dataType:'text',
            data: 'codigo='+codigo,
            success:function (res){
                
                if(res>0){
                    $('#MensajeCodigo').html("Es Correcto");
                    setTimeout("$('#MensajeCodigo').html('')",7000);
                }
                else{
                    $('#MensajeCodigo').html("El Codigo de Este producto no existe.");
                    setTimeout("$('#MensajeCodigo').html('')",7000);
                    $('#codigo').val("");
                }
            }
        });
    }

    if(codigo){
        $.ajax({
            url:'../DB/PonerPrecio.php?codigo='+codigo,
            type:'post',
            dataType:'text',
            data: 'codigo='+codigo,
            success:function (res){
                
                if(res>0){
                    $('#precio').html("$"+res);
                    $('#MensajePrecio').html("$"+res)
                }
                else{
                    $('#cantidad').html("");
                    $('#MensajePrecio').html("El precio no se Encontro");
                }
            }
        });
    }
}

</script>
<body>
    <br><br><br>
    <div id="formulario">
        <h2> #Num Venta:<?php echo $idsesion?></h2>
        <form action="../DB/Salva.php" method="POST" enctype="multipart/form-data" name="fomularicompra">
            <label for="">Codigo de Barras:
                <input onblur='VerificarCodigo();' id="codigo" class="form-control form-control-lg" type="text" placeholder="codigo" aria-label=".form-control-lg example" name="codigo">
                <div id="MensajeCodigo"></div>
            </label>
            <label for="">Cantidad:
                <input id="cantidad" class="form-control" type="text"  aria-label="default input example" name="cantidad" >
            </label>
            <label for="">Precio:
                <input id="precio" class="form-control" type="text"  aria-label="default input example" name="precio" >
                <div id="MensajePrecio"></div>
            </label>
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">  
                <button type="submit" class="btn btn-success btn-lg">Guardar</button>
            </div>
        </form>
        
    </div>
    <table class="table">
  <thead>
  <tr>
  <th scope="col">Codigo</th>
  <th scope="col">Nombre</th>
  <th scope="col">Descripcion</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Precio</th>
  <th scope="col">subtotal</th>
  <th scope="col">Eliminar</th>
  </tr>
  </thead> 
</body>
</html>
 
<?php
      global $total;
      $total = 0;
      while ($rowData = $res->fetch_assoc()) {
        $id = $rowData['id'];
        $idCompra = $rowData['idcompra'];
        $codigo = $rowData['codigoproducto'];
        $cantidad = $rowData['cantidad'];
        $precio = $rowData['precio'];
        $subtotal = $precio * $cantidad;
        $total += $subtotal;
        
        $sql = "SELECT * FROM productos WHERE Codigo=$codigo";
        $res2 = $con->query($sql);
        $rowData2 = $res2->fetch_array();
        $nombre = $rowData2['Nombre'];
        $Descripcion=$rowData2['Descripcion'];
        echo "
        <td>$codigo</td> 
        <td>$nombre</td> 
        <td>$Descripcion</td> 
        <td>$cantidad</td>
        <td>$precio</td>
        <td>$ $subtotal</td>
        <td> <a  onclick=confirmar($codigo); class='btn btn-warning'  role='button'>Eliminar</a> <br>
        </tr>";
        }

        ?>
<?php
 }
 echo "<div id='total'> 
 <h3>Total: $total</h3>
    </div>";
 ?>
 <br>    
 <script>
    function finaliza(id){
                  $.ajax({
                    url: 'FinalizarPedido.php?id=<?php echo $idsesion?>',
                    type: "post",
                    dataType: "text",
                    success: function(res) {
                      if (res == true) {
                        $("#msg_ext").html("Pedido realizado con exito...");
                      } else {
                        alert("No funciono");
                      }
                    },
                    error: function() {
                      alert(
                        "Error archivo no encontrado (scriptFinalizaPedido.php)"
                      );
                    },
                  });
                  $.ajax({
                    url:'../ticket.php?id=<?php echo $idsesion?>',
                    type:'post',
                    dataType:'text',
                    success:function (res){
                        
                        if(res){
                            $('#impresora').html("imprimiendo....");
                            setTimeout(function() {
                                window.location.href="../Index.php";
                                }, 4000);
                        }
                        else{
                            $('#impresora').html("....");
                            setTimeout(function() {
                                window.location.href="../Index.php";
                                }, 5000);
                        }
                    }
                });

        }
  </script>
        <div class="d-grid gap-2 col-6 mx-auto">  
            <a type="button"  class="btn btn-dark btn-lg" onclick="finaliza()";>Terminar Compra</a>
            <div id="msg_ext"></div>
            <div id="impresora"></div>
        </div>