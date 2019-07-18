<?php
header('Content-Type: text/html; charset=utf-8');

$bmw = array(
    'model' => "X5",
    'speed' => 120,
    'doors' => 5,
    'year' => "2015"
);
$toyota = array(
    'model' => "Camry",
    'speed' => 130,
    'doors' => 4,
    'year' => "2018"
);
$opel = array(
    'model' => "Insignia",
    'speed' => 120,
    'doors' => 4,
    'year' => "2015"
);
$cars = array(
    'bmw' => $bmw,
    'toyota' => $toyota,
    'opel' => $opel,
);

foreach ($cars as $name => $property){
    echo "CAR $name<br>";
    $i = 0;
    $max = sizeof($property);
    foreach ($property as $value){
        echo $value;
        if ($i < $max - 1){echo " — ";}
        $i++;
    }
    echo "<br>";
}
/*
Объедините три массива в один многомерный массив.
Выведите значения всех трех массивов в виде:
CAR name
name ­ model ­speed ­ doors ­ year
Например:
CAR bmw
X5 ­120 ­ 5 ­ 2015
*/