<?php
session_start();
require_once 'bbdd_mail.php';

if($_SESSION["tipo"] == 1){
if (isset($_GET["posicion"])) {
    $posicion = $_GET["posicion"];
} else {
// Inicialmente la posición es 0, ya que aún no ha mostrado nada
    $posicion = 0;
}
?>

<table>
<tr>
    <th>Receptor</th> <th>Emisor</th> <th>Fecha/hora</th> <th>Asunto</th> <th>Leído?</th><br>
</tr>
    <?php
    $total = totalTodoMensaje();
    $ranking = todosMensajes($posicion, 15);
    
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
        echo "<td>$receiver</td> <td>$sender</td> <td>$date</td> <td>$subject</td> <td>$leido</td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
if ($posicion >0) {
    echo "<a href='consultarMensajes.php?posicion=" . ($posicion - 15) . "'>&lt;&lt;</a>";
}
//Mostramos referencia a lo que mostramos
if ($posicion + 15 <= $total) {
    echo "Mostrando " . ($posicion + 1) . " al " . ($posicion + 15) . " de $total ";
} else {
    echo "Mostrando " . ($posicion + 1) . " al $total de $total";
}
// Comprobamos si hay más páginas (por delante)
if ($posicion + 15 < $total) {
    echo "<a href='consultarMensajes.php?posicion=" . ($posicion + 15) . "'>&gt;&gt;</a>";
}
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}
?>