<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header - Motoring Community</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="JS/header.js"></script>
  <link rel="stylesheet" href="CSS/header.css" />
</head>

<body>
  <section id="header-container" class="header-container">
    <article class="header">
      <div class="header-container1">
        <h1 onclick="window.location.href = 'index.html'">
          MOTORING COMMUNITY
        </h1>
      </div>
      <div class="header-container2">
        <p class="progress-bar" id="formulaone">
          FORMULA ONE &nbsp;&nbsp;<img src="Images/down-arrow-svgrepo-com.svg" alt="Down Arrow" />
        </p>
        <p onclick="window.location.href = 'data.php'" class="progress-bar">
          HISTORIC DATA
        </p>
        <p onclick="window.location.href = 'standings.php'">SEASON STANDINGS</p>
        <p>FORUM</p>
      </div>
      <div class="header-container3"></div>
    </article>

    <div id="header-drop-container-formulaone" class="header-drop-container">
      <div class="header-drop-container-options">
        <h1>Formula One <div class="header-drop-container-line"></div>
        </h1>
      </div>
      <div class="header-drop-container-options">
        <h3 onclick="window.location.href = 'aboutf1.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />About Formula One</h3>
      </div>
      <div class="header-drop-container-options2">
        <p onclick="window.location.href = 'drivers.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Drivers</p>
        <p onclick="window.location.href = 'teams.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Constructors</p>
        <p onclick="window.location.href = 'calendar.php'"><img src="Images/down-arrow-svgrepo-com.svg"
            alt="Down Arrow" />Season Calendar</p>
      </div>
    </div>
    <h1 id="title-header" class="title-header-container"></h1>
  </section>
</body>

</html>