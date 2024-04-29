<?php
$year = $_POST['year'];
$url = 'https://ergast.com/api/f1/'.$year.'/driverStandings.json';
$data = file_get_contents($url);
echo $data;
?>