<?php
$year = $_POST['year'];
$url = 'https://ergast.com/api/f1/'.$year.'.json';
$data = file_get_contents($url);
echo $data;
?>