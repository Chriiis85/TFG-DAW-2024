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
deleteBtn();
editBtn();
jqueryModal();
actualizarPostP();
function getCookie(name) {
  let nameEQ = name + "=";
  let ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
function jqueryModal(){
$(document).ready(function () {
  $("#newTheme").on("click", function () {
    // Abre el modal al hacer clic
    $("#new-theme-modal").modal({
      fadeDuration: 300,
      escapeClose: false,
      clickClose: false,
    });
  });

  $(".editThemeBtn").on("click", function () {
    // Abre el modal al hacer clic
    $("#edit-theme-modal").modal({
      fadeDuration: 300,
      escapeClose: false,
      clickClose: false,
    });
  });

  $("#privacyTheme").on("click", function () {
    // Abre el modal al hacer clic
    $("#new-theme-privacy").modal({
      fadeDuration: 300,
      escapeClose: false,
      clickClose: false,
    });
  });

  $("#privacyThemeEdit").on("click", function () {
    // Abre el modal al hacer clic
    $("#new-theme-privacy").modal({
      fadeDuration: 300,
      escapeClose: false,
      clickClose: false,
    });
  });

  $("#CloseThemeBtn").on("click", function () {
    $.modal.close();
  });

  $("#CloseEditThemeBtn").on("click", function () {
    $.modal.close();
  });
});
}

let addTheme = document
  .getElementById("addThemeBtn")
  .addEventListener("click", () => {
    let nameTheme = document.getElementById("Theme_Name");
    let cbxTheme = document.getElementById("cbx-46");
    let cbxError = document.getElementById("cbxError");
    let nameError = document.getElementById("nameError");

    if (!cbxTheme.checked) {
      cbxError.style.display = "block";
    }
    if (nameTheme.value == "") {
      nameError.style.display = "block";
    }

    if (cbxTheme.checked) {
      cbxError.style.display = "none";
    }
    if (!nameTheme.value == "") {
      nameError.style.display = "none";
    }

    if (!nameTheme.value == "" && cbxTheme.checked) {
      Swal.fire({
        title: "Do you want to create the new Theme?",
        text: "New theme name: " + nameTheme.value,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        confirmButtonText: "Confirm!",
        cancelButtonText: "No, go back.",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.isConfirmed) {
          let username = getCookie("username");
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
              if (this.status == 200) {
                if (this.responseText == 1) {
                  Swal.fire({
                    title: "Theme Created!",
                    text: "The theme was created successfully.",
                    icon: "success",
                    showConfirmButton: true,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire("Error!", "Theme not created.", "error");
                }
              } else {
                Swal.fire("Error!", "Theme not created.", "error");
              }
            }
          };
          xhttp.open("POST", "PHP/Forum/insertTheme.php", true);
          xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhttp.send(
            "name=" +
              encodeURIComponent(nameTheme.value) +
              "&username=" +
              username
          );
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });
    }
  });

let logout = document.getElementById("logout");
logout.addEventListener("click", () => {
  document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  Swal.fire({
    title: "Do you want to Log Out?",
    text: "Login Out: ",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Confirm!",
    cancelButtonText: "No, go back.",
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Login Out!",
        text: "Come back Soon!.",
        icon: "success",
        showConfirmButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      });
    } else {
      Swal.fire("Cancelled", "Coming Back.", "info");
    }
  });
});

function editBtn() {
  let editBtn = document.querySelectorAll(".editThemeBtn");
  for (const btnEdit of editBtn) {
    btnEdit.addEventListener("click", () => {
      event.stopPropagation();
      let id_theme = btnEdit.id;
      id_theme = id_theme.split("-")[1];

      let ConfirmeditBtn = document
        .getElementById("editThemeBtn")
        .addEventListener("click", () => {
          let nameTheme = document.getElementById("New_Theme_Name");
          let cbxTheme = document.getElementById("cbx-462");
          let cbxError = document.getElementById("cbxErrorEdit");
          let nameError = document.getElementById("nameErrorEdit");

          let ThemeName = document.getElementById("nameTheme-" + id_theme);
          if (!cbxTheme.checked) {
            cbxError.style.display = "block";
          }
          if (nameTheme.value == "") {
            nameError.style.display = "block";
          }

          if (cbxTheme.checked) {
            cbxError.style.display = "none";
          }
          if (!nameTheme.value == "") {
            nameError.style.display = "none";
          }

          if (!nameTheme.value == "" && cbxTheme.checked) {
            Swal.fire({
              title:
                "Do you want to edit this Theme: " +
                ThemeName.textContent +
                " ?",
              text: "New theme name: " + nameTheme.value,
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "green",
              confirmButtonText: "Confirm!",
              cancelButtonText: "No, go back.",
              allowOutsideClick: false,
            }).then((result) => {
              if (result.isConfirmed) {
                let username = getCookie("username");
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                  if (this.readyState == 4) {
                    if (this.status == 200) {
                      if (this.responseText == 1) {
                        Swal.fire({
                          title: "Theme Edited!",
                          text: "The theme was edited successfully.",
                          icon: "success",
                          showConfirmButton: true,
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                      } else {
                        Swal.fire("Error!", "Theme not edited.", "error");
                      }
                    } else {
                      Swal.fire("Error!", "Theme not edited.", "error");
                    }
                  }
                };
                xhttp.open("POST", "PHP/Forum/editTheme.php", true);
                xhttp.setRequestHeader(
                  "Content-type",
                  "application/x-www-form-urlencoded"
                );
                xhttp.send(
                  "name=" +
                    encodeURIComponent(nameTheme.value) +
                    "&id_theme=" +
                    id_theme
                );
              } else {
                Swal.fire("Cancelled", "Operation cancelled.", "info");
              }
            });
          }
        });
    });
  }
}

function deleteBtn() {
  let deleteBtn = document.querySelectorAll(".deleteThemeBtn");
  for (const btnDelete of deleteBtn) {
    btnDelete.addEventListener("click", () => {
      event.stopPropagation();
      let id_theme = btnDelete.id;
      id_theme = id_theme.split("-")[1];

      let nameTheme = document.getElementById("nameTheme-" + id_theme);

      Swal.fire({
        title: "Do you want to delete this Theme?",
        text: "Deleting theme: '" + nameTheme.textContent + "'",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        confirmButtonText: "Confirm!",
        cancelButtonText: "No, go back.",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.isConfirmed) {
          let username = getCookie("username");
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
              if (this.status == 200) {
                if (this.responseText == 1) {
                  Swal.fire({
                    title: "Theme Deleted!",
                    text: "The theme was deleted successfully.",
                    icon: "success",
                    showConfirmButton: true,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire("Error!", "Theme not deleted.", "error");
                }
              } else {
                Swal.fire("Error!", "Theme not deleted.", "error");
              }
            }
          };
          xhttp.open("POST", "PHP/Forum/deleteTheme.php", true);
          xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhttp.send("id_theme=" + id_theme);
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });
    });
  }
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
      tipo = "Newest";
      break;
    case "Popularity":
      tipo = "Popularity";
      break;
    case "Views":
      tipo = "Views";
      break;
    default:
      tipo = "Default";
      break;
  }
  orderP.textContent = "Order by: "+tipo+".";
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
        postCard.onclick = function () {
          window.location.href = "forumPosts.php?id=" + theme[0];
        };

        var postCard1 = document.createElement("div");
        postCard1.className = "post-card-1";
        postCard1.innerHTML =
          "<h1>Posted by: " +
          theme[3] +
          "</h1><p>Posted on: " +
          theme[2] +
          "</p>";

        var postCard2 = document.createElement("div");
        postCard2.className = "post-card-2";

        var postCard3 = document.createElement("div");
        postCard3.className = "post-card-3";
        postCard3.innerHTML =
        "<h1 id='nameTheme-" + theme[0] + "'>" + theme[1] + "</h1>"

        var postCard4 = document.createElement("div");
        postCard4.className = "post-card-4";

        var postCard5 = document.createElement("div");
        postCard5.className = "post-card-5";
        postCard5.innerHTML = "<p id='pLimit'>" + theme[5] + "</p>";

        var postCard6 = document.createElement("div");
        postCard6.className = "post-card-6";

        var postCard6Info = document.createElement("div");
        postCard6Info.className = "post-card-6-info";

        /*var postCardViews = document.createElement("div");
        postCardViews.className = "post-card-views";
        postCardViews.innerHTML =
          "<img src='Images/view.svg' alt='' /><p>16</p>";*/

        var postCardMsg = document.createElement("div");
        postCardMsg.className = "post-card-msg";
        postCardMsg.innerHTML =
          "<img src='Images/msg.svg' alt='' /><p>" + theme[4] + "</p>";

        var postCard6Edit = document.createElement("div");
        postCard6Edit.className = "post-card-6-edit";

        var postCardDeleteBtn = document.createElement("button");
        postCardDeleteBtn.className = "deleteThemeBtn";
        postCardDeleteBtn.innerHTML = "<img src='Images/delete.svg' alt='' />";
        postCardDeleteBtn.setAttribute("id", "deleteCard-" + theme[0]);

        var postCardEditBtn = document.createElement("button");
        postCardEditBtn.className = "editThemeBtn";
        postCardEditBtn.innerHTML = "<img src='Images/edit.svg' alt='' />";
        postCardEditBtn.setAttribute("id", "editCard-" + theme[0]);

        //postCard6Info.appendChild(postCardViews);
        postCard6Info.appendChild(postCardMsg);
        postCard6.appendChild(postCard6Info);

        let user = getCookie("username");
        if(theme[3] == user){
        postCard6Edit.appendChild(postCardEditBtn);
        postCard6Edit.appendChild(postCardDeleteBtn);
        postCard6.appendChild(postCard6Edit);
        }
        


        postCard4.appendChild(postCard5);
        postCard4.appendChild(postCard6);
        postCard2.appendChild(postCard3);
        postCard2.appendChild(postCard4);
        postCard.appendChild(postCard1);
        postCard.appendChild(postCard2);
        postCardContainer.appendChild(postCard);
        postsGroup.appendChild(postCardContainer);
      });
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };
  xhttp.open("POST", "PHP/Forum/returnThemes.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("filter=" + tipo);
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
        imagen.setAttribute(
          "src",
          "https://cdn.dribbble.com/users/1883357/screenshots/6016190/search_no_result.png"
        );
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
        postCard.onclick = function () {
          window.location.href = "forumPosts.php?id=" + theme[0];
        };

        var postCard1 = document.createElement("div");
        postCard1.className = "post-card-1";
        postCard1.innerHTML =
          "<h1>Posted by: " +
          theme[3] +
          "</h1><p>Posted on: " +
          theme[2] +
          "</p>";

        var postCard2 = document.createElement("div");
        postCard2.className = "post-card-2";

        var postCard3 = document.createElement("div");
        postCard3.className = "post-card-3";
        postCard3.innerHTML =
        "<h1 id='nameTheme-" + theme[0] + "'>" + theme[1] + "</h1>"

        var postCard4 = document.createElement("div");
        postCard4.className = "post-card-4";

        var postCard5 = document.createElement("div");
        postCard5.className = "post-card-5";
        postCard5.innerHTML = "<p id='pLimit'>" + theme[5] + "</p>";

        var postCard6 = document.createElement("div");
        postCard6.className = "post-card-6";

        var postCard6Info = document.createElement("div");
        postCard6Info.className = "post-card-6-info";

        /*var postCardViews = document.createElement("div");
        postCardViews.className = "post-card-views";
        postCardViews.innerHTML =
          "<img src='Images/view.svg' alt='' /><p>16</p>";*/

        var postCardMsg = document.createElement("div");
        postCardMsg.className = "post-card-msg";
        postCardMsg.innerHTML =
          "<img src='Images/msg.svg' alt='' /><p>" + theme[4] + "</p>";

        var postCard6Edit = document.createElement("div");
        postCard6Edit.className = "post-card-6-edit";

        var postCardDeleteBtn = document.createElement("button");
        postCardDeleteBtn.className = "deleteThemeBtn";
        postCardDeleteBtn.innerHTML = "<img src='Images/delete.svg' alt='' />";
        postCardDeleteBtn.setAttribute("id", "deleteCard-" + theme[0]);

        var postCardEditBtn = document.createElement("button");
        postCardEditBtn.className = "editThemeBtn";
        postCardEditBtn.innerHTML = "<img src='Images/edit.svg' alt='' />";
        postCardEditBtn.setAttribute("id", "editCard-" + theme[0]);

        //postCard6Info.appendChild(postCardViews);
        postCard6Info.appendChild(postCardMsg);
        postCard6.appendChild(postCard6Info);

        let user = getCookie("username");
        if(theme[3] == user){
        postCard6Edit.appendChild(postCardEditBtn);
        postCard6Edit.appendChild(postCardDeleteBtn);
        postCard6.appendChild(postCard6Edit);
        }
        


        postCard4.appendChild(postCard5);
        postCard4.appendChild(postCard6);
        postCard2.appendChild(postCard3);
        postCard2.appendChild(postCard4);
        postCard.appendChild(postCard1);
        postCard.appendChild(postCard2);
        postCardContainer.appendChild(postCard);
        postsGroup.appendChild(postCardContainer);
      });
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };
  xhttp.open("POST", "PHP/Forum/search_theme.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("letra=" + letra);
}

