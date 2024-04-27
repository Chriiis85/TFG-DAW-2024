async function obtenerStandingsDriverYear(year) {
    try {
      const url = `https://ergast.com/api/f1/${year}/driverStandings.json`;
      const response = await fetch(url);
      const data = await response.json();
      return data.MRData.StandingsTable.StandingsLists[0].DriverStandings; // Devuelve la clasificación de pilotos
    } catch (error) {
      console.error("Error al obtener resultados:", error);
      return []; // Devuelve un array vacío en caso de error
    }
  }
  
  async function obtenerStandingsConstructorYear(year) {
    try {
      const url = `https://ergast.com/api/f1/${year}/constructorStandings.json`; // Cambiar a constructorStandings.json
      const response = await fetch(url);
      const data = await response.json();
      return data.MRData.StandingsTable.StandingsLists[0].ConstructorStandings; // Devuelve la clasificación de constructores
    } catch (error) {
      console.error("Error al obtener resultados:", error);
      return []; // Devuelve un array vacío en caso de error
    }
  }
  
  function mostrarResultados(opcionSeleccionada1, opcionSeleccionada2) {
    if (opcionSeleccionada2 == "Constructors") {
      obtenerStandingsConstructorYear(opcionSeleccionada1).then((resultados) => {
        console.log(resultados);
        /* Pintar datos en la tabla */
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
  