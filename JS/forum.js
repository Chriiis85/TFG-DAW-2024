//FUNCIONES QUE CONTIENEN LA FUNCIONALIDAD DE ELIMINAR Y BORAR, LOS MODAL PARA LAS ACCIONES
deleteBtn();
editBtn();
jqueryModal();
actualizarPostP();

//FUNCION QUE PERMITE RECOGER Y OBTENER UNA COOKIE
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

//FUNCION QUE LLAMA A LAS ACCIONES CUANDO SE CLICA Y A DE ABRIRSE UN MODAL POR MEDIO DE JQUERY
function jqueryModal() {
  $(document).ready(function () {
    $("#newTheme").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL DON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      //PARA MEJORAR LA ACCESIBILIDAD SE CIERRA TAMBIEN MEDIANTE LA TECLA ESC O CLICANDO FUERA DEL MISMO
      $("#new-theme-modal").modal({
        fadeDuration: 300,
        escapeClose: true,
        clickClose: true,
      });
    });

    $(".editThemeBtn").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL CON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      //PARA MEJORAR LA ACCESIBILIDAD SE CIERRA TAMBIEN MEDIANTE LA TECLA ESC O CLICANDO FUERA DEL MISMO
      $("#edit-theme-modal").modal({
        fadeDuration: 300,
        escapeClose: true,
        clickClose: true,
      });
    });

    $("#privacyTheme").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL DON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      //PARA MEJORAR LA ACCESIBILIDAD SE CIERRA TAMBIEN MEDIANTE LA TECLA ESC O CLICANDO FUERA DEL MISMO
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: true,
        clickClose: true,
      });
    });

    $("#privacyThemeEdit").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL DON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      //PARA MEJORAR LA ACCESIBILIDAD SE CIERRA TAMBIEN MEDIANTE LA TECLA ESC O CLICANDO FUERA DEL MISMO
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: true,
        clickClose: true,
      });
    });

    //AL CLICAR SOBRE EL CLOSE BTN SE CIERRA EL MODAL
    $("#CloseThemeBtn").on("click", function () {
      $.modal.close();
    });

    //AL CLICAR SOBRE EL CLOSE BTN SE CIERRA EL MODAL
    $("#CloseEditThemeBtn").on("click", function () {
      $.modal.close();
    });
  });
}

//AL CLCIAR EL BOTON DE AÑADIR THEME AÑADIMOS UN EVENT LISTENER
let addTheme = document
  .getElementById("addThemeBtn")
  .addEventListener("click", () => {
    let nameTheme = document.getElementById("Theme_Name");
    let cbxTheme = document.getElementById("cbx-46");
    let cbxError = document.getElementById("cbxError");
    let nameError = document.getElementById("nameError");

    //COMPROBAMOS QUE ESTAN RELLENOS LOS CAMPOS Y VERIFICAMOS QUE SE CHECKEA LAS CONDICIONES
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

    //SI LAS CONDICIONES SE VALIDAN SIGUE ADELANTE
    if (!nameTheme.value == "" && cbxTheme.checked) {
      //EJEMPLO DE COMO SE CONSTRUYE UNA ALERTA SWEET DE JQUERY PARA PREGUNTAR SI SE QUIERE CREAR UN NUEVO TEMA
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
        //SI SE CONFIRMA INICIA EL PROCESO DE CREACION DE UN NUEVO TEMA
        if (result.isConfirmed) {
          let username = getCookie("username");
          //PARA REGISTRAR UN NUEVO TEMA SE REALIZA MEDIANTE UNA PETICION AJAX QUE LA CREAMOS A CONTINUACION
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
              if (this.status == 200) {
                //SI LA RESPUESTA Y EL ESTADO DE LA PETICION ES CORECTO MOSTRAMOS QUE SE CREA EL TEMA POR LO CONTRRAIO MOSTRAMOS MENSAJE DE ERROR
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
                  $(document).ready(function () {
                    $.modal.close();
                  });
                }
              } else {
                Swal.fire("Error!", "Theme not created.", "error");
                $(document).ready(function () {
                  $.modal.close();
                });
              }
            }
          };
          //ENVIAMOS LA PETICION POR POST AL ARCHIVO INSERTAR TEMA Y LAS VARIABLES QUE PASAMOS EN LA CABECERA
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
          $(document).ready(function () {
            $.modal.close();
          });
        }
      });
    }
  });

//FUNCIONALIDAD PARA EL BOTON DE LOGOUT
let logout = document.getElementById("logout");
logout.addEventListener("click", () => {
  let username = getCookie("username");

  Swal.fire({
    title: "Do you want to Log Out?",
    text: "Login Out: " + username,
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
        //SI CONFIRMA QUE QUIERE CERRAR SESION ELIMINAMOS LA COOKIE Y DEVOLVEMOS A LA PAGINA DE INICIO DE SESION
        if (result.isConfirmed) {
          document.cookie =
            "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          location.reload();
        }
      });
    } else {
      Swal.fire("Cancelled", "Coming Back.", "info");
      $(document).ready(function () {
        $.modal.close();
      });
    }
  });
});

//FUNCIONALIDAD PARA EL BOTON EDITAR UN TEMA
function editBtn() {
  let editBtn = document.querySelectorAll(".editThemeBtn");
  for (const btnEdit of editBtn) {
    btnEdit.addEventListener("click", () => {
      event.stopPropagation();
      //VARIABLE PARA GUARDAR EL NOMBRE DEL TEMA PARA VERIFICAR SI SE CAMBIA O NO
      let themeNameBD;

      //RECOGER EL ID DEL TEMA DEL BOTON QUE AL CLICAR SE RECOGE PARA SABER QUE TEMA SE VA A EDITAR
      let id_theme = btnEdit.id;
      id_theme = id_theme.split("-")[1];

      //PETICION AJAX PARA DEVOLVER EL TITULO DEL TEMA QUE SE VA EDITAR
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            let themes = JSON.parse(this.responseText);
            if (themes.length > 0) {
              //MOSTRAR EL TIRULO DEL TEMA QUE SE VA A EDITAR
              themeNameBD = themes[0].titulo_tema;
              let input = document.getElementById("New_Theme_Name");
              input.value = themes[0].titulo_tema;
            } else {
              console.error("No themes found.");
            }
            //MANEJO DE ERRORES SI EXISTE UN ERROR EN LA PETICION AJAX
          } else {
            console.error("Error: " + this.status);
          }
        }
      };
      //ENVIAR LA CABECERA POR POST, CON EL ID DEL TEMA PARA QUE NOS DEVUELVA EL TITULO DEL TEMA
      xhttp.open("POST", "PHP/Forum/returnTheme.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send("id_theme=" + encodeURIComponent(id_theme));

      //AL CLICAR EL BOTON INICIALIZAMOS EL PROCESO DE EDICION DEL TEMA
      let ConfirmeditBtn = document
        .getElementById("editThemeBtn")
        .addEventListener("click", () => {
          let nameTheme = document.getElementById("New_Theme_Name");
          let cbxTheme = document.getElementById("cbx-462");
          let cbxError = document.getElementById("cbxErrorEdit");
          let nameError = document.getElementById("nameErrorEdit");

          //VERIFICAMOS QUE CUMPLE LOS REQUISITOS PARA EDITAR EL TEMA
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

          //SI SE CUMPLEN LOS REQUISITOS INNICAMOS LA ACCION DE EDICION DEL TEMA
          if (!nameTheme.value == "" && cbxTheme.checked) {
            if (nameTheme.value == themeNameBD) {
              Swal.fire({
                title: "Theme not Edited! Same Name.",
                text: "The theme has the same name.",
                icon: "info",
                showConfirmButton: true,
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            } else {
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
                //SI SE CONFIRMA LA REALIZACION DE LA EDICION HACEMOS UNA PETICION POST PARA EDITAR EL TEMA
                if (result.isConfirmed) {
                  let username = getCookie("username");
                  //PETICION AJAX PARA EDITAR EL TEMA
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                      if (this.status == 200) {
                        //SI LA RESPUESTA TIENE STATUS VALIDO MOSTRAMOS AL USUARIO LA RESPUESTA
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
                          $(document).ready(function () {
                            $.modal.close();
                          });
                        }
                      } else {
                        Swal.fire("Error!", "Theme not edited.", "error");
                        $(document).ready(function () {
                          $.modal.close();
                        });
                      }
                    }
                  };
                  //PETICION MEDIANTE POST Y MANDAR VARIABLES POR LA CABECERA
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
                  $(document).ready(function () {
                    $.modal.close();
                  });
                }
              });
            }
          }
        });
    });
  }
}

//FUNCION PARA ELIMINAR UN TEMA
function deleteBtn() {
  let deleteBtn = document.querySelectorAll(".deleteThemeBtn");
  for (const btnDelete of deleteBtn) {
    btnDelete.addEventListener("click", () => {
      event.stopPropagation();

      //RECOGER EL ID DEL TEMA DEL BOTON QUE AL CLICAR SE RECOGE PARA SABER QUE TEMA SE VA A ELIMINAR
      let id_theme = btnDelete.id;
      id_theme = id_theme.split("-")[1];

      let nameTheme = document.getElementById("nameTheme-" + id_theme);

      //INDICAR SI DESEA ELIMINAR EL TEMA
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
          //PETICION PARA ELIMINAR EL TEMA
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
                  $(document).ready(function () {
                    $.modal.close();
                  });
                }
              } else {
                Swal.fire("Error!", "Theme not deleted.", "error");
                $(document).ready(function () {
                  $.modal.close();
                });
              }
            }
          };
          //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
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

//FUNCION PARA ACUTALIZAR EL NUMERO DE TEMAS QUE SE MUESTRAN
function actualizarPostP() {
  let totalPosts = document.querySelectorAll(".post-card-container");
  countPost = "Showing: " + totalPosts.length + " Themes";

  let countPostP = document.getElementById("countPostP");
  countPostP.textContent = countPost;
}

//FILTRO DE LA PAGINA PARA FILTRAR POR TEMAS
let filter = document.getElementById("filter");
filter.addEventListener("change", () => {
  let selectedValue = filter.value;
  let postsGrupo = document.getElementById("posts-group");
  let orderP = document.getElementById("orderP");
  let tipo = "";

  //RECOGER EL VALOR SELECCIONADO EN EL INPUT
  switch (selectedValue) {
    case "Newest":
      tipo = "Newest";
      break;
    case "Popularity":
      tipo = "Popularity";
      break;
    case "Oldest":
      tipo = "Oldest";
      break;
    default:
      tipo = "Default";
      break;
  }
  orderP.textContent = "Order by: " + tipo;

  //REALIZAR LA SOLICITUD AJAX PARA FILTRAR TEMAS
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var themes = JSON.parse(this.responseText);
      console.log(themes);
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = "";

      //SI NO HAY TEMAS QUE MOSTRAR SE LE INDICA AL USUARIO
      if (themes.length == 0) {
        let postsGroup = document.getElementById("posts-group");
        let postContainer = document.createElement("div");
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
        postsGroup.appendChild(postContainer);
      }

      //RECORRER EL ARRAY Y MOSTRAR DINAMICAMENTE LOS TEMAS
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
          "<h1 id='nameTheme-" + theme[0] + "'>" + theme[1] + "</h1>";

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
          "<img src='Images/msg.svg' alt='' /><p>Posts: " + theme[4] + "</p>";

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
        if (theme[3] == user) {
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

      //LLAMAR A LA FUNCIONALIDAD DE LOS BOTONES MODALS Y ACTUALIZAR LOS POSTS QUE SE ESTAN MOSTRANDO
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };
  //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
  xhttp.open("POST", "PHP/Forum/returnThemes.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("filter=" + tipo);
});

//DETECTAR EL INPUT SEARCH Y RECOGER LOS VALORES PARA MANDARLO A LA FUNCION QUE REALIZA LA BUSQUEDA MEDIANTE AJAX
let search = document.getElementById("search");
search.addEventListener("input", () => {
  console.log(search.value);
  searchTheme(search.value);
});

//FUNCION QUE BUSCA EL STRING EN LA BASE D EDATOS
function searchTheme(letra) {
  //PETICION AJAX EN LA QUE SE BUSCA Y SE MUESTRA LOS RESULTADOS DE LA BUSQEUDA
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var themes = JSON.parse(this.responseText);
      console.log(themes);
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = "";

      //SI NO HAY TEMAS QUE MOSTRAR SE LE INDICA AL USUARIO
      if (themes.length == 0) {
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

      //PINTAR DINAMICAMENTE LOS TEMAS AL USUARIO
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
          "<h1 id='nameTheme-" + theme[0] + "'>" + theme[1] + "</h1>";

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
          "<img src='Images/msg.svg' alt='' /><p>Posts: " + theme[4] + "</p>";

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
        if (theme[3] == user) {
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

      //LLAMAR A LA FUNCIONALIDAD DE LOS BOTONES MODALS Y ACTUALIZAR LOS POSTS QUE SE ESTAN MOSTRANDO
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };
  //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
  xhttp.open("POST", "PHP/Forum/search_theme.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("letra=" + letra);
}
//REDIRIGIR A LA PAGINA DE POSTS CADA TEMA PARA VER SUS RESPECTIVOS POSTS Y AÑADIRLE FUNCIONES DE ACCESIBILIDAD
function redireccionPostsCards() {
  //RECOGER TODAS LAS TARJETAS
  let postsCardArr = document.querySelectorAll(".post-card");
  for (const postCard of postsCardArr) {
    //OBTENER EL ID DE LAS TARJETAS PARA REDIRIGIR
    let id_themeString = postCard.id;
    let id_theme = id_themeString.split("postCard")[1];
    //AÑADIR EVENTO PARA REDIRIGIR MEDIANTE CLICK
    postCard.addEventListener("click", () => {
      window.location.href = "forumPosts.php?id=" + id_theme;
    });

    //AÑADIR EVENTO PARA REDIRIGIR MEDIANTE LA TECLA ESPACIO
    postCard.addEventListener("keydown", (event) => {
      if (event.key === " " || event.key === "Spacebar") {
        event.preventDefault();
        window.location.href = "forumPosts.php?id=" + id_theme;
      }
    });

    //LAS TARJETAS PODRÁN SER SELECCIONADAS MEDIANTE TAB
    postCard.setAttribute("tabindex", "0");
  }
}
redireccionPostsCards();

/*--------------------------------------------FUNCIONALIDAD DEL ELEMENTO DE BOTON VOLVER ARRIBA------------------------------------------------*/
//RECOGER EL BOTON
document.getElementById("upBtn").classList.add("hidden");
//CUANDO SE DETECTE SCROLL LLAMAR A LA FUNCION DE SCROLLEO
window.onscroll = function () {
  scrollFunction();
};

//DETECTAR CUANDO SE VA A MOSTRAR EL BOTON, CUANDO PASE DE LA PARTE PRINCIPAL DE LA PAGINA
function scrollFunction() {
  if (
    document.body.scrollTop > window.innerHeight ||
    document.documentElement.scrollTop > window.innerHeight
  ) {
    document.getElementById("upBtn").classList.remove("hidden");
  } else {
    document.getElementById("upBtn").classList.add("hidden");
  }
}

//FUNCION PARA VOLVER ARRIBA DE LA PAGIINA
function scrollToTop() {
  const scrollStep = -window.scrollY / (500 / 15);
  const scrollInterval = setInterval(function () {
    if (window.scrollY != 0) {
      window.scrollBy(0, scrollStep);
    } else clearInterval(scrollInterval);
  }, 15);
}
/*--------------------------------------------FUNCIONALIDAD DEL ELEMENTO DE BOTON VOLVER ATRÁS-------------------------------------------------*/
//RECOGER EL BOTON
document.getElementById("backBtn").addEventListener("click", () => {
  //REDIRIGIR A LA PAGINA ANTERIOR
  window.location.href = "index.html";
});
