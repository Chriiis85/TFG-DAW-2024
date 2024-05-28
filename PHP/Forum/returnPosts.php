<?php
//OMITIR LOS ERRORES PARA LAS PRUEBAS
error_reporting(0);

//RECOGEMOS EL TIPO DE FILTRO PARA DEFINIR POR QUE SE FILTRAN Y MUESTRAN LOS POSTS
$filterType = $_POST["filter"];

//RECOGER EL ID DEL TEMA PARA FILTRAR, BUSCAR Y MOSTRAR LOS FILTROS DE DICHO TEMA POR SU ID
$id_theme2 = $_POST["id_theme"];

//DEPENDIENDO DEL STRING CON EL FILTRADO ESCOGIDO EN LA LISTA SE APLICARÁ UN FILTRO U OTRO
if ($filterType == "Default") {
    //FILTRO POR DEFECTO
    //echo "Default";

    //LLAMAMOS A LA FUNCION Y GUARDAMOS EN UN ARRAY
    $posts = returnPostsDefault($id_theme2);

    //RECOGEMOS EL NOMBRE DEL USUARIO PARA POSTERIORMENTE MOSTRARLO
    for ($i = 0; $i < sizeof($posts); $i++) {
        $posts[$i][3] = returnNombreUsu($posts[$i][3]);
    }

    //CODIFICAMOS EL ARRAY EN UN JSON PARA POSTERIORMENTE MOSTRARLO DINAMICAMENTE
    echo json_encode($posts);
} else if ($filterType == "Newest") {
    //FILTRO POR LOS POSTS MAS NUEVOS
    //echo "Newest";

    //LLAMAMOS A LA FUNCION Y GUARDAMOS EN UN ARRAY
    $posts = returnPostsDate($id_theme2);

    //RECOGEMOS EL NOMBRE DEL USUARIO PARA POSTERIORMENTE MOSTRARLO
    for ($i = 0; $i < sizeof($posts); $i++) {
        $posts[$i][3] = returnNombreUsu($posts[$i][3]);
    }

    //CODIFICAMOS EL ARRAY EN UN JSON PARA POSTERIORMENTE MOSTRARLO DINAMICAMENTE
    echo json_encode($posts);
} else if ($filterType == "Oldest") {
    //FILTRO POR LOS POSTS MAS VIEJOS
    //echo "Oldest";

    //LLAMAMOS A LA FUNCION Y GUARDAMOS EN UN ARRAY
    $posts = returnPostsDateReverse($id_theme2);

    //RECOGEMOS EL NOMBRE DEL USUARIO PARA POSTERIORMENTE MOSTRARLO
    for ($i = 0; $i < sizeof($posts); $i++) {
        $posts[$i][3] = returnNombreUsu($posts[$i][3]);
    }

    //CODIFICAMOS EL ARRAY EN UN JSON PARA POSTERIORMENTE MOSTRARLO DINAMICAMENTE
    echo json_encode($posts);
}

//FUNCION QUE NOS DEVUELVE LOS POSTS POR DEFECTO DE UN TEMA POR SU ID
function returnPostsDefault($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ?";

    //INCLUIR EL ARCHIVO QUE CONTIENE LA CONEXION
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EN UN ARRAY LOS POSTS
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO EN OTRO ARRAY
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EN UN ARRAY LOS POSTS
        return $posts;
    } else {
        //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//FUNCION QUE NOS DEVUELVE LOS POSTS POR LOS MAS NUEVOS PRIMERO DE UN TEMA POR SU ID
function returnPostsDate($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date DESC";

    //INCLUIR EL ARCHIVO QUE CONECTA LA BD
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EN UN ARRAY LOS POSTS
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO EN OTRO ARRAY
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL ARRAY PARA MOSTRARLO
        return $posts;
    } else {
        //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//FUNCION QUE NOS DEVUELVE LOS POSTS POR LOS MAS VIEJOS DE UN TEMA POR SU ID
function returnPostsDateReverse($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date ASC";

    //INCLUIR EL ARCHIVO DE LA CONEXION
    include "conexion.php";

    //INICIAR EL STATEMENT
    $stmt = mysqli_stmt_init($con);

    //PREPARAR LA CONSULTA
    if (mysqli_stmt_prepare($stmt, $consulta)) {
        //ENLAZAR LOS PARAMETROS
        mysqli_stmt_bind_param($stmt, "i", $id_theme);

        //EJECUTAR EL STATEMENT
        mysqli_stmt_execute($stmt);

        //OBTENER EN UN ARRAY LOS POSTS
        $result = mysqli_stmt_get_result($stmt);

        //OBTENER EL RESULTADO EN OTRO ARRAY
        $posts = mysqli_fetch_all($result);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL ARRAY DE LOS POSTS
        return $posts;
    } else {
        //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//DEVOLVER EL NOMBRE DEL TEMA MEDIANTE EL ID DEL TEMA
function returnThemeName($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT titulo_tema FROM themes WHERE id = ?";

    //INCLUIR EL ARCHIVO DE LA CONEXION
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

        //DEVOLVER EL NOMBRE DEL TEMA
        return $theme_name;
    } else {
    //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
    echo "Error: No se pudo preparar la consulta. ERROR:".mysqli_error($con);
    }
}

//DEVOLVER EL NOMBRE DEL USUARIO PARA PONERLO EN EL POST
function returnNombreUsu($id_usu)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT username FROM users WHERE id = ?";

    //INCLUIR EL ARCHIVO DE LA CONEXION
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
    //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
    echo "Error: No se pudo preparar la consulta. ERROR:".mysqli_error($con);
    }
}

//FUNCION QUE DEVUELVE EL ID DE UN USUARIO POR MEDIO DE SU USERNAME
function returnIdUsu($id_nombre)
{
  // CONSULTA A EJECUTAR
  $consulta = "SELECT id FROM users WHERE username = ?";

  //INCLUIR EL ARCHIVO QUE CONECTA LA BASE DE DATOS
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

?>