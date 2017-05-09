<?php
session_start();
require_once 'bbdd_mail.php';

if($_SESSION["tipo"] == 1){

if(!isset($_POST['eliminar'])){
    ?>
    
<form action="" method="POST">
    
    Nombre usuario - Apellido, Nombre
    <select name="usuario">
        <?php
        $ranking = consultarUsuarios();
    
    while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
        /* Siempre después de extract las variables se llaman como en la bbdd
         */
        
        echo "<option value='$username'>$username - $name , $surname </option>";
    }
        ?>
    </select>
    <input type="submit" name="eliminar" value="eliminar"/>
</form>

    <?php
}else{
    $nombre_u = $_POST['usuario'];
    
    //echo $nu."<br>".$pass."<br>".$nombre."<br>".$ape;
    eliminarUsuario($nombre_u);    
}

    
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}

?>

