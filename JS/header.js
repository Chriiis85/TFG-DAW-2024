$(document).ready(function () {
  $("#header-drop-container-formulaone").hide();

  var timeout;

  // Función para desplegar el contenedor
  function showContainer() {
    clearTimeout(timeout);
    $("#header-drop-container-formulaone").stop().slideDown(function () {
      $(this).css("display", "flex");
    });
  }

  // Función para ocultar el contenedor
  function hideContainer() {
    timeout = setTimeout(function () {
      $("#header-drop-container-formulaone").stop().slideUp();
    }, 500);
  }

  // Desplegar el contenedor al enfocar el contenedor formulaone
  $("#formulaone").focus(showContainer);

  // Ocultar el contenedor al desenfocar el contenedor formulaone
  $("#formulaone").blur(function () {
    // Ocultar después de un tiempo si no hay ningún elemento enfocado dentro del contenedor
    timeout = setTimeout(function () {
      if (!$("#header-drop-container-formulaone").find("*:focus").length) {
        hideContainer();
      }
    }, 500);
  });

  // Mantener desplegado mientras el ratón esté sobre el contenedor desplegable
  $("#header-drop-container-formulaone").mouseenter(function () {
    clearTimeout(timeout);
  }).mouseleave(function () {
    hideContainer();
  });

  // Mantener desplegado mientras algún elemento dentro del contenedor tenga el foco
  $("#header-drop-container-formulaone").find("*").focus(function () {
    clearTimeout(timeout);
  }).blur(function () {
    if (!$("#header-drop-container-formulaone").find("*:focus").length) {
      hideContainer();
    }
  });

  $("#redirectFormEnterH1Main").keydown(function(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
      window.location.href = 'index.html';
    }
  });
  $("#redirectFormEnterH3About").keydown(function(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
      window.location.href = 'aboutf1.php';
    }
  });
});

let redirectFormEnterH1Main = document.getElementById("redirectFormEnterH1Main");

