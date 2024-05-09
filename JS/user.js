/*FUNCION PARA CAMBIAR LA VISIBILIDAD DE LA CONTRASEÑA Y EL ICONO*/
function togglePasswordVisibility1() {
  var passwordField = document.getElementById("passwordField1");
  var passwordIcon = document.getElementById("passwordIcon");

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

/*FUNCION PARA CAMBIAR LA VISIBILIDAD DE LA CONTRASEÑA Y EL ICONO*/
function togglePasswordVisibility2() {
  var passwordField = document.getElementById("pwdLogin");
  var passwordIcon = document.getElementById("passwordIcon");

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
let changeForm = document
  .getElementById("registerFormChange")
  .addEventListener("click", () => {
    let formLogin = document.getElementById("formLogin");
    formLogin.style.display = "none";

    let image = document.getElementById("foto");
    image.style.borderTopRightRadius = "11px";
    image.style.borderBottomRightRadius = "11px";
    image.style.borderTopLeftRadius = "0px";
    image.style.borderBottomLeftRadius = "0px";
    image.style.borderLeft = "0px";

    let img = document.getElementById("img");
    img.setAttribute("src", "Images/Register-img.jpg");

    let formRegister = document.getElementById("formRegister");
    formRegister.style.display = "flex";
  });

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE LOGIN A CAMBIO PWD*/
let changeForm1 = document
  .getElementById("pwdFormChange")
  .addEventListener("click", () => {
    let formLogin = document.getElementById("formLogin");
    formLogin.style.display = "none";

    let img = document.getElementById("img");
    img.setAttribute("src", "Images/Pwd-img.jpg");

    let formPwd = document.getElementById("formPwd");
    formPwd.style.display = "flex";
  });

/*FORMA PARA CAMBIAR ENTRE FORMULARIOS FORM DE REGISTRO A LOGIN*/
let changeForm2 = document
  .getElementById("loginFormChange")
  .addEventListener("click", () => {
    let formLogin = document.getElementById("formRegister");
    formLogin.style.display = "none";

    let image = document.getElementById("foto");
    image.style.borderTopRightRadius = "0px";
    image.style.borderBottomRightRadius = "0px";
    image.style.borderTopLeftRadius = "11px";
    image.style.borderBottomLeftRadius = "11px";
    image.style.borderLeft = "0px";

    let img = document.getElementById("img");
    img.setAttribute("src", "Images/Login-img.jpg");

    let formRegister = document.getElementById("formLogin");
    formRegister.style.display = "flex";
  });
