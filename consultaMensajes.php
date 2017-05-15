<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo']) == 1) {
    $nombre_u = $_SESSION['user'];
    
    $date = getdate();
    $fecha = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
    registrar_consultaM($nombre_u, $fecha);
    
    if (isset($_GET["posicion"])) {
    $posicion = $_GET["posicion"];
} else {
// Inicialmente la posición es 0, ya que aún no ha mostrado nada
    $posicion = 0;
}

    if(!isset($_POST['leer'])){
?>

<table>
<tr>
    <th>ID Mensaje</th> <th>Emisor</th> <th>Fecha/hora</th> <th>Asunto</th> <th>Leído?</th><br>
</tr>
    <?php
    $total = totalMensajesRecividos($nombre_u);
    $ranking = mostrarMensajes($nombre_u, $posicion, 10);
    
    while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
        /* Siempre después de extract las variables se llaman como en la bbdd
         */
        $leido="No";
        if($read == 0){
            $leido = "No";
        }else if($read == 1){
            $leido = "Sí";
        }
        echo "<tr>";
        echo "<td>$idmessage</td> <td>$sender</td> <td>$date</td> <td>$subject</td> <td>$leido</td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
if ($posicion >0) {
    echo "<a href='consultaMensajes.php?posicion=" . ($posicion - 5) . "'>&lt;&lt;</a>";
}
//Mostramos referencia a lo que mostramos
if ($posicion + 5 <= $total) {
    echo "Mostrando " . ($posicion + 1) . " al " . ($posicion + 5) . " de $total ";
} else {
    echo "Mostrando " . ($posicion + 1) . " al $total de $total";
}
// Comprobamos si hay más páginas (por delante)
if ($posicion + 5 < $total) {
    echo "<a href='consultaMensajes.php?posicion=" . ($posicion + 5) . "'>&gt;&gt;</a>";
}
?>
<form action="" method="POST">
    Mensaje a leer:
    <select name="mensaje">
    <?php
    $ranking2 = mostrarMensajes($nombre_u,$posicion, 10);
    
    while ($fila = mysqli_fetch_array($ranking2)) {
        extract($fila);
        echo "<option value='$idmessage'> $sender - $subject </option>";
        
    }
    ?>
    </select>
    <input type="submit" name="leer" value="leer"/>
</form>

<?php
    }else{
        $idmensaje = $_POST['mensaje'];
        
        cambiarMensajeaLeido($idmensaje);
        
        $ranking2 = mostrarMensajeEscogido($idmensaje);
        
        while ($fila = mysqli_fetch_array($ranking2)) {
        extract($fila);

        echo "<br>
              ID Mensaje : $idmessage<br>
              Emisor : $sender<br>
              Fecha : $date<br>
              Asunto : $subject<br>";
        echo "<hr> MENSAJE: ";
        echo "<br>";
        echo $body;
    }
        
    ?><hr>
<br>
    <a href="consultaMensajes.php"> Volver a mensajes</a>
<?php
    }
    
}else{
    header('Location:index.php');
}
?>

