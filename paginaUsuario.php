<?php
session_start();
require_once 'bbdd_mail.php';

$nombre_u = $_SESSION['user'];
$apellido = $_SESSION['apellido'];
$nombre = $_SESSION['nombre'];

echo "Nombre de usuario = ".$nombre_u."<br>";
echo "Apellido = ".$apellido."<br>";
echo "Nombre = ".$nombre."<br>";
?>

