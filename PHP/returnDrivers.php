<?php
//URL DE LA API PARA RECOGER LA CLASIFIACION DE LOS PILOTOS
$url = 'https://ergast.com/api/f1/2024/driverStandings.json';

//OBTENER EN UN ARRAY LOS DATOS DE LA API
$data = file_get_contents($url);

// DECODIFICAR LOS DATOS EN JSON PARA PINTARLOS EN LA PAGINA
$resultado = json_decode($data, true);

// VERIFICAR SI SE OBTIENE UNA RESPUESTA
if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'])) {
    // OBTENER EN UN ARRAY EL RESULTADO QUE TENEMOS
    $clasificacionesPilotos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'];
    
} else {
    //SALIDA EN CASO DE ERROR
    echo "No se pudo obtener la información de la API.";
}

/*FUNCION QUE NOS DEVUELVE EL PAIS DE SU GENTILICIO PARA PODER COGER LA BANDERA DE LA API*/
function nacionalidadAPais($nacionalidad)
{
  switch ($nacionalidad) {
    case 'Dutch':
      return 'Netherlands';
      break;
    case 'Mexican':
      return 'Mexico';
      break;
    case 'Monegasque':
      return 'Monaco';
      break;
    case 'Spanish':
      return 'Spain';
      break;
    case 'British':
      return 'Great-Britain';
      break;
    case 'Australian':
      return 'Australia';
      break;
    case 'Canadian':
      return 'Canada';
      break;
    case 'Japanese':
      return 'Japan';
      break;
    case 'German':
      return 'Germany';
      break;
    case 'Danish':
      return 'Denmark';
      break;
    case 'Chinese':
      return 'China';
      break;
    case 'French':
      return 'France';
      break;
    case 'Finnish':
      return 'Finland';
      break;
    case 'American':
      return 'United%20States';
      break;
    case 'Thai':
      return 'Thailand';
      break;
    case 'Italian':
      return 'Italy';
      break;
    case 'Austrian':
      return 'Austria';
      break;
    case 'Swiss':
      return 'Switzerland';
      break;
  }
}
?>