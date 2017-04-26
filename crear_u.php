<?php
require_once 'bbdd_mail.php';

if(!isset($_POST['crear'])){
    ?>
    
<form action="" method="POST">
    
    Nombre de usuario <input type="text" name="n_u"/>
    <br>
    Contraseña <input type="password" name="pass"/>
    <br>
    Nombre (real no fake) <input type="text" name="nombre"/>
    <br>
    Apellido <input type="text" name="apellido"/>
    <br>
    <input type="submit" name="crear" value="crear"/>
</form>

    <?php
}else{
    $nu = $_POST['n_u'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $ape = $_POST['apellido'];
    
    //echo $nu."<br>".$pass."<br>".$nombre."<br>".$ape;
    if (existeUsuario($nu) == true ) {
        echo "<p>Ya existe ese nombre de usuario en la bbdd</p>";
        echo '<a href="index.php"> Volver al índice </a>';
    }else {
        
        $passcif = password_hash($pass, PASSWORD_DEFAULT);
        
        crearUsuario($nu, $passcif, $nombre, $ape);
    }
    
    
}

?>




