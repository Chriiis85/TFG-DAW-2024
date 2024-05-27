// DETECTAR CUANDO EL CONTENIDO ESTA ARRIBA PARA MOSTRAR U OCULTAR EL CONTENIDO DE ABOUT
function screenTop(element) {
  const rect = element.getBoundingClientRect();
  return rect.top <= window.innerHeight / 1;
}

// FUNCION QUE MUESTRA U OCULTA EL CONTENIDO DE ABOUT CAMBIANDO LA OPACIDAD
function mostrarAbout() {
  const content = document.querySelector(".about");
  if (screenTop(content)) {
    content.style.opacity = "1";
  } else {
    content.style.opacity = "0";
  }
}

// CUANDO LA PAGINA HAGA SCROLL LLAMAMOS A LA FUNCION PARA CAMBIAR LA VISIBILIDAD DEL ABOUT
window.addEventListener("scroll", mostrarAbout);

//CREAR Y MOSTRAR EL CONTENIDO QUE SE DESPLIEGA DEL HEADER
$(document).ready(function () {
  //POR DEFECTO SE MUESTRA CERRADO
  $("#header-drop-container-formulaone").hide();

  var timeout;

  //AL HACER HOVER EN LA SECCION QUE ABRE EL MENU DESPLEGABLE SE REALIZA LO SIGUIENTE:
  $("#formulaone, #header-drop-container-formulaone").hover(
    function () {
      //LIMPIAR EL TIMEOUT AL INICIO PARA EVITAR ERRORES
      clearTimeout(timeout);
      //DETECTAR EL CONTENEDOR Y HACER LA ANIMACION DE DESPLIEGUE(SLIDEDOWN) Y AGREGARLE FLEX PARA QUE SE ABRE Y SE MUESTREN LOS CONTENIDOS
      $("#header-drop-container-formulaone")
        .stop()
        .slideDown(function () {
          $(this).css("display", "flex");
        });
    },
    function () {
      // EL CONTENIDO SE CERRARÁ SI EL USUARIO NO HACE HOVER SOBRE EL PASADO LOS 500 MS
      timeout = setTimeout(function () {
        //MEDIANTE SLIDE UP SUBIR OTRA VEZ EL CONTENEDOR
        $("#header-drop-container-formulaone").stop().slideUp();
      }, 500);
    }
  );

  // SI SE VUELVE HACER HOVER ENCIMA DEL CONTENDOR QUE SE DESPLIEGA SE VUELVE A REINICIAR EL TEMPORIZADOR PARA CREAR EL BUCLE Y MANTENER EL CONTENIDO DESPLEGADO
  $("#header-drop-container-formulaone").mouseenter(function () {
    clearTimeout(timeout);
  });
});

/*----------------------------------------------------------------NEXT RACE-------------------------------------------------------------------*/
// URL DE LA API PARA RECOGER LAS CARRERAS DE LA TEMPORADA ACTUAL
const apiUrl = 'https://ergast.com/api/f1/current.json';

// OBTENER LA CARRERA MAS CERCANA
async function obtenerCarreraMasCercana() {
  try {
    // RECOGER LOS DATOS DE LA API CON UN FETCH Y GUARDARLO EN UN JSON
    const response = await fetch(apiUrl);
    const data = await response.json();

    //ACCEDER AL DATO EN CONCRETO DEL JSON
    const carreras = data.MRData.RaceTable.Races;

    // FECHA ACTUAL
    const fechaActual = new Date();

    // LA CARERA MAS CERCANA POR DEFECTO EN NULL
    let carreraMasCercana = null;
    let tiempoMinimo = Infinity;

    //RECORRER TODAS LAS CARRERAS HASTA QUE MEDIANTE EL FOR RECORRIENDO LOS DIAS DE LA PROXIMA CARRERA Y EL DIA ACTUAL PODRAMOS OBTENER LA PROXIMA CARREA
    for (let i = 0; i < carreras.length; i++) {
      const carreraActual = carreras[i];
      const tiempoActual = new Date(carreraActual.date + 'T' + carreraActual.time) - fechaActual;

      if (tiempoActual > 0 && tiempoActual < tiempoMinimo) {
        tiempoMinimo = tiempoActual;
        carreraMasCercana = carreraActual;
      }
    }

    // SI NO SE ENCUNTRAN CARRERAS SE MUESTRA LA ULTIMA, LA MAS CERCANA YA PASADA
    if (!carreraMasCercana) {
      carreraMasCercana = carreras[carreras.length - 1];
    }

    // TIEMPO QUE QUEDA PARA LA PROXIMA CARRERA
    const dias = Math.floor(tiempoMinimo / (1000 * 60 * 60 * 24));
    const horas = Math.floor((tiempoMinimo % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutos = Math.floor((tiempoMinimo % (1000 * 60 * 60)) / (1000 * 60));

    // DEVOLVEMOS EN UN JSON LA CARRERA MAS CERCANA PARA PINTARLA EN EL DOM
    return {
      nombre: carreraMasCercana.raceName,
      fecha: carreraMasCercana.date,
      dias,
      horas,
      minutos,
      ronda: carreraMasCercana.round
    };
  } catch (error) {
    //CATCH POR SI NO LLEGAN LOS DATOS
    console.error('Error al obtener los datos:', error);
  }
}


// LLAMAR A LA FUNCION MOSTRAR CARRERA MAS CERCANA Y PINTAR LOS DATOS
async function mostrarCarreraMasCercana() {
  try {
    //RECOGER JSON
    const carrera = await obtenerCarreraMasCercana();

    //RECOGER MEDIANTE IDS LOS CONTENEDORES QUE VAMOS A RELLENAR
    let nextracetitle = document.getElementById('next-race-title');
    let nextracefecha = document.getElementById('next-race-date');
    let nextracedias = document.getElementById('next-race-days');
    let nextracehoras = document.getElementById('next-race-hours');
    let nextraceminutos = document.getElementById('countdown-mins');
    let nextraceround = document.getElementById('round-number');
    let imgCircuit = document.getElementById('next-race-circuito');

    //DIVIDIR EL NOMBRE PARA HACER MATCH CON LOS NOMBRES DE LAS IMAGENES DE LOS CIRCUITOS
    let nombrecircuitoimg = carrera.nombre.replace(" ","");
    nombrecircuitoimg = nombrecircuitoimg.replace(" ","");
    nombrecircuitoimg = nombrecircuitoimg.replace(" ","");
    
    //A LOS P/H1 RELLENAMOS CON LOS DATOS Y PONEMOS EL SRC(RUTA) DE LA IMAGEN
    nextracetitle.textContent = carrera.nombre;
    nextracefecha.textContent = await formatearFecha(carrera.fecha);
    nextracedias.textContent = carrera.dias;
    nextracehoras.textContent = carrera.horas;
    nextraceminutos.textContent = carrera.minutos;
    nextraceround.textContent = carrera.ronda;
    imgCircuit.setAttribute("src", "Images/Tracks/"+nombrecircuitoimg+".png");
  } catch (error) {
    //ERROR DEL CATCH PARA MOSTRAR EL ERROR
    console.error('Error al obtener la carrera más cercana:', error);
  }
}

//FORMATEAR LA FECHA PARA QUE SE MUESTRE EL DIA Y LA ABREVIATURA DE MES
async function formatearFecha(fecha) {
  //DIVIDR LA FECHA EN DIA Y MES
  let partesFecha = fecha.split('-');

  //GUARDAR LA DIVISION DE LA FECHA
  let dia = partesFecha[2]; 
  let mes = partesFecha[1];

  //SWITCH PARA LA ABREVIATURA DE LOS MESES
  switch (mes) {
    case "01":
      mes = "Jan";
      break;
    case "02":
      mes = "Feb";
      break;
    case "03":
      mes = "Mar";
      break;
    case "04":
      mes = "Apr";
      break;
    case "05":
      mes = "May";
      break;
    case "06":
      mes = "Jun";
      break;
    case "07":
      mes = "Jul";
      break;
    case "08":
      mes = "Aug";
      break;
    case "09":
      mes = "Sep";
      break;
    case "10":
      mes = "Oct";
      break;
    case "11":
      mes = "Nov";
      break;
    case "12":
      mes = "Dec";
      break;
    default:
      break;
  }

  //DEVOLVER EL DIA Y EL MES
  return dia + " " + mes;
}


// LLAMAR LA FUNCION MOSTRAR CARRERA CADA SEGUNDO Y ASI ACTUALIZAR EL CONTADOR
setInterval(mostrarCarreraMasCercana, 1000);

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

