<?php
// Recibimos los datos del formulario desde el AJAX
$letra = $_POST['letra'];
$id_theme = $_POST['id_theme'];

// Verificar si los datos son correctos en la BBDD
include "conexion.php";
include "returnPosts.php";
//Probar la conexión
if (!$con->connect_error) {
    $consulta = "SELECT * FROM posts WHERE contenido LIKE ? AND id_theme = ?";
    $stmt = $con->prepare($consulta);
    $like_letra = "%" . $letra . "%";
    $stmt->bind_param("si", $like_letra, $id_theme); // Assuming $id_theme is defined and is an integer

    // Verificamos si se ejecuta bien la consulta.
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        // Obtener todos los resultados
        $posts = $result->fetch_all(MYSQLI_NUM);
        
        // Map user ID to username
        for ($i = 0; $i < sizeof($posts); $i++) {
            $posts[$i][3] = returnNombreUsu($posts[$i][3]);
        }

        // Devolver los resultados en formato JSON
        echo json_encode($posts);
    } else {
        echo "Error en la consulta: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    mysqli_close($con);
} else {
    die("Error de conexión: " . mysqli_connect_error());
}