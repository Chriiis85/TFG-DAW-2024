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

function actualizarPostP() {
  let totalPosts = document.querySelectorAll(".post-container");
  countPost = "Showing: " + totalPosts.length + " Posts.";

  let countPostP = document.getElementById("countPostP");
  countPostP.textContent = countPost;
}

function jqueryModal() {
  $(document).ready(function () {
    $("#newPost").on("click", function () {
      // Abre el modal al hacer clic
      $("#new-post-modal").modal({
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

    $("#ClosePostBtn").on("click", function () {
      $.modal.close();
    });

    $("#CloseEditPostBtn").on("click", function () {
      $.modal.close();
    });
  });
}


let addPost = document
.getElementById("addPostBtn")
.addEventListener("click", () => {
  let nameTheme = document.getElementById("Post_Content");
  let cbxTheme = document.getElementById("cbx-46");
  let cbxError = document.getElementById("cbxError");
  let nameError = document.getElementById("nameError");
  let main = document.querySelector(".main");
  let id_theme = main.id;

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
      title: "Do you want to write a new Post?",
      text: "New post content: " + nameTheme.value,
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
              console.log(this.responseText)
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
        xhttp.open("POST", "PHP/Forum/insertPost.php", true);
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send(
          "content=" +
          encodeURIComponent(nameTheme.value) +
          "&username=" +
          username + "&id_theme=" + id_theme
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

function deleteBtn() {
    let deleteBtn = document.querySelectorAll(".deleteThemeBtn");
    for (const btnDelete of deleteBtn) {
      btnDelete.addEventListener("click", () => {
        event.stopPropagation();
        let id_theme = btnDelete.id;
        id_theme = id_theme.split("-")[1];
  
        let nameTheme = document.getElementById("nameTheme-" + id_theme);
  
        Swal.fire({
          title: "Do you want to delete this Post?",
          text: "Deleting post: '" + nameTheme.textContent + "'",
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
