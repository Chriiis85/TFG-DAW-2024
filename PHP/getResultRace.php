<?php
$year = $_POST['year'];
$round = $_POST['round'];
//$year = 2024;
//$round = 1;
$url = 'https://ergast.com/api/f1/'.$year.'/'.$round.'/results.json';
$data = file_get_contents($url);
echo $data;
?>