<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motoring Community - Forum</title>
  <!-- SCRIPT DEL FORO -->
  <script defer src="JS/forum.js"></script>
  <!-- SCRIPT JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- SCRIPT JQUERY MODALS ALERT -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SCRIPT Y HOJA DE ESTILOS JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <!-- LINK AL CSS DE JQUERY -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>

<body>
  <?php
  /*SI LA COOKIE ESTA INCIALIZADA GUARDAMOS EN LA VARIABLE USER EL NOMBRE DEL USUARIO*/
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    //SI LA COOKIE NO ESTA ESTABLECIDA MANDAMOS A LA PAGINA DE INICIO DE SESION
    header('Location: users.php');
  }
  //INCLUIR EL HEADER DE FORO
  include "headerForum.php";
  ?>
  <!--LINK AL CSS DEL FORO-->
  <link rel="stylesheet" href="CSS/forum.css" />

  <!--BOTON PARA VOLVER ARRIBA DE LA PAGINA-->
  <button onclick="scrollToTop()" id="upBtn" class="up-button">
    <img src="Images/UPARROW.svg" alt="Up Arrow" aria-label="Scroll to top" />
  </button>

  <!--BOTON PARA VOLVER ATRÁS DE LA PAGINA-->
  <button id="backBtn" class="back-button">
    <img src="Images/backarrow.svg" alt="Back Icon" title="Go to Main Page" aria-label="Back Page" />
  </button>

  <!--SECCION PRINCIPAL DEL FORO-->
  <section class="main">
    <article class="posts-container" id="postsContainer">
      <div class="main-bar">
        <div class="main-bar-filter">
          <div class="select">
            <select id="filter">
              <option value="Default">Default</option>
              <option value="Popularity">Popularity</option>
              <option value="Newest">Newest</option>
              <option value="Oldest">Oldest</option>
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
            <input id="search" placeholder="Search" type="search" class="input" />
          </div>
        </div>
        <div class="main-bar-add">
          <button id="newTheme" class="button-add" role="button">Add new Theme</button>
        </div>
      </div>
      <div class="posts-container-info">
        <h1 id="orderP">Order by: Default</h1>
        <h1 id="countPostP"></h1>
      </div>
      <div id="posts-group" class="posts-group">
        <?php
        //INLCUIR EL ARCHIVO QUE DEVUELVE LOS TEMAS
        include "PHP/Forum/returnThemes.php";

        //OBTENER EN UN ARRAY LOS TEMAS POR DEFECTO DE LA FUNCION EXPLICADA EN RETURN THEMES
        $themes = returnThemesByDefault();

        //OBTNER EL ID DE USUARIO
        $id_usu_theme = returnIdUsu($username);

        //SI NO HAY TEMAS QUE MOSTRAR INDICAR AL USUARIO
        if (sizeof($themes) == 0) {
          echo '<img class="img-noresult" src="https://regionagropecuaria.com/assets/templates/basic/images/no-results.png" alt="No result Image" />';
        } else {
          //RECORRER EL ARRAY MOSTRANDO LOS TEMAS EN EL CONTENEDOR
          for ($i = 0; $i < sizeof($themes); $i++) {
            echo '<div id="post-card-container" class="post-card-container">
          <div tabindex="0" id="postCard' . $themes[$i][0] . '" class="post-card">
            <div class="post-card-1">
              <h1>Posted by: ' . returnNombreUsu($themes[$i][3]) . '</h1>
              <p>Posted on: ' . $themes[$i][2] . '</p>
            </div>
            <div class="post-card-2">
              <div class="post-card-3">
                <h1 id="nameTheme-' . $themes[$i][0] . '">
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
                  <div class="post-card-6-info">
                    <!--<div class="post-card-views">
                      <img src="Images/view.svg" alt="View Icon" />
                      <p>' . $themes[$i][4] . '</p>
                    </div>-->
                    <div class="post-card-msg">
                      <img src="Images/msg.svg" alt="Message Icon" />
                      <p>Posts: ' . returnNumberPosts($themes[$i][0]) . '</p>
                    </div>
                  </div>';
            //VERIFICAR QUIEN ES EL USUARIO PARA PERMITIR LA ELIMINACION O LA EDICION DE DICHO TEMA
            if ($themes[$i][3] == $id_usu_theme || $username == "admin") {
              echo '<div class="post-card-6-edit">
                          <button class="editThemeBtn" id="editCard-' . $themes[$i][0] . '"><img src="Images/edit.svg" alt="Edit Icon" /></button>
                          <button class="deleteThemeBtn" id="deleteCard-' . $themes[$i][0] . '"><img src="Images/delete.svg" alt="Delete Icon" /></button>
                        </div>';
            }
            echo '</div>
              </div>
            </div>
          </div>
        </div>';
          }
        }
        ?>
      </div>
    </article>

    <!--MODAL PARA CREAR UN NUEVO TEMA-->
    <div id="new-theme-modal" class="modal">
      <h2>Add Theme to the Forum</h2>
      <div class="themeFormContainer">
        <div class="inputContainer">
          <label for="Theme_Name">Enter Theme Name:</label>
          <input placeholder="New Theme Name" class="inputText" type="text" name="Theme_Name" id="Theme_Name">
        </div>
        <div class="checkbox-wrapper-46">
          <input type="checkbox" id="cbx-46" class="inp-cbx" />
          <label for="cbx-46" class="cbx"><span>
              <svg viewBox="0 0 12 10" height="10px" width="12px">
                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
              </svg></span><span id="privacyTheme">Accept Privacy and Policy</span>
          </label>
        </div>
        <p id="cbxError">You need to accept Privacy Policy to add a new Theme</p>
        <p id="nameError">You need to add a name to the new Theme</p>

        <div class="themes-btnCont">
          <button id="CloseThemeBtn" class="backTheme">Close</button>
          <button id="addThemeBtn" class="confirmTheme">Confirm New Theme</button>
        </div>
      </div>
    </div>

    <!--MODAL PARA EDITAR UN NUEVO TEMA-->
    <div id="edit-theme-modal" class="modal">
      <h2>Edit theme</h2>
      <div class="themeFormContainer">
        <div class="inputContainer">
          <label for="New_Theme_Name">Enter new Theme Name:</label>
          <input tabindex="0" placeholder="New Theme Name" class="inputText" type="text" name="New_Theme_Name"
            id="New_Theme_Name">
        </div>
        <div class="checkbox-wrapper-46">
          <input type="checkbox" id="cbx-462" class="inp-cbx" />
          <label for="cbx-462" class="cbx"><span>
              <svg viewBox="0 0 12 10" height="10px" width="12px">
                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
              </svg></span><span id="privacyThemeEdit">Accept Privacy and Policy</span>
          </label>
        </div>
        <p id="cbxErrorEdit">You need to accept Privacy Policy to edit the Theme</p>
        <p id="nameErrorEdit">You need to add a name to the new Theme</p>

        <div class="themes-btnCont">
          <button id="CloseEditThemeBtn" class="backTheme">Close</button>
          <button id="editThemeBtn" class="confirmTheme">Confirm New Name</button>
        </div>
      </div>
    </div>

    <!--MODAL DE LA PRIVACIDAD Y CONDICIONES DEL FORO-->
    <div id="new-theme-privacy" class="modal">
      <h2>Privacy Policy</h2>
      <p>At Motoring Community team, we strive to maintain a friendly and respectful environment where all members can
        participate constructively and safely. We want to remind you of some important guidelines regarding acceptable
        conduct in our discussions:</p>
      <p>Mutual Respect: Please treat all members with courtesy and consideration. Avoid insults, personal attacks, or
        any form of disrespectful behavior.</p>
      <p>Appropriate Language: Use appropriate language and avoid the use of obscene words, insults, or any form of
        expression that may be offensive or inappropriate.</p>
      <p>Appropriate Content: Do not post content that may be considered inappropriate, offensive, discriminatory,
        illegal, or that violates the rights of others.</p>
      <p>Compliance with Rules: Follow all rules and guidelines set forth in our Privacy Policy and Terms of Service for
        the forum. Failure to comply with these rules may result in content removal, account suspension, or any other
        necessary disciplinary action.</p>
      <p>All users are responsible for their conduct on the forum and for ensuring that their contributions comply with
        these guidelines. We appreciate your cooperation in maintaining a safe and pleasant environment for everyone.
      </p>
      <p>Thank you for being part of our community!</p>
      <p>Sincerely,
        The Motoring Community Team.</p>
    </div>
  </section>
  <!--INCLUIR EL FOOTER DE LA PAGINA-->
  <?php
  include "footer.php";
  ?>
</body>

</html>