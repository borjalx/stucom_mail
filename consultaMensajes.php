<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo'])) {
    $nombre_u = $_SESSION['user'];
    
    $date = getdate();
    $fecha = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
    registrar_consultaM($nombre_u, $fecha);
    if(!isset($_POST['leer'])){
?>

<table>
<tr>
<th>Emisor</th> <th>Fecha/hora</th> <th>Asunto</th> <th>Leído?</th><br>
</tr>
    <?php
    $ranking = mostrarMensajes($nombre_u);
    
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
        echo "<td>$sender</td> <td>$date</td> <td>$subject</td> <td>$leido</td>";
        echo "</tr>";
    }
    ?>
</table>
<form>
    
</form>

<?php
    }else{
        
    }
    
}else{
    header('Location:index.php');
}
?>

