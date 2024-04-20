// Función para detectar cuándo el contenido está en la parte superior de la ventana o cerca de ella
function isElementNearTop(element) {
  const rect = element.getBoundingClientRect();
  return rect.top <= window.innerHeight / 1;
}

// Función para mostrar u ocultar el contenido con un fade in según la posición del scroll
function handleContentVisibility() {
  const content = document.querySelector(".about");
  if (isElementNearTop(content)) {
    content.style.opacity = "1";
  } else {
    content.style.opacity = "0";
  }
}

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

/*----------------------------------------------------------------NEXT RACE-------------------------------------------------------------------*/
// URL de la API
const apiUrl = 'https://ergast.com/api/f1/current.json';

// Función para obtener la carrera más cercana
async function obtenerCarreraMasCercana() {
  try {
    // Obtenemos los datos de la API
    const response = await fetch(apiUrl);
    const data = await response.json();

    // Extraemos la lista de carreras
    const carreras = data.MRData.RaceTable.Races;

    // Obtenemos la fecha actual
    const fechaActual = new Date();

    // Inicializamos la carrera más cercana con la primera carrera
    let carreraMasCercana = carreras[0];
    let tiempoMinimo = Math.abs(new Date(carreraMasCercana.date + 'T' + carreraMasCercana.time) - fechaActual);

    // Iteramos sobre cada carrera para encontrar la más cercana
    for (let i = 1; i < carreras.length; i++) {
      const carreraActual = carreras[i];
      const tiempoActual = Math.abs(new Date(carreraActual.date + 'T' + carreraActual.time) - fechaActual);

      // Si el tiempo de la carrera actual es menor que el mínimo actual, actualizamos la carrera más cercana
      if (tiempoActual < tiempoMinimo) {
        tiempoMinimo = tiempoActual;
        carreraMasCercana = carreraActual;
      }
    }

    // Calculamos el tiempo restante hasta la próxima carrera
    const dias = Math.floor(tiempoMinimo / (1000 * 60 * 60 * 24));
    const horas = Math.floor((tiempoMinimo % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutos = Math.floor((tiempoMinimo % (1000 * 60 * 60)) / (1000 * 60));

    // Devolvemos la carrera más cercana, su fecha, días, horas, minutos restantes y la ronda en la que se encuentra
    return {
      nombre: carreraMasCercana.raceName,
      fecha: carreraMasCercana.date,
      dias,
      horas,
      minutos,
      ronda: carreraMasCercana.round
    };
  } catch (error) {
    console.error('Error al obtener los datos:', error);
  }
}

// Llamamos a la función para obtener la carrera más cercana y mostramos los resultados
async function mostrarCarreraMasCercana() {
  try {
    const carrera = await obtenerCarreraMasCercana();
    let nextracetitle = document.getElementById('next-race-title');
    let nextracefecha = document.getElementById('next-race-date');
    let nextracedias = document.getElementById('next-race-days');
    let nextracehoras = document.getElementById('next-race-hours');
    let nextraceminutos = document.getElementById('countdown-mins');
    let nextraceround = document.getElementById('round-number');
    let imgCircuit = document.getElementById('next-race-circuito');

    let nombrecircuitoimg = carrera.nombre.replace(" ","");
    nombrecircuitoimg = nombrecircuitoimg .replace(" ","");
    
    nextracetitle.textContent = carrera.nombre;
    nextracefecha.textContent = await formatearFecha(carrera.fecha);
    nextracedias.textContent = carrera.dias;
    nextracehoras.textContent = carrera.horas;
    nextraceminutos.textContent = carrera.minutos;
    nextraceround.textContent = carrera.ronda;
    imgCircuit.setAttribute("src", "Images/Tracks/ChineseGrandPrix.png");
  } catch (error) {
    console.error('Error al obtener la carrera más cercana:', error);
  }
}


async function formatearFecha(fecha) {
  let partesFecha = fecha.split('-'); // Dividir la fecha por guiones

  let dia = partesFecha[2]; // El día es la última parte
  let mes = partesFecha[1]; // El mes es la parte del medio

  switch (mes) {
    case "01":
      mes = "January";
      break;
    case "02":
      mes = "February";
      break;
    case "03":
      mes = "March";
      break;
    case "04":
      mes = "April";
      break;
    case "05":
      mes = "May";
      break;
    case "06":
      mes = "June";
      break;
    case "07":
      mes = "July";
      break;
    case "08":
      mes = "August";
      break;
    case "09":
      mes = "September";
      break;
    case "10":
      mes = "October";
      break;
    case "11":
      mes = "November";
      break;
    case "12":
      mes = "December";
      break;
    default:
      break;
  }

  return dia + " " + mes;
}


// Llamamos a la función para mostrar la carrera más cercana
setInterval(mostrarCarreraMasCercana, 1000);



