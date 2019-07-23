<?php
require('src/functions.php');

$fileName = "data.xml";
task1($fileName);

$arr = [
    [
        'name' => 'Mary',
        'firstname' => 'Ivanova',
        'age' => 21
    ],[
        'name' => 'Liza',
        'firstname' => 'Petrova',
        'age' => 20
    ],[
        'name' => 'Kate',
        'firstname' => 'Smit',
        'age' => 22
    ]
];
$fileName = "output.json";
$fileName2 = "output2.json";
task2($arr, $fileName, $fileName2);
task3();
task4();
