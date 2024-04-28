// Agregar un event listener para detectar el scroll de la página
window.addEventListener("scroll", handleContentVisibility);

$(document).ready(function () {
  $("#header-drop-container-formulaone").hide(); // Ocultar el contenido al cargar la página

  var timeout; // Variable para almacenar el temporizador

  $("#formulaone, #header-drop-container-formulaone").hover(
    function () {
      clearTimeout(timeout); // Limpiar el temporizador para evitar cierres automáticos
      $("#header-drop-container-formulaone")
        .stop()
        .slideDown(function () {
          $(this).css("display", "flex"); // Cambiar a display: flex cuando se completa la animación slideDown
        }); // Mostrar el contenido con animación slideDown
    },
    function () {
      // Iniciar un temporizador para cerrar el contenido después de 500ms (medio segundo)
      timeout = setTimeout(function () {
        $("#header-drop-container-formulaone").stop().slideUp(); // Ocultar el contenido con animación slideUp
      }, 500);
    }
  );

  // Cancelar el cierre si se pasa el ratón sobre el contenido mientras el temporizador está activo
  $("#header-drop-container-formulaone").mouseenter(function () {
    clearTimeout(timeout); // Limpiar el temporizador
  });
});