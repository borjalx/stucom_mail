<?php
session_start();
require_once 'bbdd_mail.php';

if($_SESSION["tipo"] == 1){
?>
<a href="usuariosSistema.php"> Usuarios del sistema</a>
<hr>
<a href="registrarUsuarios.php"> Registrar usuarios</a>
<hr>
<a href="eliminarUsuario.php"> Eliminar usuario</a>
<hr>
<a href="todosMensajes.php"> Lista de todos los mensajes</a>
<hr>
<a href="inicioSesionUsuario.php"> Fecha-hora del inicio de sesión de un usuario</a>
<hr>
<a href="rankingMensajesEnviados.php"> Ranking de mensajes enviados</a>
<hr>
<a href="paginaUsuario.php"> Ir página usuario </a>
<hr>
<?php
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}

?>

