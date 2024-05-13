<?php
error_reporting(0);

$filterType = $_POST["filter"];

$themes = returnThemesByDate();

if ($filterType == "Newest") {
    //echo "Se filtra por newest";
    $themes = returnThemesByDate();
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }
    echo json_encode($themes);
} else if ($filterType == "Default") {
    //echo "Se filtra por Default";
    $themes = returnThemesByDefault();
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }
    echo json_encode($themes);
} else if ($filterType == "Popularity") {
    echo "Se filtra por Popularity";
} else if ($filterType == "Views") {
    
    $themes = returnThemesByDefault();
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }

    function compararPorCuartaColumna($a, $b) {
        // Comparar la cuarta columna ($themes[$i][4])
        if ($a[4] == $b[4]) {
            return 0;
        }
        return ($a[4] < $b[4]) ? -1 : 1;
    }
    
    // Ordenar el array utilizando la función de comparación
    usort($themes, 'compararPorCuartaColumna');
    $themes = array_reverse($themes);

    echo json_encode($themes);
}

function returnThemesByDefault()
{
    include "conexion.php";
    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT * FROM themes";

    //EJECUTAMOS LA CONSULTA
    $result = mysqli_query($con, $consulta);

    // Obtener todos los resultados
    $themes = mysqli_fetch_all($result);
    //$equipos = mysqli_fetch_row($result);
    //$equipos = mysqli_fetch_assoc($result);
    //print_r($themes);
    return $themes;
}

function returnThemesByDate()
{
    include "conexion.php";
    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT * FROM `themes` ORDER BY date DESC;";

    //EJECUTAMOS LA CONSULTA
    $result = mysqli_query($con, $consulta);

    // Obtener todos los resultados
    $themes = mysqli_fetch_all($result);

    return $themes;
}

function returnThemesByPopularity()
{

}

function returnNombreUsu($id_usu)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT username FROM users WHERE id = ?";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_usu);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EL RESULTADO
        mysqli_stmt_bind_result($stmt, $nombre_usuario);
        mysqli_stmt_fetch($stmt);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NOMBRE DE USUARIO
        return $nombre_usuario;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

function returnNumberPosts($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ?";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme); // Cambiar $id_usu a $id_theme

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EL RESULTADO
        mysqli_stmt_store_result($stmt); // Almacenar el resultado para contar filas
        $num_rows = mysqli_stmt_num_rows($stmt); // Obtener el número de filas

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NÚMERO DE FILAS
        return $num_rows;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

function returnLastPost($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date DESC LIMIT 1";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EL RESULTADO
        mysqli_stmt_store_result($stmt); // Almacenar el resultado para contar filas

        // Si hay resultados
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Enlazar las columnas del resultado
            mysqli_stmt_bind_result($stmt, $id_post, $contenido, $date, $id_user, $id_theme);

            // Obtener el último post
            mysqli_stmt_fetch($stmt);

            // Almacenar el último post en un array asociativo
            $last_post = array(
                "id_post" => $id_post,
                "contenido" => $contenido,
                "date" => $date,
                "id_user" => $id_user,
                "id_theme" => $id_theme
            );

            //CERRAR EL STATEMENT
            mysqli_stmt_close($stmt);

            //DEVOLVER EL ÚLTIMO POST
            return $last_post['contenido'];
        } else {
            // Si no hay resultados
            return "No se encontraron posts para este tema";
        }
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

?>