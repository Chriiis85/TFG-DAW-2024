<?php
$nombre = $_POST["name"];
$username = $_POST["username"];

function returnIdUsu($id_nombre) {
    // CONSULTA A EJECUTAR
    $consulta = "SELECT id FROM users WHERE username = ?";
    include "conexion.php";

    // VERIFICAR LA CONEXIÓN
    if (!$con) {
        return "Error: No se pudo conectar a la base de datos";
    }

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
        return "Error: No se pudo preparar la consulta";
    }
}

include "conexion.php";

//CONSULTA A EJECUTAR
$consulta = "INSERT INTO themes(titulo_tema, id_usuario) VALUES (?, ?)";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);
$id_usuario = returnIdUsu($username);
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
