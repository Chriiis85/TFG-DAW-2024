<?php
// URL DE LA API CON LOS EQUIPOS EN ORDEN DE MUNDIAL
$url = 'https://ergast.com/api/f1/2024/constructorStandings.json';

// OBTENER LOS DATOS EN FORMATO JSON
$data = file_get_contents($url);

// DECODIFICAR DATOS EN JSON PARA LEERLO Y PINTARLO MEJOR
$resultado = json_decode($data, true);

// VERIFICAR SI SE OBTIENE ALGO DE LA API PARA PODER DEBUGEAR Y MOSTRAR ERRORES
if ($resultado && isset($resultado['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'])) {
    //ARRAY QUE NOS PERMITE PINTAR LOS EQUIPOS EN EL APARTADO DE ESCUDERIAS
    $clasificacionesEquipos = $resultado['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'];
} else {
    //SALIDA EN EL CASO DE QUE SE DE UN ERROR
    echo "No se pudo mostrar la información de la API.";
}

?>