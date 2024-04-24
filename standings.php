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
  <section class="container-select-data"></section>
  <section class="main">
    <article class="teams-title-container">
      <h1 class="teams-title">2024 Formula One Season Standings</h1>
    </article>
    <article class="standings-selector">
      <div id="DriverStan"><h1>Drivers Standings</h1><div id="barDriverStan" class="standings-selector-bar"></div></div>
      <div id="ConstStan"><h1>Constructors Standings</h1><div id="barConstStan" class="standings-selector-bar"></div></div>
    </article>
    <article class="standings-teams-container">
      <article id="standings-teams-container" class="standings-driver-container">
        <?php
        include("PHP/driverTeam.php");
        include("PHP/returnTeamStanding.php");
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

          echo'<div id="standings-teams" class="standings-teams">
            <div class="position">'.$clasificacionesEquipos[$i]['position'].'</div>
            <div class="bar" style="background-color:var(--'.$nombre_equipo.')"></div>
            <div class="name">'.$clasificacionesEquipos[$i]['Constructor']['name'] .'</div>
            <div class="driversname">'.$apellido1.'/'.$apellido2.'</div>
            <div class="team"><img src="Images/Teams/'.$nombre_equipo.'.png" alt=""></div>
            <div class="points">'.$clasificacionesEquipos[$i]['points'].' PTS.</div>
            <div class="arrow"><img src="Images/arrowdown-svgrepo-com.svg" alt=""></div>
          </div>';

          echo'<div id="standings-teams-info" class="standings-teams-info" style="display: none">
          <div class="standings-teams-info-photo">
            <img src="Images/Cars/' . $nombre_equipo . '.png" alt="">
          </div>
          <div class="standings-teams-info-info">
            <div class="standings-teams-info-info-main">
              <div class="standings-teams-info-info-main-name">
                <h1>'.$clasificacionesEquipos[$i]['Constructor']['name'].'</h1>
              </div>
              <div class="standings-teams-info-info-main-number">
                <h1></h1>
                <img
                  src="https://media.formula1.com/content/dam/fom-website/flags/'.nacionalidadAPais($clasificacionesEquipos[$i]['Constructor']['nationality']).'.jpg"
                  alt="" />
              </div>
              <div class="standings-teams-info-info-main-logo">
              <img src="Images/Teams/'.$nombre_equipo.'.png" alt="">
              </div>
            </div>
            <div class="standings-teams-info-info-extra">
              <div>
                <p>Wins: '.$clasificacionesEquipos[$i]['wins'].'.</p>
                <p>Total Points: '.$clasificacionesEquipos[$i]['points'].' PTS.</p>
                <a href="'.$clasificacionesEquipos[$i]['Constructor']['url'].'">Access to the biography.</a>
              </div>
              <div>
                <p>Nationality: '.$clasificacionesEquipos[$i]['Constructor']['nationality'].'.</p>
                <p>Driver1: '.$nombre_completo1.'.</p>
                <p>Driver2: '.$nombre_completo2.'.</p>
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
          echo '<div class="position">' . $clasificacionesPilotos[$i]['position'] . '</div>';
          echo '<div class="bar" style="background-color:var(--' . $nombre_equipo . ')";></div>';
          echo '<div class="name">' . $clasificacionesPilotos[$i]['Driver']['givenName'] . " " . $clasificacionesPilotos[$i]['Driver']['familyName'] . '</div>';
          echo '<div class="team">' . $clasificacionesPilotos[$i]['Constructors'][0]['name'] . '<img src="Images/Teams/' . $nombre_equipo . '.png" alt=""></div>';
          echo '<div class="points">' . $clasificacionesPilotos[$i]['points'] . ' PTS.</div>';
          echo '<div class="arrow"><img src="Images/arrowdown-svgrepo-com.svg" alt=""></div>';
          echo '</div>';
          echo '<div
              id="standings-driver-info"
              class="standings-driver-info"
              style="display: none"
            >';
          echo '<div class="standings-driver-info-photo" style="  background-image: url(https://media.formula1.com/content/dam/fom-website/drivers/2024Drivers/' . $clasificacionesPilotos[$i]['Driver']['familyName'] . '.jpg.img.1920.medium.jpg/1708344615576.jpg);
            "></div>';
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
          echo '<p>Place of Birth: Oviedo,Spain.</p>';
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
  <footer>
    <section class="footer-column1">
      <article class="card-help">
        <p>Contact Information.</p>
      </article>
      <article class="card-help">
        <p>Terms of Use.</p>
      </article>

      <article class="card-help">
        <p>Privacy Policy.</p>
      </article>

      <article class="card-help">
        <p>Frequent Questions.</p>
      </article>
    </section>
    <section class="footer-vertical-bar"></section>
    <section class="footer-column2">
      <article class="card-socialmedia">
        <a class="socialContainer containerOne" href="#">
          <svg viewBox="0 0 16 16" class="socialSvg instagramSvg">
            <path
              d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
            </path>
          </svg>
        </a>

        <a class="socialContainer containerTwo" href="#">
          <svg viewBox="0 0 16 16" class="socialSvg twitterSvg">
            <path
              d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
            </path>
          </svg>
        </a>

        <a class="socialContainer containerThree" href="#">
          <svg viewBox="0 0 448 512" class="socialSvg linkdinSvg">
            <path
              d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
            </path>
          </svg>
        </a>

        <a class="socialContainer containerFour" href="#">
          <svg viewBox="0 0 16 16" class="socialSvg whatsappSvg">
            <path
              d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
            </path>
          </svg>
        </a>
      </article>
      <article class="card-textus"></article>
    </section>
  </footer>
  <section class="author">
    <p>WEBPAGE MADE BY CHRISTIAN MORENO DIAZ - ALL RIGHTS RESERVED 2024®™</p>
  </section>

</body>

</html>