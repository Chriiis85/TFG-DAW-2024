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
  <!--HOJA DE ESTILOS ABOUT F1-->
  <link rel="stylesheet" href="CSS/aboutf1.css" />
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php"
    ?>
  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="Up Arrow" aria-label="Scroll to top"/>
  </button>
  <!--SECCION MAIN DE LA PAGINA CON LOS CONTENEDORES DENTRO Y BOTONES QUE REDIRIGEN A LAS OTRAS SECCIONES-->
  <section class="main" role="main">
    <article class="main-about">
      <h1>About Formula One</h1>
      <p>
        Formula One, commonly known as Formula 1 or F1, is the highest class
        of international racing for open-wheel single-seater formula racing
        cars sanctioned by the Fédération Internationale de l'Automobile
        (FIA). The FIA Formula One World Championship has been one of the
        world's premier forms of racing since its inaugural running in 1950.
        The word formula in the name refers to the set of rules all
        participants' cars must follow. A Formula One season consists of a
        series of races, known as Grands Prix. Grands Prix take place in
        multiple countries and continents on either purpose-built circuits or
        closed public roads.
      </p>
      <p>
        A point-system is used at Grands Prix to determine two annual World
        Championships: one for the drivers, and one for the constructors (the
        teams). Each driver must hold a valid Super Licence, the highest class
        of racing licence the FIA issues, and the races must be held on grade
        one tracks, the highest grade rating the FIA issues for tracks.
      </p>
      <h1>Who are the F1 teams?</h1>
      <p>
        A Formula One constructor is the entity credited for designing the
        chassis and the engine. If both are designed by the same company, that
        company receives sole credit as the constructor (e.g., Ferrari). If
        they are designed by different companies, both are credited, and the
        name of the chassis designer is placed before that of the engine
        designer (e.g., McLaren-Mercedes). All constructors are scored
        individually, even if they share either chassis or engine with another
        constructor (e.g., Williams-Ford, Williams-Honda in 1983).
      </p>
      <p>
        Since 1981, Formula One teams have been required to build the chassis
        in which they compete, and consequently the distinction between the
        terms "team" and "constructor" became less pronounced, though engines
        may still be produced by a different entity. This requirement
        distinguishes the sport from series such as the IndyCar Series which
        allows teams to purchase chassis, and "spec series" such as Formula 2
        which require all cars be kept to an identical specification. It also
        effectively prohibits privateers, which were common even in Formula
        One well into the 1970s.
      </p>
      <br />
      <div class="about-teams-container1">
        <div class="about-teams1">
          <button class="about-button" title="Go to Teams Page" onclick="window.location.href = 'teams.php'" class="teams-button" aria-label="Meet the Teams">
            Meet the Teams
          </button>
        </div>
      </div>
      <h1>Who are the drivers?</h1>
      <p>
        Every team in Formula One must run two cars in every session in a
        Grand Prix weekend, and every team may use up to four drivers in a
        season. A team may also run two additional drivers in Free Practice
        sessions, which are often used to test potential new drivers for a
        career as a Formula One driver or gain experienced drivers to evaluate
        the car. Most drivers are contracted for at least the duration of a
        season, with driver changes taking place in-between seasons, in
        comparison to early years when drivers often competed on an ad hoc
        basis from race to race.
      </p>
      <p>
        Each competitor must be in the possession of a FIA Super Licence to
        compete in a Grand Prix, which is issued to drivers who have met the
        criteria of success in junior motorsport categories and having
        achieved 300 kilometres (190 mi) of running in a Formula One car.
        Drivers may also be issued a Super Licence by the World Motor Sport
        Council if they fail to meet the criteria. Although most drivers earn
        their seat on ability, commercial considerations also come into play
        with teams having to satisfy sponsors and financial demands.
      </p>
      <div class="about-teams-container2">
        <div class="about-teams2">
          <button class="about-button" title="Go to Drivers Page" onclick="window.location.href = 'drivers.php'" class="drivers-button" aria-label="Meet the Drivers">
            Meet the Drivers
          </button>
        </div>
      </div>

      <h1>What is the calendar?</h1>
      <p>
        Every year, several Grand Prix races are organized in different parts
        of the world. In the 2022 season, the number was 22 Grand Prix races,
        and in 2019, it was 21, for example. Previously, championships were
        shorter, and the number of Grand Prix races has been progressively
        increasing. In the early days, championships averaged around 10-11
        Grand Prix races. In the 80s and 90s, the number of Grand Prix races
        was around 13-15.
      </p>
      <p>
        The competition takes place over the weekend and lasts for three days.
        On Friday, there are two sessions of free practice, where the drivers
        test and adjust their cars to the circuit, both in terms of settings
        and tires. On Saturday, another practice session takes place, followed
        by the qualifying session.
      </p>
      <p>
        On Sunday, the race takes place. The cars are lined up on the grid
        thirty minutes before the standard scheduled start time of the Grand
        Prix, typically at 13:00 GMT, although occasionally the timings may
        vary, primarily for broadcasting convenience in Europe, especially
        when races are held in Asia or Oceania.
      </p>
      <div class="about-teams-container3">
        <div class="about-teams3">
          <button class="about-button" title="Go to Calendar Page" onclick="window.location.href = 'calendar.php'" class="drivers-button" aria-label="Meet the Calendar">
            Meet the Calendar
          </button>
        </div>
      </div>
    </article>
  </section>

  <!--IMPLEMENTAR FOOTER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "footer.php"
    ?>
</body>
<!--SCRIPT QUE DEFINE EL TITULO DE LA PAGINA EN EL HEADER Y ESTABLECE LA IMAGEN DE FONDO DE LA CABECERA-->
<script>
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "About Formula One 2024";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://www.f1-fansite.com/wp-content/uploads/2023/06/SI202306040579.jpg')";

</script>

</html>