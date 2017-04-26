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
        mysqli_errno($con);
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
    $query = "select password from user where username='$nombre_usuario'";
    $resultado = mysqli_query($con, $query);
    $filas = mysqli_num_rows($resultado);
    
    $array = mysqli_fetch_array($resultado);
    
    desconectar($con);
    if ($filas > 0) {
        // Comprobamos que la contraseña es correcta
        $fila = mysqli_fetch_array($resultado);
        extract($fila);
//        if (password_verify($pass, $password)) {
//            return true;
//        } else {
//            return false;
//        }
        return password_verify($contraseña, $password);
    } else {    // Este else no hace falta
        return false;
    }

}
?>

