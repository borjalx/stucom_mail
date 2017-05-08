<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo'])) {
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
?>
<hr>
<table>
<tr>
    <th>Receptor</th> <th>Fecha/hora</th> <th>Asunto</th><br>
</tr>
    <?php
    $total = totalMensajesEnviados($nombre_u);
    $ranking = mensajesEnviados($nombre_u,$posicion,10);
    
    while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
        /* Siempre después de extract las variables se llaman como en la bbdd
         */

        echo "<tr>";
        echo "<td>$receiver</td><td>$date</td> <td>$subject</td> ";
        echo "</tr>";
    }
    ?>
</table>

<?php
if ($posicion >0) {
    echo "<a href='consultarEnviados.php?posicion=" . ($posicion - 5) . "'>&lt;&lt;</a>";
}
//Mostramos referencia a lo que mostramos
if ($posicion + 5 <= $total) {
    echo "Mostrando " . ($posicion + 1) . " al " . ($posicion + 5) . " de $total ";
} else {
    echo "Mostrando " . ($posicion + 1) . " al $total de $total";
}
// Comprobamos si hay más páginas (por delante)
if ($posicion + 5 < $total) {
    echo "<a href='consultarEnviados.php?posicion=" . ($posicion + 5) . "'>&gt;&gt;</a>";
}
    
        
    ?><hr>
<br>
<a href="paginaUsuario.php"> Volver</a>
<?php
    
    
}else{
    header('Location:index.php');
}
?>
