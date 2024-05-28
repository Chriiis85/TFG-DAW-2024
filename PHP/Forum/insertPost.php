<?php
//CONTENIDO DEL POST NUEVO QUE SE VA A CREAR
$content = $_POST["content"];

//NOMBRE DE USUARIO QUE VA A INSERTAR EL POST
$username = $_POST["username"];

//ID DEL TEMA EN EL QUE SE VA A INSERTAR EL POST
$id_theme = $_POST["id_theme"];

//INCLUIR LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "INSERT INTO posts(contenido, id_usuario, id_theme) VALUES (?, ?,?)";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//RECOGER EL ID USUARIO POR MEDIO DE LA FUNCION QUE LO DEVUELVE POR MEDIO DEL USERNAME
$id_usuario = returnIdUsu($username);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {
    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "sis", $content, $id_usuario, $id_theme);

    //EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    //VERIFICAR SI HAN HABIDO CAMBIOS(SE HA INSERTADO ALGUN REGISTRO EN ESTE CASO MODIFICADO) PARA MOSTRAR EL MENSAJE DE ERROR O CONFIRMACION
    if (mysqli_affected_rows($con) > 0) {
        echo 1; //EL POST SE INSERTO CORRECTAMENTE
    } else {
        echo 2; //NO SE PUDO CREAR EL NUEVO POST
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