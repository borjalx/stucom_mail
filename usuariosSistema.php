<?php
session_start();
require_once 'bbdd_mail.php';

if($_SESSION["tipo"] == 1){
    

?>
<table>
<tr>
    <th>Nombre de usuario</th> <th>Nombre</th> <th>Apellido</th> <th>Tipo</th><br>
</tr>
    <?php
    
    $ranking = consultarUsuarios();
    
    while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
        /* Siempre después de extract las variables se llaman como en la bbdd
         */
        if($type == 1){
            $tipo = "Administrador";
        }else{
            $tipo = "Usuario";
        }
        echo "<tr>";
        echo "<td>$username</td> <td>$name</td> <td>$surname</td> <td>$tipo</td>";
        echo "</tr>";
    }
    ?>
</table>


<?php
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}

?>


