<?php
function conexion($database) {
    $conxn = mysqli_connect("localhost", "root", "", $database)
            or die("NO se ha podido conectar con la BBDD. MUERE!");
    return $conxn;
}
function desconectar($conectar) {
    mysqli_close($conectar);
}

function crearUsuario($nombre_usuario, $contraseña, $nombre, $apellido){
    $con = conexion("msg");
    $consulta = "insert into user values ('$nombre_usuario','$contraseña', '$nombre', '$apellido',0)";
    
    if(mysqli_query($con, $consulta)){
        echo "Usuario añadido correctamente";
        echo '<a href="index.php"> Volver al índice </a>';
    } else {
        echo 'Error!';
        mysqli_error($con);
    }
    
    desconectar($con);
}

function existeUsuario($nombre_usuario){
    $con = conexion("msg");
    $consulta = "select * from user where username = '$nombre_usuario'";
    $resultado = mysqli_query($con, $consulta);
    $rows = mysqli_num_rows($resultado);
    
    if($rows == 0){
        return false;
    }else{
        return true;
    }
    
}

function verificarUsuario($nombre_usuario, $contraseña){
    $con = conexion("msg");
    $query = "select * from user where username='$nombre_usuario'";
    $resultado = mysqli_query($con, $query);
    $filas = mysqli_num_rows($resultado);
    
    $array = mysqli_fetch_array($resultado);
    
    desconectar($con);
    if ($filas > 0) {

        //$fila = mysqli_fetch_array($resultado);
        $_SESSION["user"] = $array["username"];
        $_SESSION["apellido"] = $array["surname"];
        $_SESSION["nombre"] = $array["name"];
        $_SESSION["tipo"] = $array["type"];
        
        extract($array);
        //session_start();
        //$_SESSION["user"] = $n_u;        
        //echo $name;
        return password_verify($contraseña, $password);
    } else {    
        return false;
    }

}

function registrar_inicioSesion($nombre_usuario,$fecha){
    $con = conexion("msg");
    $consulta = "INSERT INTO event (`user`, `date`, `type`) VALUES ('$nombre_usuario', '$fecha', 'i')";
    
    if(mysqli_query($con, $consulta)){
        echo "Sesión iniciadas";
    } else {
        echo 'Error!';
        mysqli_error($con);
    }
    
    desconectar($con);
}

function registrar_redaccionM($nombre_usuario,$fecha){
    $con = conexion("msg");
    $consulta = "INSERT INTO event (`user`, `date`, `type`) VALUES ('$nombre_usuario', '$fecha', 'r')";
    
    if(mysqli_query($con, $consulta)){
        echo "Redacción de mensaje";
    } else {
        echo 'Error!';
        mysqli_error($con);
    }
    
    desconectar($con);
}

function cambiarPass($nombre_usuario,$contraseña){
    $con = conexion("msg");
    $consulta = "UPDATE user SET password='$contraseña' WHERE username='$nombre_usuario'";
    
    if (mysqli_query($con, $consulta)) {
        echo "Contraseña modificada";
        echo "<a href='paginaUsuario.php'>Volver al menú<a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function listadoUsuarios(){
    $con = conexion("msg");
    $query = "select username from user where username != 'admin' ";
    
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function enviarMensaje($emisor,$receptor,$fecha,$asunto,$mensaje){
    $con = conexion("msg");
    $consulta = "INSERT INTO message (sender,receiver,date,`read`,`subject`,body) VALUES ('$emisor', '$receptor', '$fecha', 0, '$asunto', '$mensaje')";
    if (mysqli_query($con, $consulta)) {
        echo "Mensaje enviado";
        echo "<a href='paginaUsuario.php'>Volver al menú<a>";
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}
?>

