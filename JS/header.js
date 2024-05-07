//FUNCIONALIDAD DEL HEADER CON EL HOVER Y DESPLEGABLES CON JQUERY
$(document).ready(function () {
  $("#header-drop-container-formulaone").hide();

  var timeout;
  //SI SE HACE HOVER AL ABOUT DEL CONTENEDOR SE DESPLEGARÁN LOS CONTENIDOS
  $("#formulaone, #header-drop-container-formulaone").hover(
    function () {
      clearTimeout(timeout);
      $("#header-drop-container-formulaone")
        .stop()
        .slideDown(function () {
          $(this).css("display", "flex");
        });
    },
    function () {
      //SE CIERRA EL CONTENIDO SI NO SE HACE HOVER ENCIMA DE EL Y SE OCULTA EL CONTENIDO
      timeout = setTimeout(function () {
        $("#header-drop-container-formulaone").stop().slideUp();
      }, 500);
    }
  );

  //SI EL USUARIO TIENE EL RATON ENCIMA DEL CONTENEDOR QUE SE ABRE SE REINICIA EL TIMEOUT PARA SEGUIR MOSTRARNDOLO
  $("#header-drop-container-formulaone").mouseenter(function () {
    clearTimeout(timeout);
  });
});
