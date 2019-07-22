<?php
function task1($arr, $true)
{
    if ($true){
        $str = '';
        foreach($arr as $value){
            $str .= $value;
        }
        return $str;
    }else{
        foreach($arr as $value){
            echo "<p>$value</p>";
        }
    }
}

function task2($operator, $true)
{
    $args = func_get_args();
    switch ($operator){
        case '+':
            $res = 0;
            for($i = 1; $i<count($args); $i++){
                $res += $args[$i];
            }
            break;
        case '*':
            $res = 1;
            for($i = 1; $i<count($args); $i++){
                $res *= $args[$i];
            }
            break;
        default: echo "Ошибка!!!";
    }
    return $res;
}

function task3($a, $b)
{
    if(is_int($a) && is_int($b)){
        echo "<table>";
        echo "<tr>";
        echo "<td><b>&nbsp;</b></td>";
        for ($i = 1; $i<=$a; $i++){
            echo "<td><b>$i</b></td>";
        }
        echo "</tr>";
        for ($j=1; $j<=$b; $j++){
            echo "<tr>";
            echo "<td><b>$j</b></td>";
            for ($i=1; $i<=$a; $i++){
                $res = $j*$i;
                echo "<td>$res</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "Ошибка!!!";
    }
}

function task4(){
    echo date('d.m.Y H:i');
    echo "<br>";
    echo mktime(0,0,0,2,24,2016);
}

function task5($str, $a, $b){
    $res = str_replace ( $a , $b, $str);
    return $res;
}

function task6($name, $text){
    $fp = fopen($name, "w");
    fwrite($fp, $text);
    fclose($fp);
    echo $str = file_get_contents($name);
}