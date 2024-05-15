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

  function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  $(document).ready(function () {
    $("#newTheme").on("click", function () {
      // Abre el modal al hacer clic
      $("#new-theme-modal").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false
      });
    });

    $(".editThemeBtn").on("click", function () {
      // Abre el modal al hacer clic
      $("#edit-theme-modal").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false
      });
    });

    $("#privacyTheme").on("click", function () {
      // Abre el modal al hacer clic
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false
      });
    });

    $("#privacyThemeEdit").on("click", function () {
      // Abre el modal al hacer clic
      $("#new-theme-privacy").modal({
        fadeDuration: 300,
        escapeClose: false,
        clickClose: false
      });
    });

    $("#CloseThemeBtn").on("click", function () {
      $.modal.close();
    });
    
    $("#CloseEditThemeBtn").on("click", function () {
      $.modal.close();
    });
  })

  let addTheme = document.getElementById("addThemeBtn").addEventListener("click", () => {
    let nameTheme = document.getElementById("Theme_Name");
    let cbxTheme = document.getElementById("cbx-46");
    let cbxError = document.getElementById("cbxError");
    let nameError = document.getElementById("nameError");


    if (!cbxTheme.checked) {
      cbxError.style.display = "block"
    }
    if (nameTheme.value == "") {
      nameError.style.display = "block"
    }

    if (cbxTheme.checked) {
      cbxError.style.display = "none"
    }
    if (!nameTheme.value == "") {
      nameError.style.display = "none"
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
        allowOutsideClick: false
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
                    showConfirmButton: true
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
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send('name=' + encodeURIComponent(nameTheme.value) + '&username=' + username);
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });


    }
  })

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
      allowOutsideClick: false
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Login Out!",
          text: "Come back Soon!.",
          icon: "success",
          showConfirmButton: true
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      } else {
        Swal.fire("Cancelled", "Coming Back.", "info");
      }
    })
  })



  let deleteBtn = document.querySelectorAll(".deleteThemeBtn");
  for (const btnDelete of deleteBtn) {
    btnDelete.addEventListener("click", () => {
      event.stopPropagation();
      let id_theme = btnDelete.id;
      id_theme = id_theme.split('-')[1];

      let nameTheme = document.getElementById("nameTheme-" + id_theme)

      Swal.fire({
        title: "Do you want to delete this Theme?",
        text: "Deleting theme: '" + nameTheme.textContent + "'",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        confirmButtonText: "Confirm!",
        cancelButtonText: "No, go back.",
        allowOutsideClick: false
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
                    showConfirmButton: true
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
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send('id_theme=' + id_theme);
        } else {
          Swal.fire("Cancelled", "Operation cancelled.", "info");
        }
      });
    })
  }
