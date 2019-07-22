<?php
header('Content-Type: text/html; charset=utf-8');
require('src/functions.php');
echo '<link href="style.css" rel="stylesheet">';

$arr = ['альфа', 'бета', 'гамма'];
task1($arr, true);
task1($arr, false);
echo task2('+', 1, 2, 3, 4, 5);
echo "<br>";
echo task2('*', 1, 2, 3, 4, 5);
task3(15, 17);
task4();
echo "<br>";
echo task5("Карл у Клары украл Кораллы", 'К', '');
echo "<br>";
echo task5("Две бутылки лимонада", "Две", "Три");
echo "<br>";
task6("test.txt", "Hello again!");