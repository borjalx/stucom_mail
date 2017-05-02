<?php
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo'])) {
if(isset($_POST['enviar'])){
    $emisor = $_SESSION['user'];
    $receptor = $_POST['receptor'];
    $asunto = $_POST['as'];
    $mensaje = $_POST['mens'];
    $date = getdate();
    $fecha = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
    
    registrar_redaccionM($emisor, $fecha);
    enviarMensaje($emisor, $receptor, $fecha, $asunto, $mensaje);
}else{
    ?>
<form action="" method="POST">
    Receptor
    <select name="receptor">
        <?php
        $usuarios = listadoUsuarios();
        while($fila = mysqli_fetch_array($usuarios)){
            extract($fila);
            echo "<option value='$username'>$username </option>";
        }
        ?>
    </select>
    <br>
    Asunto <input type="text" name="as"><br>
    Mensaje<br>
    <textarea name="mens" rows="10" cols="40">Escribe aquí tu mensaje</textarea>
    <br>
    <input type="submit" name="enviar" value="enviar"/>
</form>
<?php
 }
}else {
    header('Location:index.php');
}
?>
