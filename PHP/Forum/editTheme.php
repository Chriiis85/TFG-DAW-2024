<?php
//RECOGER EL ID DE TEMA QUE SE VA A EDITAR
$id_theme = $_POST["id_theme"];

//NOMBRE DEL NUEVO TEMA QUE SE VA A EDITAR
$name = $_POST["name"];

//INCLUIR EL ARCHIVO QUE REALIZA LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "UPDATE `themes` SET `titulo_tema`= ? WHERE id = ?";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {
    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "si", $name,$id_theme);

    //EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    //VERIFICAR SI HAN HABIDO CAMBIOS(SE HA INSERTADO ALGUN REGISTRO EN ESTE CASO MODIFICADO) PARA MOSTRAR EL MENSAJE DE ERROR O CONFIRMACION
    if (mysqli_affected_rows($con) > 0) {
        echo 1; //EL TEMA SE MODIFICO CORRECTAMENTE
    } else {
        echo 2; //EL TEMA NO PUDO SER MODIFICADO
    }

    //CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);
} else {
    //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
    echo "Error: No se pudo preparar la consulta. ERROR:".mysqli_error($con);
}

//CERRAR LA CONEXION
mysqli_close($con);
?>