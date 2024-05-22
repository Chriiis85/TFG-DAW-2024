jqueryModal();
actualizarPostP();
deleteBtn();
editBtn();
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

    $(".editPostBtn").on("click", function () {
      // Abre el modal al hacer clic
      $("#edit-post-modal").modal({
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

function editBtn() {
  let editBtn = document.querySelectorAll(".editPostBtn");
  for (const btnEdit of editBtn) {
    btnEdit.addEventListener("click", () => {
      event.stopPropagation();
      let id_post = btnEdit.id;
      id_post = id_post.split("-")[1];

      let ConfirmeditBtn = document
        .getElementById("editPostBtn")
        .addEventListener("click", () => {
          let postContent = document.getElementById("New_Post_Content");
          let cbxTheme = document.getElementById("cbx-462");
          let cbxError = document.getElementById("cbxErrorEdit");
          let nameError = document.getElementById("nameErrorEdit");

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
              if (result.isConfirmed) {
                let username = getCookie("username");
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                  if (this.readyState == 4) {
                    if (this.status == 200) {
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
                console.log(this.responseText);
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
        if (result.isConfirmed) {
          document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          location.reload();
        }
      });
    } else {
      Swal.fire("Cancelled", "Coming Back.", "info");
    }
  });
});

function deleteBtn() {
  let deleteBtn = document.querySelectorAll(".deletePostBtn");
  for (const btnDelete of deleteBtn) {
    btnDelete.addEventListener("click", () => {
      event.stopPropagation();
      let id_post = btnDelete.id;
      id_post = id_post.split("-")[1];

      let postContent = document.getElementById("postContent-" + id_post);

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

let filter = document.getElementById("filter");
filter.addEventListener("change", () => {
  let selectedValue = filter.value;
  let postsGrupo = document.getElementById("posts-group");
  let orderP = document.getElementById("orderP");
  let tipo = "";
  let main = document.querySelector(".main");
  let id_theme = main.id;

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

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      var posts = JSON.parse(this.responseText); // Parsear JSON a objeto JavaScript
      console.log(posts);
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = "";

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

      deleteBtn();
      editBtn();
      jqueryModal();
      actualizarPostP();
    }
  };

  xhttp.open("POST", "PHP/Forum/returnPosts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("filter=" + tipo + "&id_theme=" + id_theme); // Correct query string
});

let search = document.getElementById("search");
search.addEventListener("input", () => {
  console.log(search.value);
  searchTheme(search.value);
});

function searchTheme(letra) {
  let main = document.querySelector(".main");
  let id_theme = main.id;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(posts);
      var posts = JSON.parse(this.responseText); // Parse JSON to JavaScript object
      let postsGroup = document.getElementById("posts-group");
      postsGroup.innerHTML = ""; // Clear previous posts

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

      deleteBtn(); // Reinitialize delete button functionality
      editBtn(); // Reinitialize edit button functionality if you have this function
      jqueryModal(); // Reinitialize modal functionality if you have this function
      actualizarPostP(); // Reinitialize any other post-update functionality
    }
  };
  xhttp.open("POST", "PHP/Forum/search_post.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("letra=" + letra + "&id_theme=" + id_theme);
}
