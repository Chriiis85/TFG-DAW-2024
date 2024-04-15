<?php
// URL de la API
$url = 'https://ergast.com/api/f1/2024/driverStandings.json';

// Obtener los datos JSON de la API
$data = file_get_contents($url);

// Decodificar los datos JSON en un array PHP
$resultado = json_decode($data, true);

// Verificar si se obtuvo una respuesta válida
if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'])) {
    // Obtener la lista de clasificaciones de pilotos
    $clasificacionesPilotos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'];
    
    // Iterar sobre las clasificaciones de pilotos y mostrar la posición, el nombre del piloto y los puntos
    /*foreach ($clasificacionesPilotos as $clasificacion) {
        echo "Posición: " . $clasificacion['position'] . "<br>";
        echo "Nombre del piloto: " . $clasificacion['Driver']['givenName'] . " " . $clasificacion['Driver']['familyName'] . "<br>";
        echo "Puntos: " . $clasificacion['points'] . "<br><br>";
    }*/

    print_r ($clasificacionesPilotos[0]['Driver']['dateOfBirth']);
} else {
    echo "No se pudo obtener la información de la API.";
}
?>
