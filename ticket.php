<?php
session_start();
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
    Aquí, en lugar de "POS" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/

$nombre_impresora = "ticket"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.
echo 1;
/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);
try{
	$logo = EscposImage::load("logodulceria.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){/*No hacemos nada si hay error*/}

/*
	Ahora vamos a imprimir un encabezado
*/

$printer->text("\n"."Dulceria Davicos" . "\n");
$printer->text("Direccion: Pascual Morones Juanacatlan" . "\n");
$printer->text("Tel: 3311193542" . "\n");
#La fecha también
date_default_timezone_set("America/Mexico_City");
$printer->text(date("Y-m-d H:i:s") . "\n\n");
$printer->text("#Venta:".$idsesion."\n");
$printer->text("-----------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);

/*
	Ahora vamos a imprimir los
	productos
*/
$sql = "SELECT * FROM comprasproductos WHERE idcompra = $idsesion";
$res = $con->query($sql);
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
        /*Alinear a la izquierda para la cantidad y el nombre*/
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text($nombre." ".$Descripcion."\n");
        $printer->text($cantidad." pieza    $".$precio."    ".$subtotal."|\n");
        $printer->text("-----------------------------"."\n");
        }
/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("-----------------------------"."\n");
$printer->setJustification(Printer::JUSTIFY_RIGHT);
//$printer->text("SUBTOTAL: $100.00\n");
//$printer->text("IVA: $16.00\n");
$printer->text("TOTAL: $".$total."\n");


/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Muchas gracias por su compra.\n");



/*Alimentamos el papel 3 veces*/
$printer->feed(2);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
//$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
	$res=1;
	echo $res;
	session_destroy();
}
?>