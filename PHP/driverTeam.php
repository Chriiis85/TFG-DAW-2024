<?php

// URL DE LA API PARA RECOGER LOS PILOTOS
$url = 'https://ergast.com/api/f1/2024/driverStandings.json';

// OBTENER LOS DATOS EN FORMATO JSON
$data = file_get_contents($url);

// DECODIFICAR DATOS EN JSON PARA LEERLO Y PINTARLO MEJOR
$resultado = json_decode($data, true);

// FUNCION QUE SE LE PASA EL ARRAY Y LA ESCUDERIA Y OBTIENE LOS DOS PILOTOS
function damePilotos($escuderia, $resultado) {
    $pilotos = [];
    foreach ($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as $item) {
        $constructores = $item['Constructors'];
        foreach ($constructores as $constructor) {
            if ($constructor['name'] === $escuderia) {
                $pilotos[] = $item['Driver']['givenName'] . ' ' . $item['Driver']['familyName'];
            }
        }
    }
    return $pilotos;
}

// BUCLE QUE OBTIENE LAS ESCUDERIAS Y SUS PILOTOS Y SE JUNTA EN UN ARRAY PARA PODER SER PINTADO
$escuderias = [];
foreach ($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as $item) {
    $constructores = $item['Constructors'];
    foreach ($constructores as $constructor) {
        $escuderia = $constructor['name'];
        if (!array_key_exists($escuderia, $escuderias)) {
            $escuderias[$escuderia] = damePilotos($escuderia, $resultado);
        }
    }
}

function calcularEdad($fechaNacimiento)
{
  // Convertir la fecha de nacimiento a un objeto DateTime
  $fechaNacimiento = new DateTime($fechaNacimiento);

  // Obtener la fecha actual
  $fechaActual = new DateTime();

  // Calcular la diferencia entre la fecha actual y la fecha de nacimiento
  $diferencia = $fechaActual->diff($fechaNacimiento);

  // Obtener la diferencia en años
  $edad = $diferencia->y;

  return $edad;
}

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
