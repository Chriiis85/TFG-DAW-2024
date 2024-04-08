async function getActualDrivers() {
    fetch('https://ergast.com/api/f1/2024/driverStandings.json')
    .then(response => response.json())
    .then(data => {
      const driverStandings = data.MRData.StandingsTable.StandingsLists[0].DriverStandings;
      console.log(driverStandings[0]);
      // Aquí puedes trabajar con la lista de clasificación de pilotos según sea necesario
      
    })
    .catch(error => {
      console.error('Hubo un problema con la solicitud fetch:', error);
    });
}

getActualDrivers();
