<?php
//RECOGEMOS DEL INPUT LAS LETRAS O CADENA
$letra = $_POST['letra'];

//INCLUIR EL ARCHIVO DE LA CONEXION
include "conexion.php";

//INCLUIR EL ARCHIVO QUE DEVUELVE LOS TEMAS PARA VOLVER A PINTARLOS
include "returnThemes.php";


//PROBAR LA CONEXION
if (!$con->connect_error) {

    //CONSULTA QUE VAMOS A REALIZAR, BUSCAR TEMAS QUE CONTENGAN EL STRING QUE NOS LLEGA DEL INPUT
    $consulta = "SELECT * FROM themes WHERE titulo_tema LIKE '%" . $letra . "%'";

    //RECOGEMOS EL RESULTADO DE LA CONSULTA
    $result = mysqli_query($con, $consulta);

    //SI SE EJECUTA BIEN LA CONSULTA CONTINUAMOS
    if ($result) {
        //OBTENER LOS TEMAS DEVUELTOS
        $themes = mysqli_fetch_all($result);
        
        //AÑADIR INDICES PARA MOSTRAR EL NOMBRE DEL USUARIO EL NUMERO DE POSTS Y EL ULTIMO POST
        for ($i = 0; $i < sizeof($themes); $i++) {
            $themes[$i][3] = returnNombreUsu($themes[$i][3]);
            $themes[$i][4] = returnNumberPosts($themes[$i][0]);
            $themes[$i][5] = returnLastPost($themes[$i][0]);
        }

        //CODIFICAR EN FORMATO JSON EL ARRAY
        echo json_encode($themes);
    } else {
        //MOSTRAR MENSAJE DE ERROR SI NO SE REALIZA LA CONSULTA 
        echo "Error en la consulta: " . mysqli_error($con);
    }

    //CERRAR LA CONEXION
    mysqli_close($con);
} else {
    //MOSTRAR MENSAJE DE ERROR DE CONEXION
    die("Error de conexión: " . mysqli_connect_error());
}
?>