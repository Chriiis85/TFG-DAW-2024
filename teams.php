<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Constructors - Motoring Community</title>
  <link rel="stylesheet" href="CSS/teams.css">
  <link rel="stylesheet" href="CSS/footer.css">
  <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  <script defer src="JS/script.js"></script>
</head>

<body>
  <?php
  include "header.php";
  ?>
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="" />
  </button>
  <section class="main">
    <article class="teams-container">
      <?php
      include ("PHP/driverTeam.php");
      include ("PHP/returnTeamStanding.php");

      // Iterar sobre las escuderías y sus pilotos
      for ($i = 0; $i < sizeof($escuderias); $i++) {
        // Reemplazar espacios en el nombre del equipo para evitar problemas con los nombres de archivos
        $nombre_equipo = str_replace(' ', '', $clasificacionesEquipos[$i]['Constructor']['name']);

        echo '<div class="team-card-container" style="border:solid 5px var(--' . $nombre_equipo . ');border-left: none;
        border-bottom: none;">
        <div class="team-card-title">
        <h1>' . $clasificacionesEquipos[$i]['Constructor']['name'] . '</h1>
          <img src="Images/Teams/' . $nombre_equipo . '.png" alt="">
        </div>';


        // Iterar sobre los pilotos del equipo (solo los primeros dos)
        for ($j = 0; $j < 2; $j++) {
          // Obtener el nombre completo del piloto
          $nombre_completo = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][$j];

          // Encontrar la posición del primer espacio en el nombre del piloto
          $primerEspacio = strpos($nombre_completo, ' ');

          // Obtener el apellido del piloto usando substr desde el primer espacio hasta el final
          $apellido = substr($nombre_completo, $primerEspacio + 1);

          echo '<div class="team-card-driver">
          <h1>' . $nombre_completo . '</h1>
          <img src="Images/Drivers/' . $apellido . '.png" alt="">
            </div>';
        }
        echo '      <div class="team-card-car">
                  <img src="Images/Cars/' . $nombre_equipo . '.png" alt="">
                  </div>
              </div>';
      }
      ?>
      <!--<div class="team-card-container">
        <div class="team-card-title">
          <h1>Ferrari</h1>
          <img src="Images/Teams/Ferrari.png" alt="">
        </div>
        <div class="team-card-driver">
          <h1>Carlos Sainz</h1>
          <img src="Images/Drivers/Sainz.png" alt="">
        </div>
        <div class="team-card-driver">
          <h1>Carlos Sainz</h1>
          <img src="Images/Drivers/Sainz.png" alt="">
        </div>
        <div class="team-card-car">
          <img src="Images/Cars/Ferrari.png" alt="">
        </div>
      </div>-->

    </article>
  </section>
  <?php
  include "footer2.php";
  ?>
</body>
<script>
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One 2024 Constructors";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://media.formula1.com/image/upload/content/dam/fom-website/races/2023/race-listing/Bahrain%20Testing.jpg')";

</script>

</html>