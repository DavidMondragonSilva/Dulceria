<?php
require('Barra.php');
if( isset($_GET["id"]) ){
		$consulta=($_GET['id']);
                
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
            $query = "SELECT * FROM comprasproductos WHERE idcompra=$consulta ";
            
            echo '<br><div class="text-bg-success p-3"> Detalles de el Pedido:'.$consulta.'</div> <br>';
            echo '<table class="table">';
            echo '<a class="btn btn-primary" href="../Index.php" role="button">Regresar</a> <br>
            <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo</th>
            <th scope="col">Id Compra</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">SubTotal</th>
            </tr>
            </thead> 
            ';
            $total=0;
            if ($result = $con->query($query)) {
                while ($row = $result->fetch_assoc()) {
                $codigo1 = $row["codigoproducto"];
                $compra = $row["idcompra"];
                $cantidad=$row["cantidad"];
                $precio = $row["precio"]; 
                $subtotal = $cantidad * $precio;
                $sql2 = "SELECT Nombre FROM productos WHERE codigo= $codigo1";
                $res2 = $con->query($sql2);
                $rowData2 = $res2->fetch_array();
                $nombre = $rowData2['Nombre'];
                echo '<tr>
                <td >'.$nombre.'</td>
                <td> '.$codigo1.'</td>  
                <td>'.$compra.'</td> 
                <td>'.$cantidad.'</td> 
                <td>$'.$precio.'</td> 
                <td>$'.$subtotal.'</td>
                </tr>';
                $subtotal = $cantidad * $precio;
                $total += $subtotal;
                }
                echo '<br>
                <div>Total:</div>
                <div>'. "$".$total.'</div><br>
                ';
                $result->free();
            }
        }
}
?>
<a class="btn btn-primary" href="#" role="button">Imprimir</a>
