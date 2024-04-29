async function obtenerStandingsDriverYear(year) {
  return new Promise((resolve, reject) => {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              let result = JSON.parse(this.responseText);
              let data = result.MRData.StandingsTable.StandingsLists[0].DriverStandings;
              resolve(data); // Resuelve la promesa con los datos obtenidos
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
              resolve(data); // Resuelve la promesa con los datos obtenidos
          }
      };
      xhttp.open("POST", "PHP/getDataConstructors.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("year=" + year);
  });
}

function mostrarResultados(opcionSeleccionada1, opcionSeleccionada2) {
  if (opcionSeleccionada2 == "Constructors") {
    obtenerStandingsConstructorYear(opcionSeleccionada1).then((resultados) => {
      console.log(resultados);
      let tablaTBody = document.getElementById("tabla-tbody");
      tablaTBody.innerHTML = "";
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
    obtenerStandingsDriverYear(opcionSeleccionada1).then((resultados) => {
      //console.log(resultados);

      /* Pintar datos en la tabla */
      let tablaTBody = document.getElementById("tabla-tbody");
      tablaTBody.innerHTML = "";
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
  }
}

//Select manejo de la estructura
let select1 = document.getElementById("select1");
  let select2 = document.getElementById("select2");
  
  select2.addEventListener("change", function () {
    // Obtener el valor seleccionado
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2);
  });
  
  select1.addEventListener("change", function () {
    // Obtener el valor seleccionado
    const opcionSeleccionada1 = select1.value;
    const opcionSeleccionada2 = select2.value;
    mostrarResultados(opcionSeleccionada1, opcionSeleccionada2);
  });
  
  for (let i = 2024; i > 1980; i--) {
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
