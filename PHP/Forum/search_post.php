<?php
// Recibimos los datos del formulario desde el AJAX
$letra = $_POST['letra'];

// Verificar si los datos son correctos en la BBDD
include "conexion.php";
include "returnPosts.php";
//Probar la conexión
if (!$con->connect_error) {
    $consulta = "SELECT * FROM posts WHERE contenido LIKE '%" . $letra . "%'";
    $result = mysqli_query($con, $consulta);

    //Verificamos si se ejecuta bien la consulta.
    if ($result) {
        // Obtener todos los resultados
        $posts = mysqli_fetch_all($result);
        // Devolver los resultados en formato JSON
        /*for ($i = 0; $i < sizeof($themes); $i++) {
            $themes[$i][3] = returnNombreUsu($themes[$i][3]);
            $themes[$i][4] = returnNumberPosts($themes[$i][0]);
            $themes[$i][5] = returnLastPost($themes[$i][0]);
        }*/
        echo json_encode($posts);
    } else {
        echo "Error en la consulta: " . mysqli_error($con);
    }

    // Cerrar la conexión
    mysqli_close($con);
} else {
    die("Error de conexión: " . mysqli_connect_error());
}
?>