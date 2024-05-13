<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motoring Community - Forum</title>
  <!-- Link al archivo CSS -->
</head>

<body>
  <link rel="stylesheet" href="CSS/forum.css" />

  <section class="main">
    <article class="posts-container" id="postsContainer">
      <div class="main-bar">
        <div class="main-bar-filter">
          <div class="select">
            <select id="filter">
              <option value="Default">Default</option>
              <option value="Popularity">Popularity</option>
              <option value="Views">Views</option>
              <option value="Newest">Newest</option>
            </select>
          </div>
        </div>
        <div class="main-bar-search">
          <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
              <g>
                <path
                  d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                </path>
              </g>
            </svg>
            <input placeholder="Search" type="search" class="input" />
          </div>
        </div>
        <div class="main-bar-add">
          <button class="button-add" role="button">Add new Theme</button>
        </div>
      </div>
      <div class="posts-container-info">
        <h1 id="orderP">Order by: Default.</h1>
        <h1 id="countPostP">Showing: 19 Posts.</h1>
      </div>
      <div id="posts-group" class="posts-group">
        <?php
        include "PHP/Forum/returnThemes.php";
        $themes = returnThemesByDefault();
        for ($i = 0; $i < sizeof($themes); $i++) {
          echo '<div id="post-card-container" class="post-card-container">
          <div class="post-card">
            <div class="post-card-1">
              <h1>Posted by: ' . returnNombreUsu($themes[$i][3]) . '</h1>
              <p>Posted on: ' . $themes[$i][2] . '</p>
            </div>
            <div class="post-card-2">
              <div class="post-card-3">
                <h1>
                ' . $themes[$i][1] . '
                </h1>
              </div>
              <div class="post-card-4">
                <div class="post-card-5">
                  <p id="pLimit">
                    ' . returnLastPost($themes[$i][0]) . '
                  </p>
                </div>
                <div class="post-card-6">
                  <div class="post-card-views">
                    <img src="Images/view.svg" alt="" />
                    <p>16</p>
                  </div>
                  <div class="post-card-msg">
                    <img src="Images/msg.svg" alt="" />
                    <p>' . returnNumberPosts($themes[$i][0]) . '</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
        }
        ?>
      </div>
      <div class="pagination" id="pagination">
        <h1>Page:</h1>
      </div>
    </article>
  </section>
  <?php
  include "footer.php";
  ?>
</body>
<script>
  pagination();
  function pagination() {
      let postsContainer = document.getElementById("posts-group");
      let pagination = document.getElementById("pagination");
      let postContainers = document.querySelectorAll(".post-card-container");
      let postsPerPage = 2;
      let numPages = Math.ceil(postContainers.length / postsPerPage);
      let currentPage = 1;

      // Mostrar las tarjetas para la página actual
      function showPage(pageNum) {
        let start = (pageNum - 1) * postsPerPage;
        let end = start + postsPerPage;

        postContainers.forEach(function (container, index) {
          if (index >= start && index < end) {
            container.style.display = "flex";
          } else {
            container.style.display = "none";
          }
        });
      }

      // Generar botones de paginación
      for (let i = 1; i <= numPages; i++) {
        let button = document.createElement("button");
        button.textContent = "Page: " + i;
        button.addEventListener("click", function () {
          currentPage = parseInt(this.textContent.split(":")[1].trim());
          showPage(currentPage);
        });
        pagination.appendChild(button);
      }

      // Mostrar la primera página por defecto
      showPage(currentPage);

      let filterSelect = document.getElementById("filter");
      let orderP = document.getElementById("orderP");

      // Agregar un event listener para el evento "change" del select
      filterSelect.addEventListener("change", function () {
        // Obtener el valor seleccionado
        let selectedValue = this.value;

        // Actualizar el contenido del párrafo con el valor seleccionado
        orderP.textContent = "Order by: " + selectedValue + ".";
      });

      actualizarPostP();
    
  }

  function actualizarPostP() {
    let totalPosts = document.querySelectorAll(".post-card-container");
    countPost = "Showing: " + totalPosts.length + " Posts.";

    let countPostP = document.getElementById("countPostP");
    countPostP.textContent = countPost;
  }

  let filter = document.getElementById("filter");
  filter.addEventListener("change", () => {
    let selectedValue = filter.value;
    let postsGrupo = document.getElementById("posts-group");
    let orderP = document.getElementById("orderP");
    let tipo = "";

    switch (selectedValue) {
      case "Newest":
        tipo = "Newest"
        break;
      case "Popularity":
        tipo = "Popularity"
        break;
      case "Views":
        tipo = "Views"
        break;
      default:
        tipo = "Default";
        break;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var themes = JSON.parse(this.responseText); // Parsear JSON a objeto JavaScript
        console.log(themes);
        let postsGroup = document.getElementById("posts-group");
        postsGroup.innerHTML = "";

        themes.forEach(function (theme) {
          var postCardContainer = document.createElement("div");
          postCardContainer.className = "post-card-container";

          var postCard = document.createElement("div");
          postCard.className = "post-card";

          var postCard1 = document.createElement("div");
          postCard1.className = "post-card-1";
          postCard1.innerHTML = "<h1>Posted by: " + theme[3] + "</h1><p>Posted on: " + theme[2] + "</p>";

          var postCard2 = document.createElement("div");
          postCard2.className = "post-card-2";

          var postCard3 = document.createElement("div");
          postCard3.className = "post-card-3";
          postCard3.innerHTML = "<h1>" + theme[1] + "</h1>";

          var postCard4 = document.createElement("div");
          postCard4.className = "post-card-4";

          var postCard5 = document.createElement("div");
          postCard5.className = "post-card-5";
          postCard5.innerHTML = "<p id='pLimit'>" + theme[5] + "</p>";

          var postCard6 = document.createElement("div");
          postCard6.className = "post-card-6";

          var postCardViews = document.createElement("div");
          postCardViews.className = "post-card-views";
          postCardViews.innerHTML = "<img src='Images/view.svg' alt='' /><p>16</p>";

          var postCardMsg = document.createElement("div");
          postCardMsg.className = "post-card-msg";
          postCardMsg.innerHTML = "<img src='Images/msg.svg' alt='' /><p>" + theme[4] + "</p>";

          postCard6.appendChild(postCardViews);
          postCard6.appendChild(postCardMsg);
          postCard4.appendChild(postCard5);
          postCard4.appendChild(postCard6);
          postCard2.appendChild(postCard3);
          postCard2.appendChild(postCard4);
          postCard.appendChild(postCard1);
          postCard.appendChild(postCard2);
          postCardContainer.appendChild(postCard);
          postsGroup.appendChild(postCardContainer);
        });

        actualizarPostP();

      }
    };
    xhttp.open("POST", "PHP/Forum/returnThemes.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('filter=' + tipo);

  });

  function mostrarPosts(theme) {

  }
</script>

</html>