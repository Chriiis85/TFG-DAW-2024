<?php
// URL de la API
$url = 'https://ergast.com/api/f1/2024/constructorStandings.json';

// Obtener los datos JSON de la API
$data = file_get_contents($url);

// Decodificar los datos JSON en un array PHP
$resultado = json_decode($data, true);

// Verificar si se obtuvo una respuesta válida
if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'])) {
    // Obtener la lista de clasificaciones de equipos
    $clasificacionesEquipos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'];
} else {
    echo "No se pudo obtener la información de la API.";
}

?>