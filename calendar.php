<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Formula One - Motoring Community</title>
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT PRINCIPAL PAGINA-->
  <script defer src="JS/script.js"></script>
  <!--HOJA DE ESTILOS CALENDARIO-->
  <link rel="stylesheet" href="CSS/calendar.css" />
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php";
  ?>
  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="" />
  </button>
  <!--SECCION PROXIMA CARRERA MUESTRA LA HORA Y UNA CUENTA ATRAS DE LA CARRERA CON EL NOMBRE, IMAGEN Y DESCRIPCION DEL CIRCUITO-->
  <section class="next-race">
    <div class="next-race-container">
      <div class="row">
        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="next-race-title">
            <div class="next-race-date">
              <p id="next-race-date">-</p>
            </div>
            <div class="next-race-info">
              <div class="next-race-next-race-circuit-imagecontainer">
                <img id="next-race-circuito" class="circuit-image" src="Images/Tracks/ChineseGrandPrix.png"
                  alt="F1 live race circuit" />
              </div>
              <div class="next-race-text-container">
                <div class="next-race-text">
                  <span id="next-race-title" class="race-name">-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-lg-4 col-xl-3">
          <div class="next-race-clock">
            <div class="countdown-clock">
              <div class="title-bar misc--label">Race Start</div>
              <div class="clock">
                <div class="days">
                  <p id="next-race-days" class="countdown-text">-</p>
                  <span class="f1--xxs f1-uppercase">days</span>
                </div>
                <div class="hours">
                  <p id="next-race-hours" class="countdown-text">-</p>
                  <span class="f1--xxs f1-uppercase">hrs</span>
                </div>
                <div class="minutes">
                  <p id="countdown-mins" class="countdown-text">-</p>
                  <span class="f1--xxs f1-uppercase">mins</span>
                </div>
              </div>
            </div>
            <div id="round" class="countdown-clock">
              <div id="round-title" class="title-bar misc--label">Race</div>
              <div class="clock">
                <div id="round-text" class="days">
                  <p id="round-number" class="countdown-text">-</p>
                  <span class="f1--xxs f1-uppercase">Round</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--CONTENEDOR DONDE SE MUESTRAN LAS TARJETAS DEL CALENDARIO-->
  <section class="calendar-season-container">
    <article class="calendar-season">
      <!--ARCHIVO QUE INCLUYE LAS FUNCIONES QUE PERMITEN LA RECOGIDA DE LA API DE LOS DATOS DEL CALENDARIO-->
      <?php
      include 'PHP/returnCalendar.php';
      for ($i = 0; $i < sizeof($data['MRData']['RaceTable']['Races']); $i++) {
        //RECOGER Y GUARDAR LOS CAMPOS DEL ARRAY DE LA API PARA PODER MOSTRARLOS
        $raceName = $data['MRData']['RaceTable']['Races'][$i]['raceName'];
        $circuitName = $data['MRData']['RaceTable']['Races'][$i]['Circuit']['circuitName'];
        $raceDate1 = $data['MRData']['RaceTable']['Races'][$i]['date'];
        $raceDate2 = $data['MRData']['RaceTable']['Races'][$i]['FirstPractice']['date'];
        $pais = $data['MRData']['RaceTable']['Races'][$i]['Circuit']['Location']['country'];
        //DIVIDIR LA FECHA
        $mes = substr($raceDate1, 5, 2);
        $dia1 = substr($raceDate1, 8, 2);
        $dia2 = substr($raceDate2, 8, 2);
        //FORMATEAR BIEN EL NOMBRE DEL CIRCUITO PARA PODER MOSTRARLO BIEN YA QUE EN LA API NO VIENE CORRECTO
        $circuitImg = str_replace(" ", "", $raceName);

        //VERIFICAR QUE TIPO DE CARRERA ES DEPENDIENDO DE CUAL ES TIENE DISTINTOS TIPOS DE SESIONES Y CAMBIAN EL NOMBRE
        $tipoCarrera = "";
        if (is_array($data['MRData']['RaceTable']['Races'][$i]) && array_key_exists('Sprint', $data['MRData']['RaceTable']['Races'][$i])) {
          $tipoCarrera = "Sprint";
        } else {
          $tipoCarrera = "Normal";
        }

        //SACAR LOS PAISES CUYO NOMBRE VIENE DISTINTO O CON FORMATO ERRONEO EN LA API PARA PODER SER APLICADO AL CODIGO
        if ($pais === "UK") {
          $pais = "united-kingdom";
        } else if ($pais === "USA") {
          $pais = "united-states";
        } else if ($pais === "UAE") {
          $pais = "united-arab-emirates";
        }
        if (str_contains($pais, " ")) {
          $pais = strtolower($pais);
          $pais = str_replace(" ", "-", $pais);
        }
        //PINTAR LA PARTE FRONTAL DE LA CARTA SIN DIFERENCIAR QUE TIPO DE CARRERA ES
        echo '
                <div id="race-container" class="race-container">
                  <div class="race-container-front">
                      <div class="race-container-round">
                          <h1>ROUND ' . ($i + 1) . '</h1>
                      </div>
                      <div class="race-container-title">
                          <h1>' . $dia2 . '-' . $dia1 . ' ' . dameMes($mes) . '</h1>
                          <img src="https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Flags%2016x9/' . $pais . '-flag.png.transform/2col/image.png" alt="">
                      </div>
                      <div class="race-container-desc">
                          <h1>' . $raceName . '</h1>
                          <p>' . $circuitName . '</p>
                      </div>
                      <div class="race-container-img">
                          <img src="Images/Tracks/' . $circuitImg . '.png" alt="">
                      </div>
                    </div>
                    <div id="race-container-back" class="race-container-back">
                      <div class="race-container-round">
                            <h1>ROUND ' . ($i + 1) . '</h1>
                        </div>
                        <div class="race-container-title">
                            <h1>' . $dia2 . '-' . $dia1 . ' ' . dameMes($mes) . '</h1>
                            <img src="https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Flags%2016x9/' . $pais . '-flag.png.transform/2col/image.png" alt="">
                        </div>
                        ';
        if ($tipoCarrera == "Normal") {
          //NO HAY CARRERA SPRINT ESE FINDE SEMANA SE PINTA DE LA MANERA 1
          //REOCGER LOS DATOS EN LA VARIABLE PARA PODER MOSTRARLOS
          $fp1 = $data['MRData']['RaceTable']['Races'][$i]['FirstPractice']['time'];
          $fp2 = $data['MRData']['RaceTable']['Races'][$i]['SecondPractice']['time'];
          $fp3 = $data['MRData']['RaceTable']['Races'][$i]['ThirdPractice']['time'];
          $qualy = $data['MRData']['RaceTable']['Races'][$i]['Qualifying']['time'];
          $race = $data['MRData']['RaceTable']['Races'][$i]['time'];

          //PINTAR LA PARTE TRASERA DE LA TARJETA
          echo '<div class="race-container-sesion">
                          <h1 class="race-container-sesion-title">Free Practice 1:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($fp1) . ' - ' . formatHora($fp1) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Free Practice 2:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($fp2) . ' - ' . formatHora($fp2) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Free Practice 3:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($fp3) . ' - ' . formatHora($fp3) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Qualifying:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($qualy) . ' - ' . formatHora($qualy) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Race:<h1>
                            <p class="race-container-sesion-hour">' . sumarDosHora($race) . ' - ' . formatHora($race) . '</p>
                          </div>';
        }
        if ($tipoCarrera == "Sprint") {
          //SI HAY CARRERA SPRINT ESE FINDE SEMANA SE PINTA DE LA MANERA 1
          //REOCGER LOS DATOS EN LA VARIABLE PARA PODER MOSTRARLOS          
          $fp1 = $data['MRData']['RaceTable']['Races'][$i]['FirstPractice']['time'];
          $qualySprint = $data['MRData']['RaceTable']['Races'][$i]['SecondPractice']['time'];
          $sprint = $data['MRData']['RaceTable']['Races'][$i]['Sprint']['time'];
          $qualy = $data['MRData']['RaceTable']['Races'][$i]['Qualifying']['time'];
          $race = $data['MRData']['RaceTable']['Races'][$i]['time'];

          //PINTAR LA PARTE TRASERA DE LA TARJETA
          echo '<div class="race-container-sesion">
                          <h1 class="race-container-sesion-title">Free Practice 1:<h1>
                          <p class="race-container-sesion-hour">' . sumarUnaHora($fp1) . ' - ' . formatHora($fp1) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Sprint Qualifying:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($qualySprint) . ' - ' . formatHora($qualySprint) . '</p>
                          </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Sprint Race:<h1>
                            <p class="race-container-sesion-hour">' . sumarUnaHora($sprint) . ' - ' . formatHora($sprint) . '</p>
                          </div>
                          <div class="race-container-sesion">
                          <h1 class="race-container-sesion-title">Qualifying:<h1>
                          <p class="race-container-sesion-hour">' . sumarUnaHora($qualy) . ' - ' . formatHora($qualy) . '</p>
                        </div>
                          <div class="race-container-sesion">
                            <h1 class="race-container-sesion-title">Race:<h1>
                            <p class="race-container-sesion-hour">' . sumarDosHora($race) . ' - ' . formatHora($race) . '</p>
                          </div>';
        }
        echo '</div>
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
<!--FUNCIONES DEL SCRIPT PARA CALENDARIO (GIRAR CARTAS)-->
<script>
  //RECOGER LAS TARJETAS Y CON EL BOOLEANO COMPROBAMOS SI ESTA GIRADA O NO
  let cardAll = document.querySelectorAll(".race-container");
  let flippedCard = null;

  //FOR PARA RECORRER TODAS LAS TARJETAS
  for (const card of cardAll) {
    card.addEventListener("click", () => {
      let cardBack = card.querySelector(".race-container-back");

      //VERIFICA SI HAY TARJETAS GIRADAS
      if (flippedCard && flippedCard !== card) {
        //SI NO LA HAY SE GIRA LA QUE ESTA SELECCIONADA
        let flippedCardBack = flippedCard.querySelector(".race-container-back");
        flippedCard.style.transform = "rotateY(0deg)";
        flippedCardBack.style.opacity = "0";
      }

      //SI LA TARJETA NUEVA SE GIRA LA QUE ESTA ROTADA SE VUELVE A OCULTAR
      if (card.style.transform === "rotateY(180deg)") {
        card.style.transform = "rotateY(0deg)";
        //TIMEOUR PARA HACER EL EFECTO BONITO Y NO SE VEAN SOBREPUESTOS LOS CONTENIDOS
        setTimeout(() => {
          cardBack.style.opacity = "0";
        }, 0);
        flippedCard = null;
      } else {
        card.style.transform = "rotateY(180deg)";
        setTimeout(() => {
          cardBack.style.opacity = "1";
        }, 200);
        flippedCard = card;
      }
    });
  }
  //SCRIPT QUE DEFINE EL TITULO DE LA PAGINA EN EL HEADER Y ESTABLECE LA IMAGEN DE FONDO DE LA CABECERA-->
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One 2024 Calendar";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://corp.formula1.com/wp-content/uploads/2023/07/F1-2024-Calendar-16x9-1-1024x576-1.jpg')";

</script>

</html>