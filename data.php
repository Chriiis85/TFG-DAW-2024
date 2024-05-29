<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data & Analysis - Motoring Community</title>
  <!--SCRIPT JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!--SCRIPT DATA-->
  <script defer src="JS/data.js"></script>
  <!--HOJA DE ESTILOS DATA-->
  <link rel="stylesheet" href="CSS/data.css" />
</head>

<body>
  <!--IMPLEMENTAR HEADER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "header.php"
    ?>
  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->

  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="Up Arrow" />
  </button>
  <section class="data-container">
  <article class="data">
    <!--FILTROS PARA LA BUSQUEDA-->
    <div class="data-select">
      <div class="select">
        <select id="select1" aria-label="Select Option 1"></select>
      </div>
      <div class="select">
        <select id="select2" aria-label="Select Option 2">
          <option value="Constructors">Constructors Standings</option>
          <option value="Drivers">Drivers Standings</option>
          <option value="Race">Race Result</option>
        </select>
      </div>
      <div id="select3Group" class="select">
        <select id="select3" aria-label="Select Option 3"></select>
      </div>
    </div>
    <!--CONTENEDOR PARA LA TABLA DONDE SE MOSTRARÁ LA INFORMACIÓN-->
    <div class="data-content">
      <h1 id="title">2024 Driver Standings</h1>
      <div class="data-table" aria-labelledby="title">
        <table id="tabla" class="content-table">
          <thead id="tabla-thead"></thead>
          <tbody id="tabla-tbody"></tbody>
        </table>
      </div>
    </div>
  </article>
</section>
  <!--IMPLEMENTAR FOOTER IGUAL QUE EN TODAS LAS PAGINAS-->
  <?php
  include "footer.php"
    ?>
</body>
<script>
  //SCRIPT QUE DEFINE EL TITULO DE LA PAGINA EN EL HEADER Y ESTABLECE LA IMAGEN DE FONDO DE LA CABECERA-->
  let tituloPrincipal = document.getElementById("title-header");
  tituloPrincipal.textContent = "Formula One Historic Data";

  let headerContainer = document.getElementById("header-container");
  headerContainer.style.backgroundImage = "url('  https://static01.nyt.com/images/2019/07/13/sports/13sp-scene-inyt1/13sp-scene-inyt1-videoSixteenByNineJumbo1600.jpg')";
</script>

</html>