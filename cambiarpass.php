<?php
/*
  NO FUNCIONA CORRECTAMENTE A LA HORA DE COMPROBAR CUANDO SON ERRONEAS Y A LA HORA DE CAMBIARLAS
 *  */
session_start();
require_once 'bbdd_mail.php';
if (isset($_SESSION['tipo'])) {
    $nombre_u = $_SESSION['user'];

    if (isset($_POST['comprobar'])) {
        $contraseña = $_POST['pass11'];
        $conrtaseña2 = $_POST['pass12'];
        if ($contraseña == $conrtaseña2) {
            
            if (verificarUsuario($nombre_u, $contraseña) == true) {
                ?>
                <form action="" method="POST">
                    Nueva contraseña: <br><input type="password" name="pass21"><br>
                    Verificación contrseña: <br><input type="password" name="pass22"><br>
                    <input type="submit" name="cambiar" value="cambiar">
                </form>
                <?php
            } else {
                echo "Esta no es la contraseña";
            }
        } else {
            echo '<br>Fallo en verificación contraseñas<br>';
        }
    } else if (isset($_POST['cambiar'])) {
        $contraseña3 = $_POST['pass21'];
        $conrtaseña4 = $_POST['pass22'];
        if ($contraseña3 == $conrtaseña4) {
            echo $contraseña3;
            $passcif = password_hash($contraseña3, PASSWORD_DEFAULT);
            cambiarPass($nombre_u, $passcif);
        } else {
            echo 'Contraseña erronea';
        }
    } else {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
                <form action="" method="POST">
                    Contraseña actual: <br><input type="password" name="pass11"><br>
                    Verificación contrseña: <br><input type="password" name="pass12"><br>
                    <input type="submit" name="comprobar" value="comprobar">
                </form>
                <?php
            }
            ?>
        </body>
    </html>   
    <?php
} else {
    header('Location:index.php');
}
?>

