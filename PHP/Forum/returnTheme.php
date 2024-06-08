<?php
    // INCLUIR EL ARCHIVO DE LA CONEXION A LA BASE DE DATOS
    include "conexion.php";

    // OBTENER EL ID DEL TEMA QUE SE VA A EDITAR
    $id_theme = $_POST["id_theme"];

    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT titulo_tema FROM themes WHERE id = ?";

    // PREPARAR LA CONSULTA
    if ($stmt = $con->prepare($consulta)) {
        // VINCULAR LOS PARÁMETROS
        $stmt->bind_param("i", $id_theme);

        // EJECUTAR LA CONSULTA
        $stmt->execute();

        // OBTENER EL RESULTADO
        $result = $stmt->get_result();

        // OBTENER LOS RESULTADOS COMO UN ARRAY
        $themes = $result->fetch_all(MYSQLI_ASSOC);

        // DEVOLVER EL ARRAY DEL RESULTADO EN FORMATO JSON
        echo json_encode($themes);

        // CERRAR LA DECLARACIÓN
        $stmt->close();
    } else {
        // EN CASO DE ERROR EN LA PREPARACIÓN DE LA CONSULTA
        echo json_encode(["error" => "Error en la preparación de la consulta".$con->error]);
    }

    // CERRAR LA CONEXIÓN A LA BASE DE DATOS
    $con->close();
?>
