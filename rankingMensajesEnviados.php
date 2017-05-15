<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo']) == 1) {
?>
<h2> RANKING DE MENSAJES ENVIADOS</h2>
<table>
<tr>
    <th>Número de mensajes enviados</th> <th>Nombre de usuario</th><br>
</tr>    
<?php
    $ranking = rankingMensajesEnviados();        
    while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    echo "<tr>";
    echo "<td> $n_enviados </td> <td> $sender </td>";
    echo "</tr>";
    }
    
}else{
    header('Location:index.php');
}
?>
