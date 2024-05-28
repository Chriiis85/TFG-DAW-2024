<?php
//RECOGER EL NOMBRE DEL NUEVO TEMA QUE SE VA A CREAR
$nombre = $_POST["name"];

//RECOGER EL NOMBRE DEL USUARIO QUE CREA EL NUEVO TEMA
$username = $_POST["username"];

//INCLUIR EL ARCHIVO DE LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "INSERT INTO themes(titulo_tema, id_usuario) VALUES (?, ?)";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//RECOGER EL ID DEL USUARIO POR MEDIO DEL NOMBRE DEL USUARIO QUE CREA EL TEMA
$id_usuario = returnIdUsu($username);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {
    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "si", $nombre, $id_usuario);

    //EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    //VERIFICAR SI HAN HABIDO CAMBIOS(SE HA INSERTADO ALGUN REGISTRO EN ESTE CASO MODIFICADO) PARA MOSTRAR EL MENSAJE DE ERROR O CONFIRMACION
    if (mysqli_affected_rows($con) > 0) {
        echo 1; //EL TEMA SE INSERTO CORRECTAMENTE
    } else {
        echo 2; //EL TEMA NO PUDO SER CREADO CORRECTAMENTE
    }

    //CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);
} else {
    //MANEJO DE ERRORES EN CASO DE QUE SALGA O SE DETECTE ALGUN ERROR
    echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
}

//FUNCION QUE RETORNA EL ID DE USUARIO MEDIANTE EL NOMBRE DEL USUARIO
function returnIdUsu($id_nombre)
{
    // CONSULTA A EJECUTAR
    $consulta = "SELECT id FROM users WHERE username = ?";

    //INCLUIR LA CONEXION A LA BASE DE DATOS
    include "conexion.php";

    // INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    // PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        // ENLAZAR LOS PARÁMETROS
        mysqli_stmt_bind_param($stmt, "s", $id_nombre);

        // EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        // OBTENER EL RESULTADO
        mysqli_stmt_bind_result($stmt, $id_usuario);
        mysqli_stmt_fetch($stmt);

        // CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        // DEVOLVER EL ID DEL USUARIO
        return $id_usuario;
    } else {
        // MANEJO DE ERRORES SI LA PREPARACIÓN DE LA CONSULTA FALLA
        return "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//CERRAR LA CONEXION
mysqli_close($con);
?>