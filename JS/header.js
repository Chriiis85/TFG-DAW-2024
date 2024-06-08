$(document).ready(function () {
  $("#header-drop-container-formulaone").hide();
  //VARIABLE PARA OBTENER EL TIEMPO QUE ESTA EL CURSOR EN EL CONTENEDOR QUE SE MUESTRA Y PODER MANTENERLO ABIERTO O CERRARLO
  var timeout;

  //FUNCION PRINCIPAL PARA DESPLEGAR EL CONTENEDOR
  function showContainer() {
    clearTimeout(timeout);
    $("#header-drop-container-formulaone").stop().slideDown(function () {
      $(this).css("display", "flex");
    });
  }

  //FUNCION QUE ESONDE DE NUEVO DEL CONTENEDOR DESPLEGABLE CUANDO PASE MEDIA SEGUNDO SIN TENER EL RATON ENCIMA
  function hideContainer() {
    timeout = setTimeout(function () {
      $("#header-drop-container-formulaone").stop().slideUp();
    }, 500);
  }

  //DESPLEGAR EL CONTENEDOR CUANDO SE HAGA FOCUS PERMITIENDO AUMENTAR LA ACCESIBILIDAD CUANDO UN USUARIO PASE POR ENCIMA
  $("#formulaone").focus(showContainer);

  //OCULTAR CUANDO YA NO ESTA "ENFOCADO" EL CONTENEDOR
  $("#formulaone").blur(function () {
    //SI NINGUNO DE LOS ELEMENTOS DENTRO DEL CONTENEDOR ESTA ENFOCADO POR EL TABINDEX ESTE SE CIERRA
    timeout = setTimeout(function () {
      if (!$("#header-drop-container-formulaone").find("*:focus").length) {
        hideContainer();
      }
    }, 500);
  });

  //SI EL RATON ESTA DENTRO O ENCIMA DEL CONTENIDO SE MANTIENE EL CONTENEDOR ABIERTO Y SE RESETEA EL TIMEOUT PARA MANTENERLO
  $("#header-drop-container-formulaone").mouseenter(function () {
    clearTimeout(timeout);
    //SI EL RATON ABANDONA EL CONTENEDOR SE CIERRA
  }).mouseleave(function () {
    hideContainer();
  });

  //MANTENER EL CONTENEDOR DESPLEGADO MEINTRAS EL TABINDEX ESTE ENCIMA DE CUALQUIER CONTENIDO DENTRO DEL CONTENEDOR
  $("#header-drop-container-formulaone").find("*").focus(function () {
    clearTimeout(timeout);
    //SI EL TABINDEX ABANDONA EL CONTENEDOR SE CIERRA
  }).blur(function () {
    if (!$("#header-drop-container-formulaone").find("*:focus").length) {
      hideContainer();
    }
  });

  //REDIRECCION DE TITULOS QUE NO SON ENLACES MEDIANTE LA TECLA ENTER PARA MEJORAR LA ACCESIBILIDAD
  $("#redirectFormEnterH1Main").keydown(function(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
      window.location.href = 'index.html';
    }
  });

  //REDIRECCION DE TITULOS QUE NO SON ENLACES MEDIANTE LA TECLA ENTER PARA MEJORAR LA ACCESIBILIDAD
  $("#redirectFormEnterH3About").keydown(function(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
      window.location.href = 'aboutf1.php';
    }
  });
});