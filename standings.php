<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>F1 Standings - Motoring Community</title>
  <!--HOJA DE ESTILOS STANDINGS-->
  <link rel="stylesheet" href="CSS/standings.css" />
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT PAGINA PRINCIPAL-->
  <script defer src="JS/script.js"></script>
  <!--SCRIPT STANDINGS-->
  <script defer src="JS/standings.js"></script>
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php";
  ?>
  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="Up Arrow" />
  </button>
  <section class="container-select-data"></section>
  <section class="main">
    <!--<article class="teams-title-container">
      <h1 class="teams-title">2024 Formula One Season Standings</h1>
    </article>-->
    <!--SELECTOR DONDE EL USUARIO ELIGE QUE CLASIFICACION MOSTRAR-->
    <article class="standings-selector">
        <div id="DriverStan">
            <h1 tabindex="0">Drivers Standings</h1>
            <div id="barDriverStan" class="standings-selector-bar"></div>
        </div>
        <div id="ConstStan">
            <h1 tabindex="0">Constructors Standings</h1>
            <div id="barConstStan" class="standings-selector-bar"></div>
        </div>
    </article>
    <article class="standings-teams-container">
      <article id="standings-teams-container" class="standings-driver-container">
        <?php
        //ARCHIVO QUE NOS DEVUELVE 
        include ("PHP/driverTeam.php");
        //IMPLEMENTAMOS ARCHIVO QUE NOS DEVUELVE LA CLASIFICACION DE LOS PILOTOS
        include ("PHP/returnDrivers.php");
        //IMPLEMENTAMOS ARCHIVO QUE NOS DEVUELVE LA CLASIFICACION DE ESCUDERIAS
        include ("PHP/returnTeamStanding.php");
        for ($i = 0; $i < sizeof($escuderias); $i++) {
          $nombre_equipo = str_replace(' ', '', $clasificacionesEquipos[$i]['Constructor']['name']);
          // NOMBRE DEL PILOTO
          $nombre_completo1 = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][0];
          $nombre_completo2 = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][1];
          // SEPARAR NOMBRE Y APELLIDO
          $primerEspacio = strpos($nombre_completo1, ' ');
          $primerEspacio2 = strpos($nombre_completo2, ' ');
          // OBTENER APELLIDO
          $apellido1 = substr($nombre_completo1, $primerEspacio + 1);
          $apellido2 = substr($nombre_completo2, $primerEspacio2 + 1);

          //MOSTRAR LAS CARTAS DE LOS EQUIPOS
          echo '<div tabindex="0" id="standings-teams" class="standings-teams">
            <div class="position">' . $clasificacionesEquipos[$i]['position'] . '<div class="bar" style="background-color:var(--' . $nombre_equipo . ')"></div></div>
            
            <div class="nameTeam">' . $clasificacionesEquipos[$i]['Constructor']['name'] . '</div>
            <div class="driversname">' . $apellido1 . '/' . $apellido2 . '</div>
            <div class="teamCons"><img src="Images/Teams/' . $nombre_equipo . '.png" alt="Team Logo"></div>
            <div class="points-cont"><div class="points">' . $clasificacionesEquipos[$i]['points'] . ' PTS.</div></div>

            <!--<div class="arrow"><img src="Images/arrowdown-svgrepo-com.svg" alt=""></div>-->
          </div>';

          echo '<div id="standings-teams-info" class="standings-teams-info" style="display: none">
          <div class="standings-teams-info-photo">
            <img src="Images/Cars/' . $nombre_equipo . '.png" alt="Car Img">
          </div>
          <div class="standings-teams-info-info">
            <div class="standings-teams-info-info-main">
              <div class="standings-teams-info-info-main-name">
                <h1>' . $clasificacionesEquipos[$i]['Constructor']['name'] . '</h1>
              </div>
              <div class="standings-teams-info-info-main-number">
                <h1></h1>
                <img
                  src="https://media.formula1.com/content/dam/fom-website/flags/' . nacionalidadAPais($clasificacionesEquipos[$i]['Constructor']['nationality']) . '.jpg"
                  alt="Country Flag" />
              </div>
              <div class="standings-teams-info-info-main-logo">
              <img src="Images/Teams/' . $nombre_equipo . '.png" alt="Team Logo">
              </div>
            </div>
            <div class="standings-teams-info-info-extra">
              <div>
                <p>Wins: ' . $clasificacionesEquipos[$i]['wins'] . '.</p>
                <p>Total Points: ' . $clasificacionesEquipos[$i]['points'] . ' PTS.</p>
                <a title="Go to ' . $clasificacionesEquipos[$i]['Constructor']['name'] . ' Biography Page" href="' . $clasificacionesEquipos[$i]['Constructor']['url'] . '">Access to the biography.</a>
              </div>
              <div>
                <p>Nationality: ' . $clasificacionesEquipos[$i]['Constructor']['nationality'] . '.</p>
                <p>Driver1: ' . $nombre_completo1 . '.</p>
                <p>Driver2: ' . $nombre_completo2 . '.</p>
              </div>
            </div>
          </div>
        </div>  ';
        }
        ?>
      </article>
    </article>

    <article class="standings-drivers-container">
      <?php
      // URL DE LA API PARA RECOGER LOS PILOTOS
      $url = 'https://ergast.com/api/f1/2024/driverStandings.json';

      // OBTENER LOS DATOS EN FORMATO JSON
      $data = file_get_contents($url);

      // DECODIFICAR DATOS EN JSON PARA LEERLO Y PINTARLO MEJOR
      $resultado = json_decode($data, true);

      // VERIFICAR SI LLEGAN DATOS PARA PREVENIR ERRORES Y DEBUGEAR
      if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'])) {

        // GUARDAR EN EL ARRAY QUE MUESTRA LOS PILOTOS
        $clasificacionesPilotos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'];

        //BUCLE PAR APODER ITERAR EL ARRAY QUE CONTIENE LOS PILoTOS
        for ($i = 0; $i < sizeof($clasificacionesPilotos); $i++) {
          $nombre_equipo = str_replace(' ', '', $clasificacionesPilotos[$i]['Constructors'][0]['name']);
          //MOSTRAR LAS CARTAS DE LOS PILOTOS
          echo '<article
            id="standings-driver-container"
            class="standings-driver-container"
          >';
          echo '<div tabindex="0" id="standings-driver" class="standings-driver">';
          echo '<div class="position">' . $clasificacionesPilotos[$i]['position'] . '<div class="bar" style="background-color:var(--' . $nombre_equipo . ')";></div></div>';
          echo '<div class="name">' . $clasificacionesPilotos[$i]['Driver']['givenName'] . " " . $clasificacionesPilotos[$i]['Driver']['familyName'] . '</div>';
          echo '<div class="team">' . $clasificacionesPilotos[$i]['Constructors'][0]['name'] . '<img src="Images/Teams/' . $nombre_equipo . '.png" alt="Team Logo"></div>';
          echo '<div class="points-cont"><div class="points">' . $clasificacionesPilotos[$i]['points'] . ' PTS.</div></div>';
          echo '<div class="arrow"><img src="Images/arrowdown-svgrepo-com.svg" alt=""></div>';
          echo '</div>';
          echo '<div
              id="standings-driver-info"
              class="standings-driver-info"
              style="display: none"
            >';
          echo '<div class="standings-driver-info-photo" ><img
                      src="https://media.formula1.com/content/dam/fom-website/drivers/2024Drivers/' . $clasificacionesPilotos[$i]['Driver']['familyName'] . '.jpg.img.1920.medium.jpg/1708344615576.jpg)"
                      alt="Driver Image"
                    />
            </div>';
          echo '<div class="standings-driver-info-info">';
          echo '<div class="standings-driver-info-info-main">';
          echo '<div class="standings-driver-info-info-main-name">';
          echo '<h1>' . $clasificacionesPilotos[$i]['Driver']['givenName'] . " " . $clasificacionesPilotos[$i]['Driver']['familyName'] . '</h1>';
          echo '</div>';
          echo '<div class="standings-driver-info-info-main-number">';
          echo '<h1>' . $clasificacionesPilotos[$i]['Driver']['permanentNumber'] . '</h1>';
          echo '<img
                      src="https://media.formula1.com/content/dam/fom-website/flags/' . nacionalidadAPais($clasificacionesPilotos[$i]['Driver']['nationality']) . '.jpg"
                      alt="Country Flag"
                    />';
          echo '</div>';
          echo '<div class="standings-driver-info-info-main-helmet">';
          echo '<img
                      src="https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/' . $clasificacionesPilotos[$i]['Driver']['familyName'] . '.png"
                      alt="Driver Helmet"
                    />';
          echo '</div>';
          echo '</div>';
          echo '<div class="standings-driver-info-info-extra">';
          echo '<div>';
          echo '<p>Wins: ' . $clasificacionesPilotos[$i]['wins'] . '</p>';
          echo '<p>Total Points: ' . $clasificacionesPilotos[$i]['points'] . ' PTS.</p>';
          echo '<p>Constructor: ' . $clasificacionesPilotos[$i]['Constructors'][0]['name'] . '</p>';
          echo '<a title="Go to Biography'. $clasificacionesPilotos[$i]['Driver']['givenName'] .' Page" href="' . $clasificacionesPilotos[$i]['Driver']['url'] . '">Access to the biography</a>';
          echo '</div>';
          echo '<div>';
          echo '<p>Nationality: ' . $clasificacionesPilotos[$i]['Driver']['nationality'] . '.</p>';
          echo '<p>Date of Birth: ' . $clasificacionesPilotos[$i]['Driver']['dateOfBirth'] . '</p>';
          echo '<p>Age: ' . calcularEdad($clasificacionesPilotos[$i]['Driver']['dateOfBirth']) . '</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</article>';
        }
      } else {
        echo "No se pudo obtener la información de la API.";
      }
      ?>
  </section>
  <!--IMPLEMENTAR FOOTER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "footer.php";
  ?>
</body>
<script>
  //SCRIPT QUE DEFINE EL TITULO DE LA PAGINA EN EL HEADER Y ESTABLECE LA IMAGEN DE FONDO DE LA CABECERA-->
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One Season Standings";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://img2.rtve.es/i/?w=1600&i=1680083321103.JPG')";
</script>

</html>