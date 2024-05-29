<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F1 Constructors - Motoring Community</title>
  <!--HOJA DE ESTILOS CALENDARIO-->
  <link rel="stylesheet" href="CSS/teams.css">
  <!--SCRIPT MAIN-->
  <script defer src="JS/script.js"></script>
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php";
  ?>
  <!--BOTON QUE PERMITE VOLVER ARRIBA DE LA PAGINA EN CUALQUIER MOMENTO-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button" aria-label="Scroll to top">
    <img src="Images/UPARROW.svg" alt="Up Arrow" />
  </button>
  <!--SECCION MAIN CON LAS CARTAS-->
  <section class="main">
    <article class="teams-container">
      <?php
      //INCLUIR LOS ARCHIVOS QUE NOS RECOGEN LOS PILOTOS POR EQUIPO Y EL ARCHIVO QUE NOS DEVUELVE EL ARRAY CON LOS EQUIPOS
      include ("PHP/driverTeam.php");
      include ("PHP/returnTeamStanding.php");

      // BUCLE PARA ITERAR SOBRE LAS ESCUDERIAS
      for ($i = 0; $i < sizeof($escuderias); $i++) {
        $nombre_equipo = str_replace(' ', '', $clasificacionesEquipos[$i]['Constructor']['name']);

        echo '<div class="team-card-container" tabindex="0" style="border:solid 5px var(--' . $nombre_equipo . ');box-shadow: 0 0 20px black, 0 0 1px black, 0 0 20px var(--' . $nombre_equipo . '), 0 0 20px var(--' . $nombre_equipo . '), 
        0 0 20px var(--' . $nombre_equipo . '), 0 0 10px var(--' . $nombre_equipo . '); border-left: none; 
        "
        border-bottom: none;">
        <div class="team-card-title">
        <h1>' . $clasificacionesEquipos[$i]['Constructor']['name'] . '</h1>
          <img src="Images/Teams/' . $nombre_equipo . '.png" alt="Team Logo">
        </div>';


        // BUCLE PARA ITERAR EL ARRAY QUE CONTIENE LOS PILOTOS, SE REALIZA DOS VECES POR ESCUDERIA
        for ($j = 0; $j < 2; $j++) {
          $nombre_completo = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][$j];
          $primerEspacio = strpos($nombre_completo, ' ');
          $apellido = substr($nombre_completo, $primerEspacio + 1);

          echo '<div class="team-card-driver">
          <h1>' . $nombre_completo . '</h1>
          <img src="Images/Drivers/' . $apellido . '.png" alt="Driver Image">
            </div>';
        }
        echo '      <div class="team-card-car">
                  <img src="Images/Cars/' . $nombre_equipo . '.png" alt="Car Image">
                  </div>
              </div>';
      }
      ?>
    </article>
  </section>
  <!--IMPLEMENTAR FOOTER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "footer.php";
  ?>
</body>
<script>
  //SCRIPT QUE DEFINE EL TITULO DE LA PAGINA EN EL HEADER Y ESTABLECE LA IMAGEN DE FONDO DE LA CABECERA-->
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One 2024 Constructors";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://media.formula1.com/image/upload/content/dam/fom-website/races/2023/race-listing/Bahrain%20Testing.jpg')";

</script>

</html>