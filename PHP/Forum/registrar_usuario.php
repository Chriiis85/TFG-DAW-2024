<?php

//CONECTAR CON LA BASE DE DATOS
include "conexion.php";

//DATOS RECOGIDOS
$mail = $_POST["mail"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$password = $_POST["passwordRegister"];

// Validar los datos recogidos
if (empty($mail) || empty($name) || empty($surname) || empty($password)) {
    echo '<script language="javascript">';
    echo 'alert("Por favor complete todos los campos");';
    echo 'window.location.href = "../../users.php";';
    echo '</script>';
    exit();
}

// Hash de la contraseña
//$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);


//CONSULTA A EJECUTAR
$consulta = "INSERT INTO `users`(`username`, `name`, `surname`, `pwd`, `verified`) VALUES (?, ?, ?, ?, 1)";

//INICIAR EL STATEMENT
$stmt = mysqli_stmt_init($con);

//PREPARAR LA CONSULTA
if (mysqli_stmt_prepare($stmt, $consulta)) {

    //ENLAZAR LOS PARAMETROS
    mysqli_stmt_bind_param($stmt, "ssss", $mail, $name, $surname, $password);

    //EJECUTAR EL STATEMENT
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_affected_rows($con)) {
            //REDIRIGIMOS AL USUARIO
            echo '<script language="javascript">';
            echo 'alert("Se ha podido crear una cuenta: ' .$password.' y '. htmlspecialchars($mail, ENT_QUOTES, 'UTF-8') . '");';
            echo 'window.location.href = "../../users.php";';
            echo '</script>';
        } else {
            //REDIRIGIMOS AL USUARIO
            echo '<script language="javascript">';
            echo 'alert("No se ha podido Crear la Cuenta");';
            echo 'window.location.href = "../../users.php";';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Error al ejecutar la consulta");';
        echo 'window.location.href = "../../users.php";';
        echo '</script>';
    }

    //CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);
} else {
    echo '<script language="javascript">';
    echo 'alert("Error al preparar la consulta");';
    echo 'window.location.href = "../../users.php";';
    echo '</script>';
}

//CERRAR LA CONEXION
mysqli_close($con);

?>
