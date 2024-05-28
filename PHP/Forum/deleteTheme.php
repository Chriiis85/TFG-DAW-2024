<?php

//RECOGER EL ID DEL TEMA PARA ELIMINAR EL TEMA EXACTO
$id_theme = $_POST["id_theme"];

//INCLUIR LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//SE REALIZA LA ELIMINACION DEL TEMA CON TRANSACCIONES PARA EVITAR FALLOS DURANTE LA ELIMINACION DE LA MISMA Y PODER SER REVERTIDOS EN CASO DE ERROR
try {
    //INICIAR LA TRANSACCION
    mysqli_begin_transaction($con);

    //CONSULTA QUE ELIMINA LOS POST DEL TEMA POR SI ACASO, YA QUE EN LA TABLA DE LA BD SE INCLUYE ELMINIACION EN CASCADA EN LA CLAVE ID_THEME
    $consultaPosts = "DELETE FROM posts WHERE id_theme = ?";

    //INICIAMOS EL STATEMENT
    $stmtPosts = mysqli_stmt_init($con);

    //SI SE PREPARA BIEN LA CONSULTA
    if (mysqli_stmt_prepare($stmtPosts, $consultaPosts)) {
        //ENLAZAMOS LOS PARAMETROS
        mysqli_stmt_bind_param($stmtPosts, "i", $id_theme);
        //EJECUTAR LA CONSULTA
        mysqli_stmt_execute($stmtPosts);
        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmtPosts);
    } else {
        //LANZAR LA EXCEPCION PARA CONTROLAR POSIBLES ERRORES
        throw new Exception("Error: No se pudo preparar la consulta para eliminar los posts relacionados con el tema ERROR:".mysqli_error($con));
    }

    //CONSULTA PARA ELIMINAR EL TEMA
    $consultaThemes = "DELETE FROM themes WHERE id = ?";

    //INICIAMOS EL STATEMENT
    $stmtThemes = mysqli_stmt_init($con);

    //SI SE PREPARA BIEN LA CONSULTA
    if (mysqli_stmt_prepare($stmtThemes, $consultaThemes)) {
        mysqli_stmt_bind_param($stmtThemes, "i", $id_theme);
        mysqli_stmt_execute($stmtThemes);

        // VERIFICAR SI LA FILA HA SIDO INSERTADO MEDIANTE LA FUNCION QUE DETECTA SI SE HA AFECTADO/CAMBIADO ALGUNA FILA EN LA BD DE LA CONEXION
        if (mysqli_affected_rows($con) > 0) {
            echo 1; //SE INSERTA CORRECTAMENTE
        } else {
            echo 2; //NO SE PUEDE INSERTAR
        }

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmtThemes);
    } else {
        //LANZAR LA EXCEPCION PARA CONTROLAR POSIBLES ERRORES
        throw new Exception("Error: No se pudo preparar la consulta para eliminar el tema. ERROR:".mysqli_error($con));
    }

    //CONFIRMAR LA TRANSACCION EN CASO DE QUE HAYA IDO TODO BIEN
    mysqli_commit($con);

} catch (Exception $e) {
    //SI SE DETECTA UN ERROR MEDIANTE ROLLBACK CANCELAREMOS LA TRANSACCION
    mysqli_rollback($con);

    //MOSTRAR POR PANTALLA EL MENSAJE DE ERROR DE LA EXCEPCION
    echo "Error: " . $e->getMessage();
}

//CERRAR LA CONEXION
mysqli_close($con);
?>