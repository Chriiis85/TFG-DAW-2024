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

?>