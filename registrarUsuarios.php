<?php
session_start();
require_once 'bbdd_mail.php';

if($_SESSION["tipo"] == 1){

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
    Tipo usuario
    <select name="tipo">
        <option value="0"> Usuario </option>
        <option value="1"> Admin </option>
    </select>
    <input type="submit" name="crear" value="crear"/>
</form>

    <?php
}else{
    $nu = $_POST['n_u'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $ape = $_POST['apellido'];
    $tipo = $_POST['tipo'];
    
    //echo $nu."<br>".$pass."<br>".$nombre."<br>".$ape;
    if (existeUsuario($nu) == true ) {
        echo "<p>Ya existe ese nombre de usuario en la bbdd</p>";
        echo '<a href="index.php"> Volver al índice </a>';
    }else {
        
        $passcif = password_hash($pass, PASSWORD_DEFAULT);
        
        
        if($tipo == 0){
            crearUsuario($nu, $passcif, $nombre, $ape);
        }else if($tipo == 1){
            crearAdministrador($nu, $passcif, $nombre, $ape);
        }
    }
    
    
}

    
}else{
    echo "No eres administrador. Lo siento, no puedes entrar";
    
}

?>

