<?php 
session_start();
require_once 'bbdd_mail.php';

if(isset($_POST['entrar'])){
    
    $n_u = $_POST['n_u'];
    $pass = $_POST['pass'];
    
    if(!verificarUsuario($n_u, $pass)){
        echo "Usuario o contraseña erronea!";
        echo '<a href="index.php"> Volver al índice </a>';
    }else{
        
        
        $date = getdate();
        
        $fecha = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
        
        registrar_inicioSesion($n_u, $fecha);
        if ($tipo != 0) {
            // Dirigimos al usuario a su homePage.
            header("Location: paginaAdmin.php");                     
        } else if ($tipo != 1) {
            // Dirigimos a la página de administrador
            header("Location: paginaUsuario.php"); 
        } else { // Aquí no debería entrar nunca
            echo "Tipo de usuario incorrecto";
        }
    }
    
    
    
}else{
    

?>
<form action="" method="POST">
    Nombre de usuario <input type="text" name="n_u">
    <br>
    Contraseña <input type="password" name="pass">
    <br>
    <input type="submit" name="entrar" value="entrar">
</form>
<?php 
}
?>