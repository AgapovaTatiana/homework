<link href="style.css" rel="stylesheet">
<?php
echo "<table>";
echo "<tr>";
echo "<td><b>&nbsp;</b></td>";
for ($i = 1; $i<=10; $i++){
    echo "<td><b>$i</b></td>";
}
echo "</tr>";
for ($j=1; $j<=10; $j++){
    echo "<tr>";
    echo "<td><b>$j</b></td>";
    for ($i=1; $i<=10; $i++){
        $res = $j*$i;
        if (($j%2 == 0) && ($i%2 == 0)){$res = "($res)";}
        if (($j%2 == 1) && ($i%2 == 1)){$res = "[$res]";}
        echo "<td>$res</td>";
    }
    echo "</tr>";
}
echo "</table>";
/*Задание #6

Используя цикл for, выведите таблицу умножения размером 10x10. Таблица должна быть выведена с помощью HTML тега <table>.
Если значение индекса строки и столбца чётный, то результат вывести в круглых скобках.
Если значение индекса строки и столбца Нечётный, то результат вывести в квадратных скобках.
Во всех остальных случаях результат выводить просто числом.*/