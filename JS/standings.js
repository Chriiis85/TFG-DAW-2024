//FUNCIONALIDAD PARA LOS DIVS DESPLEGABLES MEDIANTE JQUERY
$(document).ready(function () {
  //AL CLICAR EN CUALQUIER TARJETA DE PILOTO ESTA SE DESPLEGARA Y AL VOLVER A CLICAR SE CERRARA CON UNA ANIMACION DE SLIDE
  $(".standings-driver").on("click keypress", function (event) {
    //VERIFICAR SI SE CLICA LA TECLA ESPACIO PARA PERMITIR VISUALIZAR LA CATA ENTERA
    if (event.type === "keypress" && event.which !== 32) {
      return;
    }
    event.preventDefault();

    // MOSTRAR Y OCULTAR EL CONTENIDO CAMBIANDO ESTILOS Y DESPLEGANDO EL CONTENEDOR
    var info = $(this).next(".standings-driver-info");
    info.slideToggle(function () {
      if ($(this).is(":hidden")) {
        $(this)
          .prev(".standings-driver")
          .css("border-bottom-left-radius", "5px");
        $(this)
          .prev(".standings-driver")
          .css("border-bottom-right-radius", "5px");
      } else {
        $(this)
          .prev(".standings-driver")
          .css("border-bottom-left-radius", "0px");
        $(this)
          .prev(".standings-driver")
          .css("border-bottom-right-radius", "0px");
      }
    });
  });

  $(".standings-teams").on("click keypress", function (event) {
    // Verificar si se ha presionado la tecla Espacio (código 32) o si se hizo clic
    if (event.type === "click" || (event.type === "keypress" && event.which === 32)) {
        // Prevenir el comportamiento predeterminado para evitar que la página se desplace
        event.preventDefault();

        // MOSTRAR Y OCULTAR EL CONTENIDO CAMBIANDO ESTILOS Y DESPLEGANDO EL CONTENEDOR
        var info = $(this).next(".standings-teams-info");
        info.slideToggle(function () {
            if ($(this).is(":hidden")) {
                $(this)
                    .prev(".standings-teams")
                    .css("border-bottom-left-radius", "5px")
                    .css("border-bottom-right-radius", "5px");
            } else {
                $(this)
                    .prev(".standings-teams")
                    .css("border-bottom-left-radius", "0px")
                    .css("border-bottom-right-radius", "0px");
            }
        });
    }
});
});

//FUNCIONALIDAD PARA EL SELECTOR DE LA CLASIFICACION A MOSTRAR, RECOGEMOS EL CLICK Y DETECTAMOS EN CUAL ESTA

//SE AÑADE UN EVENTO DE ESCUCCHA PARA QUE PERMITA ABRIRSE TANTO POR RATON COMO POR TECLADO
document
  .getElementById("DriverStan")
  .addEventListener("click", function (event) {
    //LLAMAR A LA FUNCION QUE MUESTRA LOS PILOTOS
    showDrivers();
  });

document
  .getElementById("ConstStan")
  .addEventListener("click", function (event) {
    //LLAMAR A LA FUNCION QUE MUESTRA LOS EQUIPOS
    showTeams();
  });

document
  .getElementById("DriverStan")
  .addEventListener("keypress", function (event) {
    //COMPROBAR QUE SE TECLEA LA TECLA ENTER
    if (event.key === "Enter") {
      //LLAMAR A LA FUNCION QUE MUESTRA LOS PILOTOS
      showDrivers();
    }
  });

document
  .getElementById("ConstStan")
  .addEventListener("keypress", function (event) {
    // Verificar si se presionó la tecla Enter (código 13)
    if (event.key === "Enter") {
      //LLAMAR A LA FUNCION QUE MUESTRA LOS EQUIPOS
      showTeams();
    }
  });

//FUNCION QUE MUESTRA LA LISTA DE LOS PILOTOS Y LA CLASIFICACION
function showDrivers() {
  let barDriverStan = document.getElementById("barDriverStan");
  let barConstStan = document.getElementById("barConstStan");
  let teams = document.querySelector(".standings-teams-container");
  let drivers = document.querySelector(".standings-drivers-container");

  //OCULTAR O MOSTRAR EL CONTENEDOR QUE CONTIENE LA TABLA DE CLASIFICACIONES
  barDriverStan.style.display = "block";
  barConstStan.style.display = "none";
  teams.style.display = "none";
  drivers.style.display = "block";
}

//FUNCION QUE MUESTRA LA LISTA DE LOS EQUIPOS Y LA CLASIFICACION
function showTeams() {
  let barDriverStan = document.getElementById("barDriverStan");
  let barConstStan = document.getElementById("barConstStan");
  let teams = document.querySelector(".standings-teams-container");
  let drivers = document.querySelector(".standings-drivers-container");

  //OCULTAR O MOSTRAR EL CONTENEDOR QUE CONTIENE LA TABLA DE CLASIFICACIONES
  barDriverStan.style.display = "none";
  barConstStan.style.display = "block";
  teams.style.display = "block";
  drivers.style.display = "none";
}

/*--------------------------------------------FUNCIONALIDAD DEL ELEMENTO DE BOTON VOLVER ARRIBA------------------------------------------------*/
//RECOGER EL BOTON
document.getElementById("upBtn").classList.add("hidden");
//CUANDO SE DETECTE SCROLL LLAMAR A LA FUNCION DE SCROLLEO
window.onscroll = function() {scrollFunction()};

//DETECTAR CUANDO SE VA A MOSTRAR EL BOTON, CUANDO PASE DE LA PARTE PRINCIPAL DE LA PAGINA
function scrollFunction() {
  if (document.body.scrollTop > window.innerHeight || document.documentElement.scrollTop > window.innerHeight) {
    document.getElementById("upBtn").classList.remove("hidden");
  } else {
    document.getElementById("upBtn").classList.add("hidden");
  }
}

//FUNCION PARA VOLVER ARRIBA DE LA PAGIINA
function scrollToTop() {
  const scrollStep = -window.scrollY / (500 / 15);
  const scrollInterval = setInterval(function(){
    if ( window.scrollY != 0 ) {
      window.scrollBy( 0, scrollStep );
    }
    else clearInterval(scrollInterval);
  },15);
}
