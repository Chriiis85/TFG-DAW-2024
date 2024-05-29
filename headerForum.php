<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Forum - Motoring Community</title>
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT HEADER PARA LA PAGINA-->
  <script defer src="JS/header.js"></script>
  <!--HOJA DE ESTILOS HEADER-->
  <link rel="stylesheet" href="CSS/headerForum.css" />
</head>
<?php
/*SI LA COOKIE ESTA INCIALIZADA GUARDAMOS EN LA VARIABLE USER EL NOMBRE DEL USUARIO*/
if (isset($_COOKIE["username"])) {
  $username = $_COOKIE["username"];
} else {
  //SI LA COOKIE NO ESTA ESTABLECIDA MANDAMOS A LA PAGINA DE INICIO DE SESION
  header('Location: users.php');
}
?>

<body>
  <!--CONTENEDOR QUE TIENE Y ACTUA COMO EL HEADER IGUAL EN TODAS LAS PAGINAS SIMPLIFICANDO EL CODIGO-->
  <section id="header-container" class="header-container">
    <article class="header">
      <div class="header-container1">
        <h1 tabindex="1" onclick="window.location.href = 'index.html'">
          MOTORING COMMUNITY
        </h1>
      </div>
      <div class="header-container2">
        <p tabindex="2" class="progress-bar" id="formulaone">
          FORMULA ONE &nbsp;&nbsp;<img src="Images/down-arrow-svgrepo-com.svg" alt="Down Arrow" />
        </p>
        <p tabindex="7" onclick="window.location.href = 'data.php'" class="progress-bar">
          HISTORIC DATA
        </p>
        <p tabindex="8" onclick="window.location.href = 'standings.php'">SEASON STANDINGS</p>
        <p tabindex="9"onclick="window.location.href = 'forum.php'">FORUM</p>
      </div>
      <div class="header-container3">
        <?php
        echo '<div class="user">
          <p>Welcome Back: ' . $username . '!</p>
          <button tabindex="10" id="logout" class="logOutBtn">Log Out<img src="Images/logout.svg" alt=""></button>
        </div>';
        ?>
      </div>
    </article>
    <!--CONTENIDO QUE SE DESPLIEGA AL HACER HOVER SOBRE LOS CONTENIDOS-->
    <div id="header-drop-container-formulaone" class="header-drop-container">
      <div class="header-drop-container-options">
        <h1>Formula One <div class="header-drop-container-line"></div>
        </h1>
      </div>
      <div class="header-drop-container-options">
        <h3 tabindex="3" onclick="window.location.href = 'aboutf1.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />About Formula One</h3>
      </div>
      <div class="header-drop-container-options2">
        <p tabindex="4" onclick="window.location.href = 'drivers.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Drivers</p>
        <p tabindex="5" onclick="window.location.href = 'teams.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Constructors</p>
        <p tabindex="6" onclick="window.location.href = 'calendar.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Calendar</p>
      </div>
    </div>
    <!--TITULO QUE SE CAMBIA EN CADA PAGINA PARA MOSTRAR EL CONTENIDO-->
    <!--<h1 id="title-header" class="title-header-container"></h1>-->
  </section>
</body>

</html>