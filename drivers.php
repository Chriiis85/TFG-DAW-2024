<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Drivers - Motoring Community</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="JS/script.js"></script>
  <link rel="stylesheet" href="CSS/drivers.css">
  <link rel="stylesheet" href="CSS/header.css">
  <link rel="stylesheet" href="CSS/footer.css">

</head>

<body>
  <?php
  include "header.php";
  include "PHP/returnDrivers.php";
  ?>

  <section class="main">
    <!--<article class="drivers-title-container">
      <h1 class="drivers-title">2024 Formula One Drivers</h1>
    </article>-->
    <article class="card-driver-container">

    <?php
    for ($i=0; $i < sizeof($clasificacionesPilotos); $i++) { 
      $team = $clasificacionesPilotos[$i]["Constructors"][0]["name"];
      $team  =str_replace(' ', '', $team );
      echo '
      <div class="card-driver" style=" 
          box-shadow: 0 0 2px black, 0 0 10px black, 0 0 20px var(--'.$team.'), 0 0 30px var(--'.$team.'), 
          0 0 40px var(--'.$team.'), 0 0 50px var(--'.$team.'); 
          background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(\'https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/'.$clasificacionesPilotos[$i]["Driver"]["familyName"].'.png\');
      ">';
     echo'<div class="driver-image" >
       <img src="Images/DriversPNG/'.$clasificacionesPilotos[$i]["Driver"]["familyName"].'.png" alt="">
     </div>
     <div class="card-driver-info">
       <div class="driverNumber">
         <h1>'.$clasificacionesPilotos[$i]["Driver"]["permanentNumber"].'</h1>
         <h1>'.$clasificacionesPilotos[$i]["Driver"]["code"].'</h1>
       </div>
       <div class="driver-data">
         <div class="driverHelmet">
           <img src="https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/'.$clasificacionesPilotos[$i]["Driver"]["familyName"].'.png" alt="">
         </div>
         <div class="driverFlag">
           <img src="https://media.formula1.com/content/dam/fom-website/flags/'.nacionalidadAPais($clasificacionesPilotos[$i]["Driver"]["nationality"]).'.jpg" alt="">
         </div>
       </div>
     </div>
     <div class="card-driver-name">
       <h1 class="name">'.$clasificacionesPilotos[$i]["Driver"]["givenName"].'</h1>
       <h1 class="surname">'.$clasificacionesPilotos[$i]["Driver"]["familyName"].'</h1>
     </div>
   </div>
     ';
    }
    ?>
    </article>
  </section>
  <?php
  include "footer.php";
  ?>
</body>
<script>
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One 2024 Drivers";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://cdn.topgear.es/sites/navi.axelspringer.es/public/media/image/2023/03/fernando-alonso-aston-martin-f1-2975194.jpg?tf=1200x')";
</script>
<?php
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
?>
</html>