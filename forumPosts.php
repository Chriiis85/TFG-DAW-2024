<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motoring Community - Forum</title>
  <script defer src="JS/post.js"></script>
  <!-- SCRIPT JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- SCRIPT JQUERY MODALS ALERT -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SCRIPT Y HOJA DE ESTILOS JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <!-- Link al archivo CSS -->
</head>
<?php
//include "headerForum.php";
?>

<body>
  <link rel="stylesheet" href="CSS/forumPosts.css" />
  <?php
  $id_theme = $_GET["id"];
  include "PHP/Forum/returnPosts.php";
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    // Si no está establecida, muestra un mensaje indicando que no se encontró la cookie
    header('Location: users.php');
  }
  $id_usu_theme = returnIdUsu($username);
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

  <section class="main" id="<?php echo $id_theme; ?>">
    <article class="posts-container" id="postsContainer">
      <div class="main-bar">
        <div class="main-bar-filter">
          <div class="select">
            <select id="filter">
              <option value="Default">Default</option>
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
          <button id="newPost" class="button-add" role="button">Add new Post</button>
        </div>
      </div>
      <div class="posts-container-info">
        <h1 id="orderP">Order by: Default.</h1>
        <h1>Theme Name: <?php echo returnThemeName($id_theme) ?></h1>
        <h1 id="countPostP"></h1>
      </div>
      <div id="posts-group" class="posts-group">
        <?php
        $posts = returnPostsDate($id_theme);
        if (sizeof($posts) == 0) {
          echo '<img class="imgnoresult" src="https://cdn.dribbble.com/users/1883357/screenshots/6016190/search_no_result.png" alt="" />';
        } else {
          for ($i = 0; $i < sizeof($posts); $i++) {
            echo '<div class="post-container">
                    <div class="post-container-1">
                      <h1 id="'.$posts[$i][3].'" class="usu">Posted by: ' . returnNombreUsu($posts[$i][3]) . '.</h1>
                      <p>Posted on: ' . $posts[$i][2] . '.</p>
                      <!--<div class="post-card-views">
                      <img src="Images/view.svg" alt="" />
                      <p>Views: 1</p>
                      </div>-->';
            if ($posts[$i][3] == $id_usu_theme || $username == "admin") {
              echo '<div class="post-card-6-edit">
                                  <button class="editPostBtn" id="editCard-' . $posts[$i][0] . '"><img src="Images/edit.svg" alt="" /></button>
                                  <button class="deletePostBtn" id="deleteCard-' . $posts[$i][0] . '"><img src="Images/delete.svg" alt="" /></button>
                                </div>';
            }
            echo '</div>
                  <div class="post-container-2">
                    <p id="postContent-' . $posts[$i][0] . '">' . $posts[$i][1] . '</p>
                  </div>
                </div>';
          }
        }
        ?>
      </div>
    </article>

    <div id="new-post-modal" class="modal">
      <h2>Add new Post to the Forum</h2>
      <div class="themeFormContainer">
        <div class="inputContainer">
          <label for="Post_Content">Enter new Post content:</label>
          <!--<input placeholder="New Post Content" class="inputText" type="textarea" name="Post_Content" id="Post_Content">-->
          <textarea class="inputTextArea" placeholder="Write the new post content" name="Post_Content" id="Post_Content"
            rows="10" cols="100"></textarea>

        </div>
        <div class="checkbox-wrapper-46">
          <input type="checkbox" id="cbx-46" class="inp-cbx" />
          <label for="cbx-46" class="cbx"><span>
              <svg viewBox="0 0 12 10" height="10px" width="12px">
                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
              </svg></span><span id="privacyTheme">Accept Privacy and Policy</span>
          </label>
        </div>
        <p id="cbxError">You need to accept Privacy Policy to add a new Post</p>
        <p id="nameError">You need to add content to the new Post</p>

        <div class="themes-btnCont">
          <button id="ClosePostBtn" class="backTheme">Close</button>
          <button id="addPostBtn" class="confirmTheme">Confirm New Post</button>
        </div>
      </div>
    </div>

    <div id="edit-post-modal" class="modal">
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