//RECOGER LOS TRES SELECTS
let select1 = document.getElementById("select1");
let select2 = document.getElementById("select2");
let select3 = document.getElementById("select3");

//FUNCION PARA RECOGER LA CLASIFICACION DE PILOTOS POR AÑO, QUE SE LE PASA POR PARAMETRO
async function obtenerStandingsDriverYear(year) {
  return new Promise((resolve, reject) => {
    //SOLICITUD AJAX QUE ENVIA POR JS A PHP MEDIANTE POST UNA PETICION AL ARCHIVO QUE RECOGE LOS DATOS DE LOS PILOTOS
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            //RECOGER EL RESULTADO DE LA RESPUESTA PARA PODER PINTAR LUEGO EN LA TABLA CON EL ARRAY DATA QUE CONTIENE EL JSON
              let result = JSON.parse(this.responseText);
              let data = result.MRData.StandingsTable.StandingsLists[0].DriverStandings;
              resolve(data);
          }
      };
      //MANDAR LA SOLICITUD CON EL AÑO COMO PARAMETRO
      xhttp.open("POST", "PHP/getDataDrivers.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year);
  });
}

//FUNCION PARA RECOGER LA CLASIFICACION DE CONSTRUCTORES POR AÑO
async function obtenerStandingsConstructorYear(year) {
  return new Promise((resolve, reject) => {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let result = JSON.parse(this.responseText);
              let data = result.MRData.StandingsTable.StandingsLists[0].ConstructorStandings;
              resolve(data);
          }
      };
      xhttp.open("POST", "PHP/getDataConstructors.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year);
  });
}

//FUNCION PARA RECOGER LAS CARRERAS POR AÑO Y MOSTRAR EN EL SELECT CADA CARRERA DE CADA AÑO INTRODUCIDO
async function obtenerRacesYear(year) {
  return new Promise((resolve, reject) => {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let result = JSON.parse(this.responseText);
              let data = result.MRData.RaceTable.Races;
              resolve(data);
          }
      };
      xhttp.open("POST", "PHP/getAllRaces.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year);
  });
}

//FUNCION QUE OBTIENE LOS RESULTADOS DE LA CARRERA DEL AÑO QUE SE LE PASA Y DE LA CARRERA EXACTA PARA VER EL RESTULTADO
async function obtenerRacesResult(year,round) {
  return new Promise((resolve, reject) => {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let result = JSON.parse(this.responseText);
              let data = result.MRData.RaceTable.Races[0].Results;
              resolve(data);
          }
      };
      xhttp.open("POST", "PHP/getResultRace.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year + "&round=" + round);
  });
}

//FUNCION QUE PINTA Y MUESTRA LOS RESULTADOS EN LA TABLA MEDIANTE LAS OPCIONES Y FILTROS DE LOS SELECTS
function mostrarResultados(opcionSeleccionada1, opcionSeleccionada2, opcionSeleccionada3) {
  //CONSTRUCTORES
  if (opcionSeleccionada2 == "Constructors") {
    select3.style.display="none";
    obtenerStandingsConstructorYear(opcionSeleccionada1).then((resultados) => {
      //CREAR LA TABLA MEDIANTE JS DINAMICAMENTE Y PINTAR LOS DATOS
      let tablaTBody = document.getElementById("tabla-tbody");
      tablaTBody.innerHTML = "";
      let tablaTHead = document.getElementById("tabla-thead");
      tablaTHead.innerHTML = "";

      let tablaTHeadtr = document.createElement("tr");
      let th1 = document.createElement("th");
      th1.textContent = "Position";
      let th2 = document.createElement("th");
      th2.textContent = "Team Name";
      let th3 = document.createElement("th");
      th3.textContent = "Points";

      tablaTHeadtr.appendChild(th1);
      tablaTHeadtr.appendChild(th2);
      tablaTHeadtr.appendChild(th3);

      tablaTHead.appendChild(tablaTHeadtr)

      //FILAS Y COLUMNAS QUE SE PINTAN RECORRIENDO EL ARRAY DE NOS DEVUELVE LA PETICION DE LA API
      for (const escuderia of resultados) {
        let tr = document.createElement("tr");
        let tdPosicion = document.createElement("td");
        let tdNombre = document.createElement("td");
        let tdPuntos = document.createElement("td");

        tdPosicion.textContent = escuderia.position;
        tdNombre.textContent = escuderia.Constructor.name;
        tdPuntos.textContent = escuderia.points;

        tr.appendChild(tdPosicion);
        tr.appendChild(tdNombre);
        tr.appendChild(tdPuntos);
        tablaTBody.appendChild(tr);
      }

      //ACTUALIZAR TITULO
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 + " Constructors Standings";
    });
  //PILOTOS
  } else if (opcionSeleccionada2 == "Drivers") {
    select3.style.display="none";
    obtenerStandingsDriverYear(opcionSeleccionada1).then((resultados) => {
      //CREAR LA TABLA MEDIANTE JS DINAMICAMENTE Y PINTAR LOS DATOS
      let tablaTBody = document.getElementById("tabla-tbody");
      tablaTBody.innerHTML = "";
      let tablaTHead = document.getElementById("tabla-thead");
      tablaTHead.innerHTML = "";

      let tablaTHeadtr = document.createElement("tr");
      let th1 = document.createElement("th");
      th1.textContent = "Position";
      let th2 = document.createElement("th");
      th2.textContent = "Driver Name";
      let th3 = document.createElement("th");
      th3.textContent = "Points";

      tablaTHeadtr.appendChild(th1);
      tablaTHeadtr.appendChild(th2);
      tablaTHeadtr.appendChild(th3);

      tablaTHead.appendChild(tablaTHeadtr);

      //FILAS Y COLUMNAS QUE SE PINTAN RECORRIENDO EL ARRAY DE NOS DEVUELVE LA PETICION DE LA API
      for (const piloto of resultados) {
        let tr = document.createElement("tr");
        let tdPosicion = document.createElement("td");
        let tdNombre = document.createElement("td");
        let tdPuntos = document.createElement("td");

        tdPosicion.textContent = piloto.position;
        tdNombre.textContent =
          piloto.Driver.givenName + " " + piloto.Driver.familyName;
        tdPuntos.textContent = piloto.points;

        tr.appendChild(tdPosicion);
        tr.appendChild(tdNombre);
        tr.appendChild(tdPuntos);
        tablaTBody.appendChild(tr);
      }

      //ACTUALIZAR TITULO
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 + " Driver Standings";
    });
  //CARRERAS
  }else if (opcionSeleccionada2 == "Race") {
    select3.style.display="block";
    obtenerRacesResult(opcionSeleccionada1, opcionSeleccionada3).then((resultados) => {
      //CREAR LA TABLA MEDIANTE JS DINAMICAMENTE Y PINTAR LOS DATOS
      let tablaTBody = document.getElementById("tabla-tbody");
      tablaTBody.innerHTML = "";
      let tablaTHead = document.getElementById("tabla-thead");
      tablaTHead.innerHTML = "";

      let tablaTHeadtr = document.createElement("tr");
      let th1 = document.createElement("th");
      th1.textContent = "Position";
      let th2 = document.createElement("th");
      th2.textContent = "Driver Name";
      let th3 = document.createElement("th");
      th3.textContent = "Points";

      tablaTHeadtr.appendChild(th1);
      tablaTHeadtr.appendChild(th2);
      tablaTHeadtr.appendChild(th3);

      tablaTHead.appendChild(tablaTHeadtr);

      //FILAS Y COLUMNAS QUE SE PINTAN RECORRIENDO EL ARRAY DE NOS DEVUELVE LA PETICION DE LA API
      for (const piloto of resultados) {
        let tr = document.createElement("tr");
        let tdPosicion = document.createElement("td");
        let tdNombre = document.createElement("td");
        let tdPuntos = document.createElement("td");

        tdPosicion.textContent = piloto.position;
        tdNombre.textContent =
          piloto.Driver.givenName + " " + piloto.Driver.familyName;
        tdPuntos.textContent = piloto.points;

        tr.appendChild(tdPosicion);
        tr.appendChild(tdNombre);
        tr.appendChild(tdPuntos);
        tablaTBody.appendChild(tr);
      }
      //ACTUALIZAR TITULO
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 +" "+ select3.options[select3.selectedIndex].textContent +" Results";
    });
  }
}

//OBTENER CARRERAS POR LA CARRERA/RONDA SELECCIONADA Y POSTERIORMENTE SE OBTIENE LA RONDA Y MEDIANTE LA FUNCION OBTENERRACESYEAR SE OBTIENE
//TODA LA INFORMACION DE LA CARRERA SELECCIONADA
function obtenerCarreras(opcionSeleccionada){
  select3.innerHTML="";
  obtenerRacesYear(opcionSeleccionada).then((resultados) => {
    //console.log(resultados)
    for (let i = 0; i < resultados.length; i++) {
      let option = document.createElement("option");
      option.value = resultados[i]['round'];
      option.textContent = resultados[i]['raceName'];
      select3.appendChild(option);
    }
  });
}

//AÑADIR UN EVENTO PARA CADA SELECT QUE DETECTA UN CAMBIO Y MOSTRAR Y OBTENER LOS RESULTADOS/CARRERAS PARA SER PINTADOS
  select2.addEventListener("change", function () {
    //OBTENER VALOR SELECCIONADO
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    //MOSTRAR Y BOTENER LAS CARRERAS DEPENDIENDO DE LOS VALORES SELECCIONADOS
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
    obtenerCarreras(opcionSeleccionada1);
  });
  
  select1.addEventListener("change", function () {
    //OBTENER VALOR SELECCIONADO
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
    obtenerCarreras(opcionSeleccionada1);
  });

  select3.addEventListener("change", function () {
    //OBTENER VALOR SELECCIONADO
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    //MOSTRAR RESULTADO DE LA CARRERA SELECCIONADA
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
  });
  
  //RELLENAR EL PRIMER SELECT CON TODOS LOS AÑOS DISPONIBLES PARA FILTRAR
  for (let i = 2024; i > 1979; i--) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    select1.appendChild(option);
  }
  
  //MOSTRAR POR DEFECTO AL CARGAR LA PAGINA LOS RESULTADOS QUE ESTAN SELECCIONADOS EN EL SELECT
  document.addEventListener("DOMContentLoaded", function () {
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2);
  });

  

  //FUNCION PARA EL BOTON QUE PERMITE AL USUARIO VOLVER ARRIBA
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