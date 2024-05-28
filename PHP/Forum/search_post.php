<?php
//RECOGEMOS DEL INPUT LAS LETRAS O CADENA
$letra = $_POST['letra'];

//OBTENEMOS EL ID DEL TEMA EN EL QUE ESTA EL POST
$id_theme = $_POST['id_theme'];

//INCLUIR EL ARCHIVODE LA CONEXION
include "conexion.php";

//INCLUIR EL ARCHIVO QUE DEVUELVE LOS POSTS PARA VOLVER A PINTARLOS
include "returnPosts.php";

//PROBAR LA CONEXION
if (!$con->connect_error) {
    //CONSULTA QUE VAMOS A REALIZAR, BUSCAR POSTS QUE CONTENGAN EL STRING QUE NOS LLEGA DEL INPUT
    $consulta = "SELECT * FROM posts WHERE contenido LIKE ? AND id_theme = ?";

    //PREPARAR LA CONSULTA
    $stmt = $con->prepare($consulta);

    //AÑADIR POR PARAMETRO EL FILTRADO QUE SE VA A BUSCAR
    $like_letra = "%" . $letra . "%";

    //ENLAZAR LOS PARAMETROS
    $stmt->bind_param("si", $like_letra, $id_theme);

    //VERIFICAR SI SE EJECUTA BIEN LA CONSULTA
    if ($stmt->execute()) {
        //OBTENER LOS RESULTADOS
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_NUM);

        //AÑADIR EL INDICE QUE RETORNA DE LA FUNCION EL NOMBRE DEL USUARIO
        for ($i = 0; $i < sizeof($posts); $i++) {
            $posts[$i][3] = returnNombreUsu($posts[$i][3]);
        }

        //DECODIFICAR Y DEVOLVER EL ARRAY EN FORMATO JSON
        echo json_encode($posts);
    } else {
        //MOSTRAR MANEJO DE ERRORES
        echo "Error en la consulta: " . $stmt->error;
    }

    //CERRAR LA CONEXION Y EL STATEMENT
    $stmt->close();
    mysqli_close($con);
} else {
    //MOSRTRAR ERRORES EN CASO DE QUE FALLE LA CONEXION
    die("Error de conexión: " . mysqli_connect_error());
}