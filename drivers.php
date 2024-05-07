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
  include "header.php"
    ?>

  <section class="main">
    <article class="drivers-title-container">
      <h1 class="drivers-title">2024 Formula One Drivers</h1>
    </article>
    <article class="card-driver-container">

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

</html>