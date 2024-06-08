<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Usuario</title>
    <!--HOJA DE ESTILOS VALIDACIONES-->
    <link rel="stylesheet" href="../../CSS/validations.css">
    <!--SCRIPT PARA LAS ALERTAS SWEET ALERT-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    // CONECTAR CON LA BASE DE DATOS INCLUYENDO EL ARCHIVO DE LA CONEXION
    include_once "conexion.php";

    //RECOGER LOS DATOS POR POST DEL FORMULARIO QUE SE ENVIA
    $username = $_POST["username"];
    $password = $_POST["password"];

    //COMPROBAR SI LA CONEXIÓN FUNCIONA
    if (!$con->connect_error) {
        // CONSULTA PREPARADA PARA EVITAR INYECCIÓN SQL
        $consulta = 'SELECT * FROM users WHERE username=? AND pwd=?';

        //EJECUTAMOS LA CONSULTA
        $stmt = mysqli_prepare($con, $consulta);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //SI DEVEULVE RESULTADOS Y FILAS, ES QUE EXISTE UN USUARIO CON ESE NOMBRE Y CONTRASEÑA YA QUE NOS DEVUELVE LA CONSULTA UNA FILA
        if ($result) {
            //NUMEROS DE FILA QUE DEUELVE
            $num_rows = mysqli_num_rows($result);

            //SI DEVUELVE MAS DE UNA FILA EXISTE Y LOS DATOS SON VALIDOS
            if ($num_rows > 0) {
                //CREAMOS LA COOKIE PARA RECOGER EL NOMBRE DEL USUARIO POR DEFECTO TENDRÁ UNA HORA DE VALIDEZ
                setcookie("username", $username, time() + 3600, "/");
                ?>
                <!--MOSTRAR UN MENSAJE AL USUARIO DE CONFIRMACION-->
                <script language="javascript">
                    Swal.fire({
                        title: "LOG IN SUCCESSFULLY.",
                        text: "Welcome back: <?php echo $username; ?>.",
                        icon: "success",
                        allowOutsideClick: false,
                        confirmButtonColor: "green",
                        confirmButtonText: "OKEY"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../forum.php";
                        }
                    });
                </script>
                <?php
            } else {
                //SI NO DEVUELVE ES QUE NO EXISTEN USUARIOS POR LO TANTO MOSTRAMOS EL ERROR
                ?>
                <!--MOSTRAR UN MENSAJE AL USUARIO DE ERROR-->
                <script language="javascript">
                    Swal.fire({
                        title: "Cancelled",
                        text: "ERROR, The credentials are incorrect, try again.",
                        icon: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "GO BACK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../users.php";
                        }
                    });
                </script>
                <?php
            }

            // CERRAR LA CONEXIÓN
            mysqli_close($con);
        } else {
            //ERROR SI SE EJECUTA MAL LA CONSULTA
            echo '<script language="javascript">';
            echo 'alert("Error al ejecutar la consulta: ' . mysqli_error($con) . '");';
            echo 'window.location.href = "../../users.php";';
            echo '</script>';
        }
    } else {
        //ERROR PARA LA CONEXION
        die("Error de conexión: " . mysqli_connect_error());
    }
    ?>
</body>

</html>