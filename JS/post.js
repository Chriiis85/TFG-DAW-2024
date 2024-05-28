//FUNCIONES QUE CONTIENEN LA FUNCIONALIDAD DE ELIMINAR Y BORAR, LOS MODAL PARA LAS ACCIONES
jqueryModal();
actualizarPostP();
deleteBtn();
editBtn();

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

//FUNCION QUE ACTUALIZA EL CONTADOR DE POSTS
function actualizarPostP() {
  let totalPosts = document.querySelectorAll(".post-container");
  countPost = "Showing: " + totalPosts.length + " Posts.";

  let countPostP = document.getElementById("countPostP");
  countPostP.textContent = countPost;
}

//FUNCION QUE LLAMA A LAS ACCIONES CUANDO SE CLICA Y A DE ABRIRSE UN MODAL POR MEDIO DE JQUERY
function jqueryModal() {
  $(document).ready(function () {
    $("#newPost").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL DON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      $("#new-post-modal").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false,
      });
    });

    $(".editPostBtn").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL CON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      $("#edit-post-modal").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false,
      });
    });

    $("#privacyTheme").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL CON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false,
      });
    });

    $("#privacyThemeEdit").on("click", function () {
      //AL HACER CLIC SE ABRE UN MODAL CON UN EFECTO FADE Y CON UN ELEMENTO (X) PARA CERRARLO
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false,
      });
    });

    //AL CLICAR SOBRE EL CLOSE BTN SE CIERRA EL MODAL
    $("#ClosePostBtn").on("click", function () {
      $.modal.close();
    });

    //AL CLICAR SOBRE EL CLOSE BTN SE CIERRA EL MODAL
    $("#CloseEditPostBtn").on("click", function () {
      $.modal.close();
    });
  });
}
//FUNCIONALIDAD PARA EL BOTON EDITAR UN TEMA
function editBtn() {
  let editBtn = document.querySelectorAll(".editPostBtn");
  for (const btnEdit of editBtn) {
    btnEdit.addEventListener("click", () => {
      event.stopPropagation();
      let id_post = btnEdit.id;
      id_post = id_post.split("-")[1];

      //AL CLICAR EL BOTON INICIALIZAMOS EL PROCESO DE EDICION DEL TEMA
      let ConfirmeditBtn = document
        .getElementById("editPostBtn")
        .addEventListener("click", () => {
          let postContent = document.getElementById("New_Post_Content");
          let cbxTheme = document.getElementById("cbx-462");
          let cbxError = document.getElementById("cbxErrorEdit");
          let nameError = document.getElementById("nameErrorEdit");

          //VERIFICAMOS QUE CUMPLE LOS REQUISITOS PARA EDITAR EL TEMA
          let postPrev = document.getElementById("postContent-" + id_post);
          if (!cbxTheme.checked) {
            cbxError.style.display = "block";
          }
          if (postContent.value == "") {
            nameError.style.display = "block";
          }

          if (cbxTheme.checked) {
            cbxError.style.display = "none";
          }
          if (!postContent.value == "") {
            nameError.style.display = "none";
          }

          //SI SE CUMPLEN LOS REQUISITOS INNICAMOS LA ACCION DE EDICION DEL TEMA
          if (!postContent.value == "" && cbxTheme.checked) {
            Swal.fire({
              title:
                "Do you want to edit this Post: " + postPrev.textContent + " ?",
              text: "New content: " + postContent.value,
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
                //PETICION AJAX PARA EDITAR EL POST
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                  if (this.readyState == 4) {
                    if (this.status == 200) {
                      //SI LA RESPUESTA TIENE STATUS VALIDO MOSTRAMOS AL USUARIO LA RESPUESTA
                      if (this.responseText == 1) {
                        Swal.fire({
                          title: "Post Edited!",
                          text: "The post was edited successfully.",
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
                //PETICION MEDIANTE POST Y MANDAR VARIABLES POR LA CABECERA
                xhttp.open("POST", "PHP/Forum/editPost.php", true);
                xhttp.setRequestHeader(
                  "Content-type",
                  "application/x-www-form-urlencoded"
                );
                xhttp.send(
                  "content=" +
                    encodeURIComponent(postContent.value) +
                    "&id_post=" +
                    id_post
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

//AL CLCIAR EL BOTON DE AÑADIR POST AÑADIMOS UN EVENT LISTENER
let addPost = document
  .getElementById("addPostBtn")
  .addEventListener("click", () => {
    let nameTheme = document.getElementById("Post_Content");
    let cbxTheme = document.getElementById("cbx-46");
    let cbxError = document.getElementById("cbxError");
    let nameError = document.getElementById("nameError");
    let main = document.querySelector(".main");
    let id_theme = main.id;

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
        title: "Do you want to write a new Post?",
        text: "New post content: " + nameTheme.value,
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
                    title: "Post Created!",
                    text: "The post was created successfully.",
                    icon: "success",
                    showConfirmButton: true,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire("Error!", "Post not created.", "error");
                }
              } else {
                Swal.fire("Error!", "Post not created.", "error");
              }
            }
          };
          //ENVIAMOS LA PETICION POR POST AL ARCHIVO INSERTAR TEMA Y LAS VARIABLES QUE PASAMOS EN LA CABECERA
          xhttp.open("POST", "PHP/Forum/insertPost.php", true);
          xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhttp.send(
            "content=" +
              encodeURIComponent(nameTheme.value) +
              "&username=" +
              username +
              "&id_theme=" +
              id_theme
          );
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });
    }
  });

//FUNCIONALIDAD PARA EL BOTON DE LOGOUT
let logout = document.getElementById("logout");
logout.addEventListener("click", () => {
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
        //SI CONFIRMA QUE QUIERE CERRAR SESION ELIMINAMOS LA COOKIE Y DEVOLVEMOS A LA PAGINA DE INICIO DE SESION
        if (result.isConfirmed) {
          document.cookie =
            "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          location.reload();
        }
      });
    } else {
      Swal.fire("Cancelled", "Coming Back.", "info");
    }
  });
});

//FUNCION PARA ELIMINAR UN POST
function deleteBtn() {
  let deleteBtn = document.querySelectorAll(".deletePostBtn");
  for (const btnDelete of deleteBtn) {
    btnDelete.addEventListener("click", () => {
      event.stopPropagation();
      let id_post = btnDelete.id;
      id_post = id_post.split("-")[1];

      let postContent = document.getElementById("postContent-" + id_post);

      //INDICAR SI DESEA ELIMINAR EL TEMA
      Swal.fire({
        title: "Do you want to delete this Post?",
        text: "Deleting post: '" + postContent.textContent + "'",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        confirmButtonText: "Confirm!",
        cancelButtonText: "No, go back.",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.isConfirmed) {
          let username = getCookie("username");
          //PETICION PARA ELIMINAR EL POST
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
              if (this.status == 200) {
                if (this.responseText == 1) {
                  Swal.fire({
                    title: "Post Deleted!",
                    text: "The post was deleted successfully.",
                    icon: "success",
                    showConfirmButton: true,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire("Error!", "Post not deleted.", "error");
                }
              } else {
                Swal.fire("Error!", "Post not deleted.", "error");
              }
            }
          };
          //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
          xhttp.open("POST", "PHP/Forum/deletePost.php", true);
          xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhttp.send("id_post=" + id_post);
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });
    });
  }
}

//FILTRO DE LA PAGINA PARA FILTRAR POR POSTS
let filter = document.getElementById("filter");
filter.addEventListener("change", () => {
  let selectedValue = filter.value;
  let postsGrupo = document.getElementById("posts-group");
  let orderP = document.getElementById("orderP");
  let tipo = "";
  let main = document.querySelector(".main");
  let id_theme = main.id;

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

  orderP.textContent = "Order by: " + tipo + ".";

  //REALIZAR LA SOLICITUD AJAX PARA FILTRAR TEMAS
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      var posts = JSON.parse(this.responseText); // Parsear JSON a objeto JavaScript
      console.log(posts);
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = "";

      //SI NO HAY TEMAS QUE MOSTRAR SE LE INDICA AL USUARIO
      if (posts.length == 0) {
        let postContainer = document.createElement("div"); // Create a new container
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
        postsGroup.appendChild(postContainer); // Add the new container to the DOM
      } else {
        //RECORRER EL ARRAY Y MOSTRAR DINAMICAMENTE LOS TEMAS

        posts.forEach((post) => {
          const postId = post[0];
          const postContent = post[1];
          const postDate = post[2];
          const postUserId = post[3];

          const postContainer = document.createElement("div");
          postContainer.className = "post-container";

          const postContainer1 = document.createElement("div");
          postContainer1.className = "post-container-1";

          const postTitle = document.createElement("h1");
          postTitle.textContent = "Posted by: " + postUserId;
          postContainer1.appendChild(postTitle);

          const postDateParagraph = document.createElement("p");
          postDateParagraph.textContent = `Posted on: ${postDate}.`;
          postContainer1.appendChild(postDateParagraph);

          /*const postCardViews = document.createElement('div');
                postCardViews.className = 'post-card-views';
                const viewImage = document.createElement('img');
                viewImage.src = 'Images/view.svg';
                viewImage.alt = '';
                postCardViews.appendChild(viewImage);
                const viewParagraph = document.createElement('p');
                viewParagraph.textContent = 'Views: 1';
                postCardViews.appendChild(viewParagraph);
                postContainer1.appendChild(postCardViews);*/
          let username = getCookie("username");

          if (postUserId == username || username == "admin") {
            const postCardEdit = document.createElement("div");
            postCardEdit.className = "post-card-6-edit";

            const editButton = document.createElement("button");
            editButton.className = "editPostBtn";
            editButton.id = `editCard-${postId}`;
            const editImage = document.createElement("img");
            editImage.src = "Images/edit.svg";
            editImage.alt = "";
            editButton.appendChild(editImage);
            postCardEdit.appendChild(editButton);

            const deleteButton = document.createElement("button");
            deleteButton.className = "deletePostBtn";
            deleteButton.id = `deleteCard-${postId}`;
            const deleteImage = document.createElement("img");
            deleteImage.src = "Images/delete.svg";
            deleteImage.alt = "";
            deleteButton.appendChild(deleteImage);
            postCardEdit.appendChild(deleteButton);

            postContainer1.appendChild(postCardEdit);
          }

          postContainer.appendChild(postContainer1);

          const postContainer2 = document.createElement("div");
          postContainer2.className = "post-container-2";

          const postParagraph = document.createElement("p");
          postParagraph.id = `postContent-${postId}`;
          postParagraph.textContent = postContent;
          postContainer2.appendChild(postParagraph);

          postContainer.appendChild(postContainer2);

          postsGroup.appendChild(postContainer);
        });
      }

      //LLAMAR A LA FUNCIONALIDAD DE LOS BOTONES MODALS Y ACTUALIZAR LOS POSTS QUE SE ESTAN MOSTRANDO
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };

  //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
  xhttp.open("POST", "PHP/Forum/returnPosts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("filter=" + tipo + "&id_theme=" + id_theme); // Correct query string
});

//DETECTAR EL INPUT SEARCH Y RECOGER LOS VALORES PARA MANDARLO A LA FUNCION QUE REALIZA LA BUSQUEDA MEDIANTE AJAX
let search = document.getElementById("search");
search.addEventListener("input", () => {
  console.log(search.value);
  searchTheme(search.value);
});

//FUNCION QUE BUSCA EL STRING EN LA BASE D EDATOS
function searchTheme(letra) {
  let main = document.querySelector(".main");
  let id_theme = main.id;
  //PETICION AJAX EN LA QUE SE BUSCA Y SE MUESTRA LOS RESULTADOS DE LA BUSQEUDA
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(posts);
      var posts = JSON.parse(this.responseText); // Parse JSON to JavaScript object
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = ""; // Clear previous posts

      //SI NO HAY TEMAS QUE MOSTRAR SE LE INDICA AL USUARIO
      if (posts.length == 0) {
        let postContainer = document.createElement("div"); // Create a new container
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
        postsGroup.appendChild(postContainer); // Add the new container to the DOM
      } else {
        //PINTAR DINAMICAMENTE LOS TEMAS AL USUARIO
        posts.forEach((post) => {
          const postId = post[0];
          const postContent = post[1];
          const postDate = post[2];
          const postUserId = post[3];

          const postContainer = document.createElement("div");
          postContainer.className = "post-container";

          const postContainer1 = document.createElement("div");
          postContainer1.className = "post-container-1";

          const postTitle = document.createElement("h1");
          postTitle.textContent = "Posted by: " + postUserId;
          postContainer1.appendChild(postTitle);

          const postDateParagraph = document.createElement("p");
          postDateParagraph.textContent = `Posted on: ${postDate}.`;
          postContainer1.appendChild(postDateParagraph);

          let username = getCookie("username");

          if (postUserId == username || username == "admin") {
            const postCardEdit = document.createElement("div");
            postCardEdit.className = "post-card-6-edit";

            const editButton = document.createElement("button");
            editButton.className = "editPostBtn";
            editButton.id = `editCard-${postId}`;
            const editImage = document.createElement("img");
            editImage.src = "Images/edit.svg";
            editImage.alt = "";
            editButton.appendChild(editImage);
            postCardEdit.appendChild(editButton);

            const deleteButton = document.createElement("button");
            deleteButton.className = "deletePostBtn";
            deleteButton.id = `deleteCard-${postId}`;
            const deleteImage = document.createElement("img");
            deleteImage.src = "Images/delete.svg";
            deleteImage.alt = "";
            deleteButton.appendChild(deleteImage);
            postCardEdit.appendChild(deleteButton);

            postContainer1.appendChild(postCardEdit);
          }

          postContainer.appendChild(postContainer1);

          const postContainer2 = document.createElement("div");
          postContainer2.className = "post-container-2";

          const postParagraph = document.createElement("p");
          postParagraph.id = `postContent-${postId}`;
          postParagraph.textContent = postContent;
          postContainer2.appendChild(postParagraph);

          postContainer.appendChild(postContainer2);
          postsGroup.appendChild(postContainer);
        });
      }

      //LLAMAR A LA FUNCIONALIDAD DE LOS BOTONES MODALS Y ACTUALIZAR LOS POSTS QUE SE ESTAN MOSTRANDO
      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };
  //ENVIO DE LA PETICION Y DE LAS VARIABLES PARA EDITAR EL TEMA
  xhttp.open("POST", "PHP/Forum/search_post.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("letra=" + letra + "&id_theme=" + id_theme);
}
