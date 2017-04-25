<?php 
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
    
    echo $nu.$pass.$nombre.$ape;
}

?>


