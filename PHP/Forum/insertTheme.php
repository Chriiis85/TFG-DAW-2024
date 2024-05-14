<?php
$nombre = $_POST["name"];
$id_usuario = 1; // Esto puede ser el ID del usuario que esté creando el tema

include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "INSERT INTO themes(titulo_tema, id_usuario) VALUES (?, ?)";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {
    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "si", $nombre, $id_usuario);

    //EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    // Verificar si se insertó correctamente una fila
    if (mysqli_affected_rows($con) > 0) {
        echo 1; // Indicar que se insertó correctamente
    } else {
        echo 2; // Indicar que no se pudo insertar
    }

    //CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);
} else {
    // Manejo de errores si la preparación de la consulta falla
    echo "Error: No se pudo preparar la consulta";
}

// Cerrar la conexión
mysqli_close($con);
?>
