<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users - Motoring Community</title>
  <!--SCRIPTS PARA LAS FUNCIONES DE LOS FORMS-->
  <script defer src="JS/user.js"></script>
  <!--HOJA DE ESTILOS PARA LOS FORMS-->
  <link rel="stylesheet" href="CSS/user.css" />
  <!--HOJA DE ESTILOS PARA EL ICONO DEL INPUT DE LA PWD-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    crossorigin="anonymous" />
</head>

<body>
  <section class="main">
    <!--FORMULARIO PARA EL REGISTRO-->
    <article id="formRegister" class="main-info-Register">
      <form class="main-info-Login" role="form" method="post" action="PHP/Forum/registrar_usuario.php">
        <h1>Motoring Community Register</h1>
        <div class="formField">
          <input type="text" required="" id="mail" name="mail" />
          <span>Username/Mail</span>
        </div>
        <div class="formField">
          <input type="text" required="" id="name" name="name" />
          <span>Name</span>
        </div>
        <div class="formField">
          <input type="text" required="" id="surname" name="surname" />
          <span>Surname</span>
        </div>
        <div class="formField">
          <input type="password" name="passwordRegister" id="passwordRegister" required />
          <span>Password</span>

          <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility()">
            <i id="passwordIconReg" class="fa fa-eye-slash"></i>
            <!--<img src="Images/eye_see.svg" alt="">-->
          </button>
        </div>
        <p onclick="window.location.href = 'users.php'" id="loginFormChange">Have an account? Login here.</p>
        <button type="submit" id="register" class="buttons" role="button">Register</button>
        <button type="button" onclick="window.location.href = 'index.html'" id="home" class="buttons" role="button">
          Go Home
        </button>
      </form>
    </article>

    <!--FOTO DEL FORMULARIO-->
    <article id="foto" class="main-foto">
      <img id="img" src="Images/Login-img.jpg" alt="" />
    </article>
    <!--FORMULARIO PARA EL LOGIN-->
    <article id="formLogin" class="main-info-Login">
      <form class="main-info-Login" role="form" method="post" action="PHP/Forum/validar_usuario.php">
        <h1>Motoring Community Login</h1>
        <div class="formField">
          <input id="usernameLogin" name="username" type="text" required="" />
          <span>Username</span>
        </div>
        <div class="formField">
          <input type="password" name="password" id="pwdLogin" required />
          <span>Password</span>

          <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility2()">
            <i id="passwordIcon" class="fa fa-eye-slash"></i>
            <!--<img src="Images/eye_see.svg" alt="">-->
          </button>
        </div>
        <p id="registerFormChange">Don´t have an account? Register here.</p>
        <button type="submit" id="login" class="buttons" role="button">Login</button>
        <button onclick="window.location.href = 'index.html'" id="home" class="buttons" role="button">
          Go Home
        </button>
        <!--<p id="pwdFormChange">Forgot your password? Reset here.</p>-->
      </form>
    </article>

    <!--FORMULARIO PARA EL FORM DE RESETEAR LA PWD-->

    <article id="formPwd" class="main-info-Pwd">
      <h1>Motoring Community Reset Password</h1>
      <div class="formField">
        <input type="text" required="" />
        <span>Username</span>
      </div>
      <div class="formField">
        <input type="password" id="passwordField2" required />
        <span>New Password</span>
        <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility2()">
          <i id="passwordIcon" class="fa fa-eye-slash"></i>
          <!--<img src="Images/eye_see.svg" alt="">-->
        </button>
      </div>
      <div class="formField">
        <input type="password" id="passwordField2" required />
        <span>Confirm New Password</span>
        <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility2()">
          <i id="passwordIcon" class="fa fa-eye-slash"></i>
          <!--<img src="Images/eye_see.svg" alt="">-->
        </button>
      </div>
      <button id="confirmPwd" class="buttons" role="button">Confirm</button>
      <button onclick="window.location.href = 'users.php'" id="home" class="buttons" role="button">
        Go Back
      </button>
    </article>
  </section>
</body>

</html>