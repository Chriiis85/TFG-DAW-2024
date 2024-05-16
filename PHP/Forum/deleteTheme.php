<?php
$id_theme = $_POST["id_theme"];

include "conexion.php";

try {
    // Iniciar una transacción
    mysqli_begin_transaction($con);

    // Consulta para eliminar los posts relacionados con el tema
    $consultaPosts = "DELETE FROM posts WHERE id_theme = ?";
    $stmtPosts = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($stmtPosts, $consultaPosts)) {
        mysqli_stmt_bind_param($stmtPosts, "i", $id_theme);
        mysqli_stmt_execute($stmtPosts);
        mysqli_stmt_close($stmtPosts);
    } else {
        throw new Exception("Error: No se pudo preparar la consulta para eliminar los posts");
    }

    // Consulta para eliminar el tema
    $consultaThemes = "DELETE FROM themes WHERE id = ?";
    $stmtThemes = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($stmtThemes, $consultaThemes)) {
        mysqli_stmt_bind_param($stmtThemes, "i", $id_theme);
        mysqli_stmt_execute($stmtThemes);

        // Verificar si se eliminó correctamente el tema
        if (mysqli_affected_rows($con) > 0) {
            echo 1; // Indicar que se eliminó correctamente
        } else {
            echo 2; // Indicar que no se pudo eliminar
        }

        mysqli_stmt_close($stmtThemes);
    } else {
        throw new Exception("Error: No se pudo preparar la consulta para eliminar el tema");
    }

    // Confirmar la transacción
    mysqli_commit($con);
} catch (Exception $e) {
    // Si ocurre un error, revertir la transacción
    mysqli_rollback($con);
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
mysqli_close($con);
?>
