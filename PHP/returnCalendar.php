<?php
//URL PARA RECOGER LA API CON LAS CARRERAS DEL CALENDARIO DEL AÑO ACTUAL
$url = 'https://ergast.com/api/f1/current.json';
//INICIALIZAR CURL PARA CONECTAR LA API Y LAS OPCIONES DE COMO DEVOLVER LOS DATOS Y DE QUE URL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

//GUARDAMOS LA RESPUESTA AL EJECUTAR LA CONSULTA A LA API
$response = curl_exec($curl);

//DECODIFICAR LA RESPUESTA EN JSON PARA TRATARLA
$data = json_decode($response, true);

//FUNCION QUE PASA EL MES A SU ABREVIATURA EX:SEPTIEMBRE SEP
function dameMes($digitoMes)
{
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

//FUNCION QUE PARSEA EL FORMATO DE LA HORA PARA MOSTRAR HH:MM
function formatHora($hora)
{
    $parseado = strtotime($hora);
    $hora_parseada = date("H:i", $parseado);
    return $hora_parseada;
}

//FUNCION QUE SUMA UNA HORA A LA SESION PARA ESTABLECER EL FINAL
function sumarUnaHora($hora)
{
    $hora_dt = DateTime::createFromFormat('H:i:s\Z', $hora);
    if ($hora_dt === false) {
        return "Formato de hora no válido";
    }
    $hora_dt->modify('+1 hour');
    return $hora_dt->format('H:i');
}

//FUNCION QUE SUMA DOS HORAS A LA HORA DE LA CARRERA PARA ESTABLECER EL FINAL
function sumarDosHora($hora)
{
    $hora_dt = DateTime::createFromFormat('H:i:s\Z', $hora);
    if ($hora_dt === false) {
        return "Formato de hora no válido";
    }
    $hora_dt->modify('0 hour');
    return $hora_dt->format('H:i');
}

//CERRAR LA CONEXION A LA API
curl_close($curl);

?>