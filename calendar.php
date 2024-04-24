<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Formula One - Motoring Community</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="JS/script.js"></script>
    <link rel="stylesheet" href="CSS/calendar.css" />
  </head>
  <body>
    <section class="header-container">
      <article class="header">
        <div class="header-container1">
          <h1 onclick="window.location.href = 'index.html'">
            MOTORING COMMUNITY
          </h1>
        </div>
        <div class="header-container2">
          <p class="progress-bar" id="formulaone">
            FORMULA ONE &nbsp;&nbsp;<img
              src="Images/down-arrow-svgrepo-com.svg"
              alt="Down Arrow"
            />
          </p>
          <p onclick="window.location.href = 'data.html'" class="progress-bar">
            DATA & ANALYSIS&nbsp;&nbsp;<img
              src="Images/down-arrow-svgrepo-com.svg"
              alt="Down Arrow"
            />
          </p>
          <p onclick="window.location.href = 'standings.php'">2024 SEASON</p>
          <p class="progress-bar">
            ARCHIVE AND HISTORY&nbsp;&nbsp;<img
              src="Images/down-arrow-svgrepo-com.svg"
              alt="Down Arrow"
            />
          </p>
          <p>FORUM</p>
        </div>
        <div class="header-container3"></div>
      </article>
      <h1 class="title-header-container">2024 FORMULA ONE CALENDAR</h1>
    </section>
    <div id="header-drop-container-formulaone" class="header-drop-container">
      <h1>
        Formula One
        <div class="header-drop-container-line"></div>
      </h1>
      <div>
        <p id="pAboutf1" onclick="window.location.href = 'aboutf1.html'">
          About Formula One
        </p>
      </div>
      <div class="header-drop-container-list">
        <p onclick="window.location.href = 'drivers.html'">2024 Drivers</p>
        <p onclick="window.location.href = 'teams.php'">2024 Constructors</p>
        <p onclick="window.location.href = 'standings.php'">
          2024 Calendar & Schedule
        </p>
      </div>
    </div>
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
                    <img
                      id="next-race-circuito"
                      class="circuit-image"
                      src="Images/Tracks/ChineseGrandPrix.png"
                      alt="F1 live race circuit"
                    />
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
    <section class="calendar-season-container">
      <article class="calendar-season">
        <?php
        include 'PHP/returnCalendar.php';
        for ($i=0; $i < sizeof($data['MRData']['RaceTable']['Races']); $i++) { 
          $raceName = $data['MRData']['RaceTable']['Races'][$i]['raceName'];
          $circuitName = $data['MRData']['RaceTable']['Races'][$i]['Circuit']['circuitName'];
          $raceDate1 = $data['MRData']['RaceTable']['Races'][$i]['date'];
          $raceDate2 = $data['MRData']['RaceTable']['Races'][$i]['FirstPractice']['date'];
          $mes = substr($raceDate1 , 5, 2);
          $dia1 = substr($raceDate1 , 8, 2);
          $dia2 = substr($raceDate2 , 8, 2);
          $circuitImg = str_replace(" ", "", $raceName);
          $pais = $data['MRData']['RaceTable']['Races'][$i]['Circuit']['Location']['country'];
          if($pais === "UK"){
            $pais = "united-kingdom";
          }else if($pais === "USA"){
            $pais = "united-states";
          }else if($pais === "UAE"){
            $pais = "united-arab-emirates";
          }
          if(str_contains($pais, " ")){
            $pais = strtolower($pais);
            $pais = str_replace(" ","-",$pais);
          }
          echo '
                <div class="race-container">
                    <div class="race-container-round">
                        <h1>ROUND '.($i+1).'</h1>
                    </div>
                    <div class="race-container-title">
                        <h1>'.$dia2.'-'.$dia1.' '.dameMes($mes).'</h1>
                        <img src="https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Flags%2016x9/'.$pais.'-flag.png.transform/2col/image.png" alt="">
                    </div>
                    <div class="race-container-desc">
                        <h1>'.$raceName.'</h1>
                        <p>'.$circuitName.'</p>
                    </div>
                    <div class="race-container-img">
                        <img src="Images/Tracks/'.$circuitImg.'.png" alt="">
                    </div>
                </div>';
            
        }
        ?>
      </article>
    </section>
  </body>
</html>
