<?php
header('Content-Type: text/html; charset=utf-8');

$bmw = [
    'model' => "X5",
    'speed' => 120,
    'doors' => 5,
    'year' => "2015"
];
$toyota = [
    'model' => "Camry",
    'speed' => 130,
    'doors' => 4,
    'year' => "2018"
];
$opel = [
    'model' => "Insignia",
    'speed' => 120,
    'doors' => 4,
    'year' => "2015"
];
$cars = [
    'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel,
];

foreach ($cars as $name => $property){
    echo "CAR $name<br>";
    $i = 0;
    echo $property['model'].' — '.$property['speed'].' — '.$property['doors'].' — '.$property['year'].'<br>';
}