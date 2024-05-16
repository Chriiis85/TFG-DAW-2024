<?php
error_reporting(0);

$filterType = $_POST["filter"];
$id_theme2 = $_POST["id_theme"];


if($filterType=="Default"){
    //echo "Default";
    $posts = returnPostsDefault($id_theme2);
    for ($i = 0; $i < sizeof($posts); $i++) {
    $posts[$i][3] = returnNombreUsu($posts[$i][3]);
    }
    echo json_encode($posts);
}else if($filterType=="Newest"){
    //echo "Newest";
    $posts = returnPostsDate($id_theme2);
    for ($i = 0; $i < sizeof($posts); $i++) {
        $posts[$i][3] = returnNombreUsu($posts[$i][3]);
        }
    echo json_encode($posts);
}
else if($filterType=="Oldest"){
    //echo "Newest";
    $posts = returnPostsDateReverse($id_theme2);
    for ($i = 0; $i < sizeof($posts); $i++) {
        $posts[$i][3] = returnNombreUsu($posts[$i][3]);
        }
    echo json_encode($posts);
}
function returnPostsDefault($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ?";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NOMBRE DE USUARIO
        return $posts;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

function returnPostsDate($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date DESC";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NOMBRE DE USUARIO
        return $posts;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

function returnPostsDateReverse($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date ASC";
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NOMBRE DE USUARIO
        return $posts;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
}

function returnThemeName($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT titulo_tema FROM themes WHERE id = ?";
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
        mysqli_stmt_bind_result($stmt, $theme_name);
        mysqli_stmt_fetch($stmt);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NOMBRE DE USUARIO
        return $theme_name;
    } else {
        // Manejo de errores si la preparación de la consulta falla
        return "Error: No se pudo preparar la consulta";
    }
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

?>