<?php
//OMITIR LOS ERRORES PARA LAS PRUEBAS
error_reporting(0);

//RECOGEMOS EL TIPO DE FILTRO PARA DEFINIR POR QUE SE FILTRAN Y MUESTRAN LOS TEMAS
$filterType = $_POST["filter"];

//DEPENDIENDO DEL STRING CON EL FILTRADO ESCOGIDO EN LA LISTA SE APLICARÁ UN FILTRO U OTRO
if ($filterType == "Oldest") {
    //SE FILTRAN LOS TEMAS POR LOS MAS VIEJOS
    //echo "Se filtra por newest";

    //RECOGER EL ARRAY DEVUELTO EN LA FUNCION Y GUARDARLO
    $themes = returnThemesByDateOldest();

    //RECORRER EL ARRAY Y AÑADIR INDICES CON EL NOMBRE DEL USUARIO, EL NUMERO DE POSTS Y EL ULTIMO POST DEL TEMA
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }

    //CODIFICAR EN UN JSON PARA POSTERIORMENTE VERLO MEJOR A LA HORA DE MOSTRAR EN JS
    echo json_encode($themes);

} else if ($filterType == "Newest") {
    //SE FILTRAN LOS TEMAS POR LOS MAS NUEVOS
    //echo "Se filtra por newest";

    //RECOGER EL ARRAY DEVUELTO EN LA FUNCION Y GUARDARLO
    $themes = returnThemesByDate();

    //RECORRER EL ARRAY Y AÑADIR INDICES CON EL NOMBRE DEL USUARIO, EL NUMERO DE POSTS Y EL ULTIMO POST DEL TEMA
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }

    //CODIFICAR EN UN JSON PARA POSTERIORMENTE VERLO MEJOR A LA HORA DE MOSTRAR EN JS
    echo json_encode($themes);

} else if ($filterType == "Default") {
    //SE FILTRAN LOS TEMAS POR DEFECTO
    //echo "Se filtra por Default";

    //RECOGER EL ARRAY DEVUELTO EN LA FUNCION Y GUARDARLO
    $themes = returnThemesByDefault();

    //RECORRER EL ARRAY Y AÑADIR INDICES CON EL NOMBRE DEL USUARIO, EL NUMERO DE POSTS Y EL ULTIMO POST DEL TEMA 
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }

    //CODIFICAR EN UN JSON PARA POSTERIORMENTE VERLO MEJOR A LA HORA DE MOSTRAR EN JS
    echo json_encode($themes);

} else if ($filterType == "Popularity") {
    //SE FILTRAN LOS TEMAS POR DEFECTO
    $themes = returnThemesByDefault();

    //RECORRER EL ARRAY Y AÑADIR INDICES CON EL NOMBRE DEL USUARIO, EL NUMERO DE POSTS Y EL ULTIMO POST DEL TEMA
    for ($i = 0; $i < sizeof($themes); $i++) {
        $themes[$i][3] = returnNombreUsu($themes[$i][3]);
        $themes[$i][4] = returnNumberPosts($themes[$i][0]);
        $themes[$i][5] = returnLastPost($themes[$i][0]);
    }

    //FUNCION QUE COMPARA POR LA CUARTA COLUMNA DEL ARRAY ES DECIR POR EL NUMERO DE POST PARA ODERNAR LOS TEMAS MEDIANTE LOS MAS POPULARES
    //ES DECIR LOS TEMAS QUE MAS POSTS TENGAN IRAN ARRIBA
    function compararPorCuartaColumna($a, $b)
    {
        //COMPARAR POR LA CUARTA COLUMNA ($themes[$i][4])
        if ($a[4] == $b[4]) {
            return 0;
        }
        //DEVOLVER LA COLUMNA ORDENADA
        return ($a[4] < $b[4]) ? -1 : 1;
    }

    //ORDENAR EL ARRAY CON LA FUNCION COMPARANDO POR LA CUARTA COLUMNA
    usort($themes, 'compararPorCuartaColumna');

    //DAR LA VUELTA AL ARRAY YA QUE VIENE ORDENADO AL REVES
    $themes = array_reverse($themes);

    //CODIFICAR EN UN JSON PARA POSTERIORMENTE VERLO MEJOR A LA HORA DE MOSTRAR EN JS
    echo json_encode($themes);
}

//FUNCION QUE DEVUELVE LOS TEMAS POR DEFECTO
function returnThemesByDefault()
{
    //INCLUIR EL ARCHIVO DE LA CONEXION A LA BASE DE DATOS
    include "conexion.php";

    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT * FROM themes";

    //EJECUTAMOS LA CONSULTA
    $result = mysqli_query($con, $consulta);

    //OBTENER LOS RESULTADOS
    $themes = mysqli_fetch_all($result);

    //DEVOLVER EL ARRAY DEL RESULTADO(TEMAS DEVUELTOS DEL SELECT)
    return $themes;
}

//FUNCION QUE DEVUELVE LOS TEMAS POR FECHA(MAS NUEVOS)
function returnThemesByDate()
{
    //INCLUIR EL ARCHIVO DE LA CONEXION A LA BASE DE DATOS
    include "conexion.php";

    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT * FROM `themes` ORDER BY date DESC;";

    //EJECUTAMOS LA CONSULTA
    $result = mysqli_query($con, $consulta);

    //OBTENER LOS RESULTADOS(TEMAS)
    $themes = mysqli_fetch_all($result);

    //DEVOLVER EL ARRAY DEL RESULTADO(TEMAS DEVUELTOS DEL SELECT)
    return $themes;
}

//FUNCION QUE DEVUELVE LOS TEMAS POR FECHA AL REVES(MAS VIEJOS)
function returnThemesByDateOldest()
{
    //INCLUIR EL ARCHIVO DE LA CONEXION A LA BASE DE DATOS
    include "conexion.php";
    // CONSULTA QUE VAMOS A REALIZAR
    $consulta = "SELECT * FROM `themes` ORDER BY date ASC;";

    //EJECUTAMOS LA CONSULTA
    $result = mysqli_query($con, $consulta);

    // Obtener todos los resultados
    $themes = mysqli_fetch_all($result);

    //DEVOLVER EL ARRAY DEL RESULTADO(TEMAS DEVUELTOS DEL SELECT)
    return $themes;
}

//FUNCION QUE DEVUELVE EL NOMBRE DEL CREADOR DEL TEMA
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
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//FUNCION QUE DEVUELVE EL NUMERO DE POSTS EXISTENTES PARA UN TEMA PARA ORDENAR Y MOSTRAR EN LA PAGINA
function returnNumberPosts($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ?";

    //INCLUIR EL ARCHIVO DE LA CONEXION
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
        mysqli_stmt_store_result($stmt);

        //OBTENER EL NUMERO DE FILAS DEVUELTAS
        $num_rows = mysqli_stmt_num_rows($stmt);

        //CERRAR EL STATEMENT
        mysqli_stmt_close($stmt);

        //DEVOLVER EL NÚMERO DE FILAS(NUMERO DE POSTS PARA CADA TEMA)
        return $num_rows;
    } else {
        //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

//FUNCION QUE DEVUELVE EL ULTIMO TEMA PARA CADA POST
function returnLastPost($id_theme)
{
    //CONSULTA A EJECUTAR
    $consulta = "SELECT * FROM posts WHERE id_theme = ? ORDER BY date DESC LIMIT 1";

    //INLCUIR EL ARCHIVO DE LA CONEXION
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
        mysqli_stmt_store_result($stmt);

        //SI COMPROBAMOS QUE HAY RESULTADOS
        if (mysqli_stmt_num_rows($stmt) > 0) {
            
            //ENLAZAMOS LOS PARAMETROS
            mysqli_stmt_bind_result($stmt, $id_post, $contenido, $date, $id_user, $id_theme);

            //OBTNEEMOS LA FILA DEVUELTA
            mysqli_stmt_fetch($stmt);

            //CREAMOS UN ARRAY PARA EL ULTIMO POST
            $last_post = array(
                "id_post" => $id_post,
                "contenido" => $contenido,
                "date" => $date,
                "id_user" => $id_user,
                "id_theme" => $id_theme
            );

            //CERRAR EL STATEMENT
            mysqli_stmt_close($stmt);

            //DEVOLVER EL CONTENIDO A MOSTRAR DEL ÚLTIMO POST
            return $last_post['contenido'];
        } else {
            //SI NO SE ENCUENTRAN SE MUESTRA QUE NO HAY POSTS EN EL TEMA
            return "There are no posts for this theme";
        }
    } else {
        //MANEJO DE ERRORES EN EL CASO DE QUE LA CONSULTA NO SE REALIZE CORRECTAMENTE
        echo "Error: No se pudo preparar la consulta. ERROR:" . mysqli_error($con);
    }
}

?>