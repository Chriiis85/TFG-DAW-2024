<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <!--HOJA DE ESTILOS VALIDACIONES-->
    <link rel="stylesheet" href="../../CSS/validations.css">
    <!--SCRIPT PARA LAS ALERTAS SWEET ALERT-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    // CONECTAR CON LA BASE DE DATOS INCLUYENDO EL ARCHIVO DE LA CONEXION
    include "conexion.php";

    // DATOS RECOGIDOS ELIMINANDO POSIBLES ESPACIOS VACIOS
    $mail = trim($_POST["mail"]);
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $password = trim($_POST["passwordRegister"]);

    // VALIDAR LOS DATOS RECOGIDOS EN EL CASO QUE LLEGUEN VACIOS
    if (empty($mail) || empty($name) || empty($surname) || empty($password)) {
        ?>
        <!--MOSTRAR UN MENSAJE AL USUARIO DE ERROR-->
        <script language="javascript">
            Swal.fire({
                title: "ERROR",
                text: "ERROR, You must fill al the fields.",
                icon: "info",
                allowOutsideClick: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "TRY AGAIN"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../users.php";
                }
            });
        </script>
        <?php
        exit();
    }

    // COMPROBAR QUE EL USUARIO NO EXISTE
    if (!existUser($mail, $con)) {
        // CONSULTA A EJECUTAR
        $consulta = "INSERT INTO `users`(`username`, `name`, `surname`, `pwd`, `verified`) VALUES (?, ?, ?, ?, 1)";

        // INICIAR EL STATEMENT
        $stmt = mysqli_stmt_init($con);

        // PREPARAR LA CONSULTA
        if (mysqli_stmt_prepare($stmt, $consulta)) {
            // ENLAZAR LOS PARAMETROS
            mysqli_stmt_bind_param($stmt, "ssss", $mail, $name, $surname, $password);

            // EJECUTAR EL STATEMENT
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_affected_rows($con) > 0) {
                    // REDIRIGIMOS AL USUARIO
                    ?>
                    <!--MOSTRAR UN MENSAJE AL USUARIO DE CONFIRMACION-->
                    <script language="javascript">
                        Swal.fire({
                            title: "ACCOUNT CREATED.",
                            text: "Your account <?php echo $mail ?> has been created successfully!.",
                            icon: "success",
                            allowOutsideClick: false,
                            confirmButtonColor: "green",
                            confirmButtonText: "GO LOG IN"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../users.php";
                            }
                        });
                    </script>
                    <?php
                } else {
                    // REDIRIGIMOS AL USUARIO SI NO SE PUEDE CREAR LA CUENTA
                    ?>
                    <!--MOSTRAR UN MENSAJE AL USUARIO DE ERROR-->
                    <script language="javascript">
                        Swal.fire({
                            title: "ACCOUNT NOT CREATED",
                            text: "ERROR, your account can not be created.",
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
            } else {
                //ERROR SI SE EJECUTA MAL LA CONSULTA
                echo '<script language="javascript">';
                echo 'alert("Error al ejecutar la consulta: ' . mysqli_error($con) . '");';
                echo 'window.location.href = "../../users.php";';
                echo '</script>';
            }

            // CERRAR EL STATEMENT
            mysqli_stmt_close($stmt);
        } else {
            //ERROR SI NO SE PREPARA BIEN EL STATEMENT
            echo '<script language="javascript">';
            echo 'alert("Error al preparar el statement");';
            echo 'window.location.href = "../../users.php";';
            echo '</script>';
        }

        // CERRAR LA CONEXION
        mysqli_close($con);
    } else {
        //EN EL CASO DE QUE HAYA UN USUARIO EXISTENTE SE MUESTRA UN MENSAJE DE ERROR
        ?>
        <!--MOSTRAR UN MENSAJE AL USUARIO DE ERROR-->
        <script language="javascript">
            Swal.fire({
                title: "Usename in use",
                text: "ERROR, an username already exists with that username.",
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

    //FUNCION QUE COMPRUEBA SI HAY UN USUARIO YA EXISTENTE PARA NO PERMITIR LA DUPLICIDAD DE USUARIOS Y SUS USERNAME
    function existUser($mail, $con)
    {
        // CONSULTA A EJECUTAR
        $consulta = "SELECT * FROM users WHERE username = ?";

        // INICIAR EL STATEMENT
        $stmt = mysqli_stmt_init($con);

        // PREPARAR LA CONSULTA
        if (mysqli_stmt_prepare($stmt, $consulta)) {
            // ENLAZAR LOS PARAMETROS
            mysqli_stmt_bind_param($stmt, "s", $mail);

            // EJECUTAR EL STATEMENT
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // OBTENER EL RESULTADO
            $userExists = mysqli_num_rows($result) > 0;

            // CERRAR EL STATEMENT
            mysqli_stmt_close($stmt);

            //DEVUELVE SI HAY USUARIOS EXISTENTES
            return $userExists;
        } else {
            //NO SE PUDO REALIZAR
            return false;
        }
    }
    ?>
</body>

</html>