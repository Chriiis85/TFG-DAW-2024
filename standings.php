<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Formula One - Motoring Community</title>
  <link rel="stylesheet" href="CSS/standings.css" />
  <link rel="stylesheet" href="CSS/footer.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="JS/script.js"></script>
  <script defer src="JS/standings.js"></script>
</head>

<body>
  <?php
  include "header.php";
  ?>
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="" />
  </button>
  <section class="container-select-data"></section>
  <section class="main">
    <article class="teams-title-container">
      <h1 class="teams-title">2024 Formula One Season Standings</h1>
    </article>
    <article class="standings-selector">
      <div id="DriverStan">
        <h1>Drivers Standings</h1>
        <div id="barDriverStan" class="standings-selector-bar"></div>
      </div>
      <div id="ConstStan">
        <h1>Constructors Standings</h1>
        <div id="barConstStan" class="standings-selector-bar"></div>
      </div>
    </article>
    <article class="standings-teams-container">
      <article id="standings-teams-container" class="standings-driver-container">
        <?php
        include ("PHP/driverTeam.php");
        include ("PHP/returnTeamStanding.php");
        for ($i = 0; $i < sizeof($escuderias); $i++) {
          $nombre_equipo = str_replace(' ', '', $clasificacionesEquipos[$i]['Constructor']['name']);
          // Obtener el nombre completo del piloto
          $nombre_completo1 = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][0];
          $nombre_completo2 = $escuderias[$clasificacionesEquipos[$i]['Constructor']['name']][1];
          // Encontrar la posición del primer espacio en el nombre del piloto
          $primerEspacio = strpos($nombre_completo1, ' ');
          $primerEspacio2 = strpos($nombre_completo2, ' ');
          // Obtener el apellido del piloto usando substr desde el primer espacio hasta el final
          $apellido1 = substr($nombre_completo1, $primerEspacio + 1);
          $apellido2 = substr($nombre_completo2, $primerEspacio2 + 1);

          echo '<div id="standings-teams" class="standings-teams">
            <div class="position">' . $clasificacionesEquipos[$i]['position'] . '<div class="bar" style="background-color:var(--' . $nombre_equipo . ')"></div></div>
            
            <div class="nameTeam">' . $clasificacionesEquipos[$i]['Constructor']['name'] . '</div>
            <div class="driversname">' . $apellido1 . '/' . $apellido2 . '</div>
            <div class="teamCons"><img src="Images/Teams/' . $nombre_equipo . '.png" alt=""></div>
            <div class="points-cont"><div class="points">' . $clasificacionesEquipos[$i]['points'] . ' PTS.</div></div>

            <!--<div class="arrow"><img src="Images/arrowdown-svgrepo-com.svg" alt=""></div>-->
          </div>';

          echo '<div id="standings-teams-info" class="standings-teams-info" style="display: none">
          <div class="standings-teams-info-photo">
            <img src="Images/Cars/' . $nombre_equipo . '.png" alt="">
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
                  alt="" />
              </div>
              <div class="standings-teams-info-info-main-logo">
              <img src="Images/Teams/' . $nombre_equipo . '.png" alt="">
              </div>
            </div>
            <div class="standings-teams-info-info-extra">
              <div>
                <p>Wins: ' . $clasificacionesEquipos[$i]['wins'] . '.</p>
                <p>Total Points: ' . $clasificacionesEquipos[$i]['points'] . ' PTS.</p>
                <a href="' . $clasificacionesEquipos[$i]['Constructor']['url'] . '">Access to the biography.</a>
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
      function calcularEdad($fechaNacimiento)
      {
        // Convertir la fecha de nacimiento a un objeto DateTime
        $fechaNacimiento = new DateTime($fechaNacimiento);

        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Calcular la diferencia entre la fecha actual y la fecha de nacimiento
        $diferencia = $fechaActual->diff($fechaNacimiento);

        // Obtener la diferencia en años
        $edad = $diferencia->y;

        return $edad;
      }

      function nacionalidadAPais($nacionalidad)
      {
        switch ($nacionalidad) {
          case 'Dutch':
            return 'Netherlands';
            break;
          case 'Mexican':
            return 'Mexico';
            break;
          case 'Monegasque':
            return 'Monaco';
            break;
          case 'Spanish':
            return 'Spain';
            break;
          case 'British':
            return 'Great-Britain';
            break;
          case 'Australian':
            return 'Australia';
            break;
          case 'Canadian':
            return 'Canada';
            break;
          case 'Japanese':
            return 'Japan';
            break;
          case 'German':
            return 'Germany';
            break;
          case 'Danish':
            return 'Denmark';
            break;
          case 'Chinese':
            return 'China';
            break;
          case 'French':
            return 'France';
            break;
          case 'Finnish':
            return 'Finland';
            break;
          case 'American':
            return 'United%20States';
            break;
          case 'Thai':
            return 'Thailand';
            break;
          case 'Italian':
            return 'Italy';
            break;
          case 'Austrian':
            return 'Austria';
            break;
          case 'Swiss':
            return 'Switzerland';
            break;
        }
      }
      // URL de la API
      $url = 'https://ergast.com/api/f1/2024/driverStandings.json';

      // Obtener los datos JSON de la API
      $data = file_get_contents($url);

      // Decodificar los datos JSON en un array PHP
      $resultado = json_decode($data, true);

      // Verificar si se obtuvo una respuesta válida
      if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'])) {
        // Obtener la lista de clasificaciones de pilotos
        $clasificacionesPilotos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'];

        for ($i = 0; $i < sizeof($clasificacionesPilotos); $i++) {
          $nombre_equipo = str_replace(' ', '', $clasificacionesPilotos[$i]['Constructors'][0]['name']);
          echo '<article
            id="standings-driver-container"
            class="standings-driver-container"
          >';
          echo '<div id="standings-driver" class="standings-driver">';
          echo '<div class="position">' . $clasificacionesPilotos[$i]['position'] . '<div class="bar" style="background-color:var(--' . $nombre_equipo . ')";></div></div>';
          echo '<div class="name">' . $clasificacionesPilotos[$i]['Driver']['givenName'] . " " . $clasificacionesPilotos[$i]['Driver']['familyName'] . '</div>';
          echo '<div class="team">' . $clasificacionesPilotos[$i]['Constructors'][0]['name'] . '<img src="Images/Teams/' . $nombre_equipo . '.png" alt=""></div>';
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
                      alt=""
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
                      alt=""
                    />';
          echo '</div>';
          echo '<div class="standings-driver-info-info-main-helmet">';
          echo '<img
                      src="https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/' . $clasificacionesPilotos[$i]['Driver']['familyName'] . '.png"
                      alt=""
                    />';
          echo '</div>';
          echo '</div>';
          echo '<div class="standings-driver-info-info-extra">';
          echo '<div>';
          echo '<p>Wins: ' . $clasificacionesPilotos[$i]['wins'] . '</p>';
          echo '<p>Total Points: ' . $clasificacionesPilotos[$i]['points'] . ' PTS.</p>';
          echo '<p>Constructor: ' . $clasificacionesPilotos[$i]['Constructors'][0]['name'] . '</p>';
          echo '<a href="' . $clasificacionesPilotos[$i]['Driver']['url'] . '">Access to the biography</a>';
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
  <?php
    include "footer.php";
  ?>
</body>
<script>
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One Season Standings";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://img2.rtve.es/i/?w=1600&i=1680083321103.JPG')";

  document.getElementById("upBtn").classList.add("hidden");
  window.onscroll = function () { scrollFunction() };

  function scrollFunction() {
    if (document.body.scrollTop > window.innerHeight || document.documentElement.scrollTop > window.innerHeight) {
      document.getElementById("upBtn").classList.remove("hidden");
    } else {
      document.getElementById("upBtn").classList.add("hidden");
    }
  }

  function scrollToTop() {
    const scrollStep = -window.scrollY / (500 / 15);
    const scrollInterval = setInterval(function () {
      if (window.scrollY != 0) {
        window.scrollBy(0, scrollStep);
      }
      else clearInterval(scrollInterval);
    }, 15);
  }
</script>

</html>