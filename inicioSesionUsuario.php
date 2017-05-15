<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo']) == 1) {
    
?>
<form action="" method="POST">
    Nombre usuario - Nombre, Apellido
    <select name="usuario">
        <?php
        $ranking = usuarios();
        
        while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
        echo "<option value=$username> $username - $name, $surname</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" name="ver" value="ver">
</form>
<?php

if(isset($_POST['ver'])){
    $nombre_usuario = $_POST['usuario'];
    
    echo '<hr>';
    echo "ÚLTIMO INICIO SESIÓN DE $nombre_usuario<br>";
    $ranking = infoIS($nombre_usuario);        
    while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    echo $date;
    }
}
}else{
    header('Location:index.php');
}
?>
