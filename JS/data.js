let select1 = document.getElementById("select1");
let select2 = document.getElementById("select2");
let select3 = document.getElementById("select3");

async function obtenerStandingsDriverYear(year) {
  return new Promise((resolve, reject) => {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let result = JSON.parse(this.responseText);
              let data = result.MRData.StandingsTable.StandingsLists[0].DriverStandings;
              resolve(data);
          }
      };
      xhttp.open("POST", "PHP/getDataDrivers.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year);
  });
}

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

function mostrarResultados(opcionSeleccionada1, opcionSeleccionada2, opcionSeleccionada3) {
  if (opcionSeleccionada2 == "Constructors") {
    select3.style.display="none";
    obtenerStandingsConstructorYear(opcionSeleccionada1).then((resultados) => {
      //console.log(resultados);
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
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 + " Constructors Standings";
    });
  } else if (opcionSeleccionada2 == "Drivers") {
    select3.style.display="none";
    obtenerStandingsDriverYear(opcionSeleccionada1).then((resultados) => {
      //console.log(resultados);

      /* Pintar datos en la tabla */
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
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 + " Driver Standings";
    });
  }else if (opcionSeleccionada2 == "Race") {
    select3.style.display="block";
    obtenerRacesResult(opcionSeleccionada1, opcionSeleccionada3).then((resultados) => {
      //console.log(resultados)
      //console.log(opcionSeleccionada1)

      /* Pintar datos en la tabla */
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
      let titulo = document.getElementById("title");
      titulo.textContent = opcionSeleccionada1 +" "+ select3.options[select3.selectedIndex].textContent +" Results";
    });
  }
}

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

//Select manejo de la estructura
 
  select2.addEventListener("change", function () {
    // Obtener el valor seleccionado
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
    obtenerCarreras(opcionSeleccionada1);
  });
  
  select1.addEventListener("change", function () {
    // Obtener el valor seleccionado
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
    obtenerCarreras(opcionSeleccionada1);
  });

  select3.addEventListener("change", function () {
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    const opcionSeleccionada3 = select3.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2,opcionSeleccionada3);
  });
  
  //Rellenar los años disponibles  for (let i = 2024; i > 1949; i--) {
  for (let i = 2024; i > 1979; i--) {
    let option = document.createElement("option");
    option.value = i; // Aquí corregimos el error
    option.textContent = i; // Establecemos el texto de la opción como el año
    select1.appendChild(option);
  }
  
  // Mostrar los resultados por defecto al cargar la página
  document.addEventListener("DOMContentLoaded", function () {
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2);
  });
