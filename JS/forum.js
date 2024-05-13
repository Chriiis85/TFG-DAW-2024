/* pagination();
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

  }*/

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

  let search = document.getElementById("search");
  search.addEventListener("input", () => {
    console.log(search.value);
    searchTheme(search.value);
  });

  function searchTheme(letra) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var themes = JSON.parse(this.responseText); // Parsear JSON a objeto JavaScript
        console.log(themes);
        let postsGroup = document.getElementById("posts-group");
        postsGroup.innerHTML = "";

        if (themes.length == 0) {
          //alert("Hola");
          let postsGroup = document.getElementById("posts-group");
          let postContainer = document.createElement("div"); // Crear un nuevo contenedor
          postContainer.id = "post-card-container";
          let imagen = document.createElement("img");
          let divimg = document.createElement("div");
          imagen.setAttribute("src", "https://cdn.dribbble.com/users/1883357/screenshots/6016190/search_no_result.png");
          imagen.classList.add("img-noresult");
          divimg.appendChild(imagen);
          postContainer.appendChild(divimg);
          postsGroup.appendChild(postContainer); // Agregar el nuevo contenedor al DOM
        }


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
    xhttp.open("POST", "PHP/Forum/search_theme.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("letra=" + letra);
  }