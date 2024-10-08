<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Forum - Motoring Community</title>
  <!-- SCRIPT JQUERY -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SCRIPT HEADER PARA LA PAGINA -->
  <script defer src="JS/header.js"></script>
  <!-- HOJA DE ESTILOS HEADER -->
  <link rel="stylesheet" href="CSS/headerForum.css" />
</head>
<body>
  <?php
  /*SI LA COOKIE ESTA INCIALIZADA GUARDAMOS EN LA VARIABLE USER EL NOMBRE DEL USUARIO*/
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    // SI LA COOKIE NO ESTA ESTABLECIDA MANDAMOS A LA PAGINA DE INICIO DE SESION
    header('Location: users.php');
  }
  ?>

  <!-- CONTENEDOR QUE TIENE Y ACTUA COMO EL HEADER IGUAL EN TODAS LAS PAGINAS SIMPLIFICANDO EL CODIGO -->
  <section id="header-container" class="header-container">
    <article class="header">
      <div class="header-container1">
        <h1 tabindex="1" id="redirectFormEnterH1Main" title="Go to Main Page" onclick="window.location.href = 'index.html'">
          MOTORING COMMUNITY
        </h1>
      </div>
      <div class="header-container2">
        <a tabindex="2" id="formulaone">
          FORMULA ONE &nbsp;&nbsp;<img src="Images/down-arrow-svgrepo-com.svg" alt="Down Arrow" />
        </a>
        <a title="Go to Standings Page" href="standings.php">SEASON STANDINGS</a>
        <a title="Go to Data Page" href="data.php">
          HISTORIC DATA
        </a>
        <a title="Go to Forum Page" href="forum.php">FORUM</a>
      </div>
      <div class="header-container3">
        <?php
        echo '<div class="user">
          <p>Welcome Back: ' . $username . '!</p>
          <button id="logout" class="logOutBtn">Log Out<img src="Images/logout.svg" alt=""></button>
        </div>';
        ?>
      </div>
    </article>
    <!-- CONTENIDO QUE SE DESPLIEGA AL HACER HOVER SOBRE LOS CONTENIDOS -->
    <div id="header-drop-container-formulaone" class="header-drop-container">
      <div class="header-drop-container-options">
        <h1>Formula One <div class="header-drop-container-line"></div>
        </h1>
      </div>
      <div class="header-drop-container-options">
        <h3 tabindex="3" id="redirectFormEnterH3About" title="Go to About F1 Page" onclick="window.location.href = 'aboutf1.php'"><img
            src="Images/down-arrow-svgrepo-com.svg" alt="Down Arrow" />About Formula One</h3>
      </div>
      <div class="header-drop-container-options2">
        <a title="Go to Drivers Page" tabindex="4" href="drivers.php"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Drivers</a>
        <a title="Go to Teams Page" tabindex="5" href="teams.php"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Constructors</a>
        <a title="Go to Calendar Page" tabindex="6" href="calendar.php"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Calendar</a>
      </div>
    </div>
  </section>
</body>

</html>
