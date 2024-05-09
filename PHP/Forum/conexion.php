<?php
// CLASE QUE SE INCLUYE EN TODOS LOS ARCHIVOS QUE REALIZEN UNA CONEXION A LA BBDD
$host = "localhost";
$user = "root";
$pwd = "";
$bd = "motoring_community";

$con = new mysqli($host, $user, $pwd, $bd);
if ($con->connect_error) {
    print("Error de conexión: " . $con->connect_error);
}else{
    print("Conexion creada con éxito");
}
?>