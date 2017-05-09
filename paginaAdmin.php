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

<?php
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}

?>

