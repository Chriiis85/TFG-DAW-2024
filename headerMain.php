<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Main - Motoring Community</title>
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT HEADER PARA LA PAGINA-->
  <script defer src="JS/header.js"></script>
  <!--HOJA DE ESTILOS HEADER-->
  <link rel="stylesheet" href="CSS/header.css" />
</head>

<body>
  <!--CONTENEDOR DEL HEADER-->
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
        <p tabindex="7" onclick="window.location.href = 'data.php'">
          HISTORIC DATA
        </p>
        <p tabindex="8" onclick="window.location.href = 'standings.php'">SEASON STANDINGS</p>
        <p tabindex="9" onclick="window.location.href = 'forum.php'">FORUM</p>
      </div>
      <div class="header-container3"></div>
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
</body>

</html>