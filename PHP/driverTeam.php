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
