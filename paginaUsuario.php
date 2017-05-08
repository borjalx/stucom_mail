<?php
session_start();
require_once 'bbdd_mail.php';

$nombre_u = $_SESSION['user'];
$apellido = $_SESSION['apellido'];
$nombre = $_SESSION['nombre'];
/*
echo "Nombre de usuario = ".$nombre_u."<br>";
echo "Apellido = ".$apellido."<br>";
echo "Nombre = ".$nombre."<br>";
 */
?>

<a href="cambiarpass.php"> Cambiar contraseña</a>
<hr>
<a href="enviarMensaje.php"> Enviar mensaje </a>
<hr>
<a href="consultaMensajes.php"> Consultar mensajes </a>
<hr>
<a href="consultarEnviados.php"> Mensajes enviados </a>