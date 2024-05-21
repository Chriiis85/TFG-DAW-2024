//FUNCIONALIDAD PARA LOS DIVS DESPLEGABLES MEDIANTE JQUERY
$(document).ready(function () {
    //AL CLICAR EN CUALQUIER TARJETA DE PILOTO ESTA SE DESPLEGARA Y AL VOLVER A CLICAR SE CERRARA CON UNA ANIMACION DE SLIDE
    $(".standings-driver").click(function () {
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
    //AL CLICAR EN CUALQUIER TARJETA DE EQUIPO ESTA SE DESPLEGARA Y AL VOLVER A CLICAR SE CERRARA CON UNA ANIMACION DE SLIDE
    $(".standings-teams").click(function () {
      var info = $(this).next(".standings-teams-info");
      info.slideToggle(function () {
        if ($(this).is(":hidden")) {
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-left-radius", "5px");
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-right-radius", "5px");
        } else {
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-left-radius", "0px");
          $(this)
            .prev(".standings-teams")
            .css("border-bottom-right-radius", "0px");
        }
      });
    });
  });

  //FUNCIONALIDAD PARA EL SELECTOR DE LA CLASIFICACION A MOSTRAR, RECOGEMOS EL CLICK Y DETECTAMOS EN CUAL ESTA
  let DriverStan = document.getElementById("DriverStan").addEventListener("click", ()=>{
    let barDriverStan = document.getElementById("barDriverStan");
    let barConstStan = document.getElementById("barConstStan");

    let teams = document.querySelector(".standings-teams-container");
    let drivers = document.querySelector(".standings-drivers-container");

    //OCULTAMOS O MOSTRAMOS EL CONTENEDOR QUE CONTIENE LA TABLA DE CLASIFICACIONES
    barDriverStan.style.display="block";
    barConstStan.style.display="none";

    teams.style.display="none";
    drivers.style.display="block";
  });

  //FUNCIONALIDAD PARA EL SELECTOR DE LA CLASIFICACION A MOSTRAR, RECOGEMOS EL CLICK Y DETECTAMOS EN CUAL ESTA
  let ConstStan = document.getElementById("ConstStan").addEventListener("click", ()=>{
    let barDriverStan = document.getElementById("barDriverStan");
    let barConstStan = document.getElementById("barConstStan");

    let teams = document.querySelector(".standings-teams-container");
    let drivers = document.querySelector(".standings-drivers-container");
    
    //OCULTAMOS O MOSTRAMOS EL CONTENEDOR QUE CONTIENE LA TABLA DE CLASIFICACIONES
    barDriverStan.style.display="none";
    barConstStan.style.display="block";

    teams.style.display="block";
    drivers.style.display="none";
  });

  //FUNCIONALIDAD PARA EL BOTON QUE PERMITE AL USUARIO VOLVER AL PRINCIPIO DE LA PAGINA
  document.getElementById("upBtn").classList.add("hidden");
  window.onscroll = function () { scrollFunction() };

  function scrollFunction() {
    if (document.body.scrollTop > window.innerHeight || document.documentElement.scrollTop > window.innerHeight) {
      document.getElementById("upBtn").classList.remove("hidden");
    } else {
      document.getElementById("upBtn").classList.add("hidden");
    }
  }

  function scrollToTop() {
    const scrollStep = -window.scrollY / (500 / 15);
    const scrollInterval = setInterval(function () {
      if (window.scrollY != 0) {
        window.scrollBy(0, scrollStep);
      }
      else clearInterval(scrollInterval);
    }, 15);
  }