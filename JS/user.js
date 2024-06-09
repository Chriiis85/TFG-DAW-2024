/*FUNCION PARA CAMBIAR LA VISIBILIDAD DE LA CONTRASEÑA Y EL ICONO*/
function togglePasswordVisibility2() {
  //RECOGER EL CAMPO Y EL ICONO
  var passwordField = document.getElementById("pwdLogin");
  var passwordIcon = document.getElementById("passwordIcon");

  //CAMBIAR ENTRE MOSTRAR EL CAMPO(TEXTO DE LA PWD) Y CAMBIAR LOS ICONOS
  if (passwordField.type === "password") {
    //CAMBIAR TYPO DE INPUT
    passwordField.type = "text";
    //CAMBIAR ICONOS
    passwordIcon.classList.remove("fa-eye-slash");
    passwordIcon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    passwordIcon.classList.remove("fa-eye");
    passwordIcon.classList.add("fa-eye-slash");
  }
}

/*FUNCION PARA CAMBIAR LA VISIBILIDAD DE LA CONTRASEÑA Y EL ICONO*/
function togglePasswordVisibility() {
  var passwordField = document.getElementById("passwordRegister");
  var passwordIcon = document.getElementById("passwordIconReg");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    passwordIcon.classList.remove("fa-eye-slash");
    passwordIcon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    passwordIcon.classList.remove("fa-eye");
    passwordIcon.classList.add("fa-eye-slash");
  }
}

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE LOGIN A REGISTRO*/
/*AÑADIR EVENTOS DE ESCUCHA TANTO PARA TECLADO COMO PARA RATON PARA NAVEGAR POR LA WEB*/
document.getElementById("registerFormChange").addEventListener("click", () => {
  changeFormRegister();
});

document
  .getElementById("registerFormChange")
  .addEventListener("keypress", (event) => {
    //COMRPOBAR QUE SE TECLEA LA TECLA ESPACIO
    if (event.which === 32 || event.keyCode === 32) {
      event.preventDefault();
      //CAMBIAR DE FORMULARIO
      changeFormRegister();
    }
  });

//FUNCIONALIDAD QUE CAMBIA DE FORMULARIOS MOSTRANDO UNO U OTRO
function changeFormRegister() {
  let formLogin = document.getElementById("formLogin");
  formLogin.style.display = "none";

  //CAMBIAR LAS IMAGENES Y EL CONTENEDOR PARA AJUSTARSE AL NUEVO
  let image = document.getElementById("foto");
  image.style.borderTopRightRadius = "11px";
  image.style.borderBottomRightRadius = "11px";
  image.style.borderTopLeftRadius = "0px";
  image.style.borderBottomLeftRadius = "0px";
  image.style.borderLeft = "0px";

  //AGREGAR EL NUEVO SRC DE LA NUEVA IMAGEN
  let img = document.getElementById("img");
  img.setAttribute("src", "Images/Register-img.jpg");

  //MOSTRAR EL CONTENEDOR AL CUAL VAMOS A CAMBIAR Y MOSTRAR
  let formRegister = document.getElementById("formRegister");
  formRegister.style.display = "flex";
}

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE LOGIN A CAMBIO PWD*/
/*let changeForm1 = document
  .getElementById("pwdFormChange")
  .addEventListener("click", () => {
    let formLogin = document.getElementById("formLogin");
    formLogin.style.display = "none";

    let img = document.getElementById("img");
    img.setAttribute("src", "Images/Pwd-img.jpg");

    let formPwd = document.getElementById("formPwd");
    formPwd.style.display = "flex";
  });*/

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE REGISTRO A LOGIN*/
/*AÑADIR EVENTOS DE ESCUCHA TANTO PARA TECLADO COMO PARA RATON PARA NAVEGAR POR LA WEB*/
document
  .getElementById("loginFormChange")
  .addEventListener("click", changeFormLogin);

document
  .getElementById("loginFormChange")
  .addEventListener("keypress", function (event) {
    //COMRPOBAR QUE SE TECLEA LA TECLA ESPACIO
    if (event.which === 32 || event.keyCode === 32) {
      event.preventDefault();
      //CAMBIAR DE FORMULARIO
      changeFormLogin();
    }
  });

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE LOGIN A REGISTRO*/
/*AÑADIR EVENTOS DE ESCUCHA TANTO PARA TECLADO COMO PARA RATON PARA NAVEGAR POR LA WEB*/
function changeFormLogin() {
  let formLogin = document.getElementById("formRegister");
  formLogin.style.display = "none";

  //CAMBIAR IMAGENES Y ESTILO
  let image = document.getElementById("foto");
  image.style.borderTopRightRadius = "0px";
  image.style.borderBottomRightRadius = "0px";
  image.style.borderTopLeftRadius = "11px";
  image.style.borderBottomLeftRadius = "11px";
  image.style.borderLeft = "0px";

  //CAMBIAR LA IMAGEN
  let img = document.getElementById("img");
  img.setAttribute("src", "Images/Login-img.jpg");

  //MOSTRAR EL CONTENEDOR AL CUAL VAMOS A CAMBIAR Y MOSTRAR
  let formRegister = document.getElementById("formLogin");
  formRegister.style.display = "flex";
}

/*CONTROLAR QUE LA CONTRASEÑA SEA SEGURA Y CONTENGA CARACTERES QUE LA HAGAN FUERTE*/
var pwdErrorP = document.getElementById("pwdError");

function validatePWD(pwd) {
  // VERIFICAR SI LA CONTRASEÑA ES DE AL MENOS 8 CARACTERES ALFANUMERICOS
  if (pwd.length < 8) {
    return false;
  }

  // COMROBAR SI MEDIANTE PATTERNS LA CONTRASEÑA TIENE LOS PATTERN SIGUIENTES
  var tieneMayuscula = /[A-Z]/.test(pwd);
  var tieneMinuscula = /[a-z]/.test(pwd);
  var tieneNumero = /[0-9]/.test(pwd);
  var tieneCaracterEspecial = /[^A-Za-z0-9]/.test(pwd);

  //TEST DEVUELVE TRUE O FALSE, DEVOLVEMOS LA VAR
  return (
    tieneMayuscula && tieneMinuscula && tieneNumero && tieneCaracterEspecial
  );
}

//RECOGER EL INPUT DE LA PWD
var passwordFieldRegister = document.getElementById("passwordRegister");

//CADA LETRA QUE SE SE ESCRIBA SE VA VERIFICANDO
passwordFieldRegister.addEventListener("input", function () {
  //SI CUMPLE EL PATTERN Y LA LONGITUD OCULTAMOS
  if (validatePWD(passwordFieldRegister.value)) {
    pwdErrorP.style.display = "none";
    //HABILITAR EL BOTON PARA PODER REGISTRARSE
    let register = document.getElementById("register");
    register.disabled = false;
  }
  //SI NO CUMPLE EL PATTERN Y LA LONGITUD MUESTRA EL ERROR
  else {
    pwdErrorP.style.display = "block";
    pwdErrorP.textContent =
      "The password is not safe enough.Pwd must contain 1 Upcase, 1 LowCase, 1 Character and at least 8 Character/Numbers";
  }
});
