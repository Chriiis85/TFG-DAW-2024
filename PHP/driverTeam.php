<?php

// URL de la API
$url = 'https://ergast.com/api/f1/2024/driverStandings.json';

// Obtener los datos JSON de la API
$data = file_get_contents($url);

// Decodificar los datos JSON en un array PHP
$resultado = json_decode($data, true);

// Función para obtener los pilotos de una escudería
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

// Obtener cada escudería con sus dos pilotos
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

