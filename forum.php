<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motoring Community - Forum</title>
  <script defer src="JS/forum.js"></script>
  <!-- SCRIPT JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- SCRIPT JQUERY MODALS ALERT -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SCRIPT Y HOJA DE ESTILOS JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <!-- Link al archivo CSS -->
</head>

<body>
  <link rel="stylesheet" href="CSS/forum.css" />
  <?php
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    // Si no está establecida, muestra un mensaje indicando que no se encontró la cookie
    header('Location: users.php');
  }
  ?>
  <header>
    <?php
    echo '<div class="header-container">
      <h1 onclick="window.location.href = \'forum.php\'">MOTORING COMMUNITY FORUM</h1>
    </div>';
    echo '<div class="user">
      <p>Welcome Back: ' . $username . '!</p>
      <button id="logout" class="logOutBtn">Log Out<img src="Images/logout.svg" alt=""></button>
    </div>';
    ?>

  </header>

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
        <h1 id="orderP">Order by: Default.</h1>
        <h1 id="countPostP"></h1>
      </div>
      <div id="posts-group" class="posts-group">
        <?php
        include "PHP/Forum/returnThemes.php";
        $themes = returnThemesByDefault();
        $id_usu_theme = returnIdUsu($username);
        if (sizeof($themes) == 0) {
          echo '<img class="img-noresult" src="https://cdn.dribbble.com/users/1883357/screenshots/6016190/search_no_result.png" alt="" />';
        } else {
          for ($i = 0; $i < sizeof($themes); $i++) {
            echo '<div id="post-card-container" class="post-card-container">
          <div id="postCard' . $themes[$i][0] . '" onclick="window.location.href = \'forumPosts.php?id=' . $themes[$i][0] . '\'" class="post-card">
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
                      <img src="Images/view.svg" alt="" />
                      <p>' . $themes[$i][4] . '</p>
                    </div>-->
                    <div class="post-card-msg">
                      <img src="Images/msg.svg" alt="" />
                      <p>Posts: ' . returnNumberPosts($themes[$i][0]) . '.</p>
                    </div>
                  </div>';
            if ($themes[$i][3] == $id_usu_theme || $username == "admin") {
              echo '<div class="post-card-6-edit">
                          <button class="editThemeBtn" id="editCard-' . $themes[$i][0] . '"><img src="Images/edit.svg" alt="" /></button>
                          <button class="deleteThemeBtn" id="deleteCard-' . $themes[$i][0] . '"><img src="Images/delete.svg" alt="" /></button>
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

    <div id="new-theme-modal" class="modal">
      <h2>Add Theme to the Forum</h2>
      <div class="themeFormContainer">
        <div class="inputContainer">
          <label for="">Enter Theme Name:</label>
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

    <div id="edit-theme-modal" class="modal">
      <h2>Edit theme</h2>
      <div class="themeFormContainer">
        <div class="inputContainer">
          <label for="">Enter new Theme Name:</label>
          <input placeholder="New Theme Name" class="inputText" type="text" name="New_Theme_Name" id="New_Theme_Name">
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
  <?php
  include "footer.php";
  ?>
</body>
<script>

</script>
<?php
function returnIdUsu($id_nombre)
{
  // CONSULTA A EJECUTAR
  $consulta = "SELECT id FROM users WHERE username = ?";
  include "PHP/Forum/conexion.php";

  // VERIFICAR LA CONEXIÓN
  if (!$con) {
    return "Error: No se pudo conectar a la base de datos";
  }

  // INICIAR EL STATEMENT
  $stmt = mysqli_stmt_init($con);

  // PREPARAR LA CONSULTA
  if (mysqli_stmt_prepare($stmt, $consulta)) {
    // ENLAZAR LOS PARÁMETROS
    mysqli_stmt_bind_param($stmt, "s", $id_nombre);

    // EJECUTAR EL STATEMENT
    mysqli_stmt_execute($stmt);

    // OBTENER EL RESULTADO
    mysqli_stmt_bind_result($stmt, $id_usuario);
    mysqli_stmt_fetch($stmt);

    // CERRAR EL STATEMENT
    mysqli_stmt_close($stmt);

    // DEVOLVER EL ID DEL USUARIO
    return $id_usuario;
  } else {
    // MANEJO DE ERRORES SI LA PREPARACIÓN DE LA CONSULTA FALLA
    return "Error: No se pudo preparar la consulta";
  }
} ?>


</html>