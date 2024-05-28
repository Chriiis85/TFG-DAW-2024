<?php
//RECOGER EL ID DEL POST QUE SE VA A EDITAR
$id_post = $_POST["id_post"];

//RECOGER EL CONTENIDO NUEVO QUE SE VA A EDITAR
$contenido= $_POST["content"];

//INCLUIR EL ARCHIVO QUE CONTIENE LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "UPDATE `posts` SET `contenido`= ? WHERE id = ?";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {
    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "si", $contenido,$id_post);

    //EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    //VERIFICARR SI HAN HABIDO CAMBIOS(SE HA INSERTADO ALGUN REGISTRO EN ESTE CASO MODIFICADO) PARA MOSTRAR EL MENSAJE DE ERROR O CONFIRMACION
    if (mysqli_affected_rows($con) > 0) {
        echo 1; //SE ACTUALIZO EL POST CORRECTAMENRE
    } else {
        echo 2; //NO SE ACTUALIZO EL POST CORRECTAMENTE
    }

    //CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);
} else {
    //MANEJOR DE ERROR EN EL CASO DE QUE LA CONSULTA O EN SUS PASOS ALGO FALLE
    echo "Error: No se pudo preparar la consulta. ERROR:".mysqli_error($con);
}

//CERRAR LA CONEXION
mysqli_close($con);
?>