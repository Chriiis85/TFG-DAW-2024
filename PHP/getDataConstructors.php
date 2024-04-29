<?php
$year = $_POST['year'];
$url = 'https://ergast.com/api/f1/'.$year.'/constructorStandings.json';
$data = file_get_contents($url);
echo $data;
?>