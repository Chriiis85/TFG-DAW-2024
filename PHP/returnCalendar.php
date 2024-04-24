<?php
//URL de la API
$url = 'https://ergast.com/api/f1/current.json';
// Iniciar la sesión cURL
$curl = curl_init();


// Configurar las opciones de cURL
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

// Realizar la solicitud
$response = curl_exec($curl);


// Cerrar la sesión cURL
curl_close($curl);

// Decodificar la respuesta JSON
$data = json_decode($response, true);
//print_r($data['MRData']['RaceTable']['Races'][23]['Circuit']['Location']['country']);

function dameMes($digitoMes) {
    switch ($digitoMes) {
        case '01':
            return "JAN";
            break;
        case '02':
            return "FEB";
            break;
        case '03':
            return "MAR";
            break;
        case '04':
            return "APR";
            break;
        case '05':
            return "MAY";
            break;
        case '06':
            return "JUN";
            break;
        case '07':
            return "JUL";
            break;
        case '08':
            return "AUG";
            break;
        case '09':
            return "SEP";
            break;
        case '10':
            return "OCT";
            break;
        case '11':
            return "NOV";
            break;
        case '12':
            return "DEC";
            break;
    }
}


?>
