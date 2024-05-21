<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F1 Drivers - Motoring Community</title>
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT PRINCIPAL PAGINA-->
  <script defer src="JS/script.js"></script>
  <!--HOJA DE ESTILOS DRIVERS-->
  <link rel="stylesheet" href="CSS/drivers.css">
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php";
  /*IMPLEMENTAR ARCHIVO QUE NOS DEVUELVE TODOS LOS PILOTOS*/
  include "PHP/returnDrivers.php";
  ?>
  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="Up Arrow" />
  </button>
  <section class="main">
    <article class="card-driver-container">
      <?php
      /*BUCLE QUE EN SU ITERACION SE CREAN LAS TARJETAS Y SE MUESTRA LA INFORMACION DEL ARRAY*/
      for ($i = 0; $i < sizeof($clasificacionesPilotos); $i++) {
        $team = $clasificacionesPilotos[$i]["Constructors"][0]["name"];
        $team = str_replace(' ', '', $team);
        echo '
      <div class="card-driver" style=" 
          box-shadow: 0 0 2px black, 0 0 10px black, 0 0 20px var(--' . $team . '), 0 0 30px var(--' . $team . '), 
          0 0 40px var(--' . $team . '), 0 0 50px var(--' . $team . '); 
          background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(\'https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/' . $clasificacionesPilotos[$i]["Driver"]["familyName"] . '.png\');
      ">';
        echo '<div class="driver-image" >
       <img src="Images/DriversPNG/' . $clasificacionesPilotos[$i]["Driver"]["familyName"] . '.png" alt="Driver Image">
     </div>
     <div class="card-driver-info">
       <div class="driverNumber">
         <h1>' . $clasificacionesPilotos[$i]["Driver"]["permanentNumber"] . '</h1>
         <h1>' . $clasificacionesPilotos[$i]["Driver"]["code"] . '</h1>
       </div>
       <div class="driver-data">
         <div class="driverHelmet">
           <img src="https://media.formula1.com/content/dam/fom-website/manual/Helmets2024/' . $clasificacionesPilotos[$i]["Driver"]["familyName"] . '.png" alt="Driver Helmet">
         </div>
         <div class="driverFlag">
           <img src="https://media.formula1.com/content/dam/fom-website/flags/' . nacionalidadAPais($clasificacionesPilotos[$i]["Driver"]["nationality"]) . '.jpg" alt="Country Flag">
         </div>
       </div>
     </div>
     <div class="card-driver-name">
       <h1 class="name">' . $clasificacionesPilotos[$i]["Driver"]["givenName"] . '</h1>
       <h1 class="surname">' . $clasificacionesPilotos[$i]["Driver"]["familyName"] . '</h1>
     </div>
   </div>
     ';
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
  tituloPrincipal.textContent = "Formula One 2024 Drivers";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('https://cdn.topgear.es/sites/navi.axelspringer.es/public/media/image/2023/03/fernando-alonso-aston-martin-f1-2975194.jpg?tf=1200x')";
</script>

</html>