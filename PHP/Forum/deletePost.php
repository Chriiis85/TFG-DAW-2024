<?php
// RECOGER EL ID DEL POST PARA ELIMINAR EL POST EXACTO
$id_post = $_POST["id_post"];

// INCLUIR LA CONEXION A LA BASE DE DATOS
include "conexion.php";

//SE REALIZA LA ELIMINACION DEL POST CON TRANSACCIONES PARA EVITAR FALLOS DURANTE LA ELIMINACION DE LA MISMA Y PODER SER REVERTIDOS EN CASO DE ERROR
try {
    //INICIAR LA TRANSACCION
    mysqli_begin_transaction($con);

    // CONSULTA A EJECUTAR
    $consulta = "DELETE FROM posts WHERE id=?";

    // INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    // PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        // ENLAZAR LOS PARÁMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_post);

        // EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        // VERIFICAR SI LA FILA HA SIDO ELIMINADA MEDIANTE LA FUNCIÓN QUE DETECTA SI SE HA AFECTADO/CAMBIADO ALGUNA FILA EN LA BD DE LA CONEXIÓN
        if (mysqli_affected_rows($con) > 0) {
            // CONFIRMAR LA TRANSACCIÓN
            mysqli_commit($con);
            echo 1; // SE ELIMINÓ CORRECTAMENTE
        } else {
            //REVERTIR LA TRANSACCION MEDIANTE ROLLBACK EN CASO DE ERROR
            mysqli_rollback($con);
            echo 2; // NO SE PUDO ELIMINAR
        }

        // CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);
    } else {
        //SI LA CONSULTA FALLA MOSTRAMOS UN MENSAJE DE ERROR
        echo "Error: No se pudo preparar la consulta. ERROR:".mysqli_error($con);
        // REVERTIR LA TRANSACCIÓN EN CASO DE ERROR
        mysqli_rollback($con);
    }
} catch (Exception $e) {
    //MANEJO DE LOS ERRORES MEDIANTE EXCEPCIONES
    echo "Error: " . $e->getMessage();
    //REVERTIR LA TRANSACCIÓN EN CASO DE FALLO
    mysqli_rollback($con);
}

//CERRAR LA CONEXION
mysqli_close($con);
?>