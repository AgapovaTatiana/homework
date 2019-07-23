<?php
function task1($fileName)
{
    $fileData = file_get_contents($fileName);
    $xml = new SimpleXMLElement($fileData); // create xml-element from string
    echo "<table>";
    echo "<tr><td><b>Name</b></td><td><b>Street</b></td><td><b>City</b></td><td><b>State</b></td><td><b>Zip</b></td><td><b>Country</b></td></tr>";
    foreach ($xml->Address as $address) {
        echo "<tr><td>".$address->Name."</td>";
        echo "<td>".$address->Street."</td>";
        echo "<td>".$address->City."</td>";
        echo "<td>".$address->State."</td>";
        echo "<td>".$address->Zip."</td>";
        echo "<td>".$address->Country."</td></tr>";
    }
    echo "</table>";
    echo "<br><br>";
    echo $xml->DeliveryNotes;
    echo "<table>";
    echo "<tr><td><b>PartNumber</b></td><td><b>ProductName</b></td><td><b>Quantity</b></td><td><b>USPrice</b></td><td><b>Comment</b></td><td><b>ShipDate</b></td></tr>";
    foreach ($xml->Items->Item as $item) {
        echo "<tr><td>".$item->attributes()->PartNumber."</td>";
        echo "<td>".$item->ProductName."</td>";
        echo "<td>".$item->Quantity."</td>";
        echo "<td>".$item->USPrice."</td>";
        echo "<td>".$item->Comment."</td>";
        echo "<td>".$item->ShipDate."</td></tr>";
    }
    echo "</table>";
}

function task2($arr, $fileName, $fileName2)
{
    $text = json_encode($arr);
    $fp = fopen($fileName, "w");
    fwrite($fp, $text);
    fclose($fp);
    $fp1 = fopen($fileName2, "w");
    if (rand(0, 1)){
        for ($i = 0; $i < count($arr); $i++){
            $arr[$i]['age'] += 2;
        }
    }
    $text = json_encode($arr);
    fwrite($fp1, $text);
    fclose($fp1);
    $str1 = file_get_contents($fileName);
    $arr1 = json_decode($str1);
    $str2 = file_get_contents($fileName2);
    $arr2 = json_decode($str2);
    $count = count($arr1) > count($arr2) ? count($arr1) : count($arr2);
    $ind = 0;
    for ($i = 0; $i < $count; $i++){
        if(($arr1[$i] -> name) != ($arr2[$i] -> name)){
            echo "Значение " . $arr1[$i]->name . " не совпадает с " . $arr2[$i] -> name."<br>";
            $ind = 1;
        }
        if(($arr1[$i] -> firstname) != ($arr2[$i] -> firstname)) {
            echo "Значение " . $arr1[$i] ->firstname. " не совпадает с " . $arr2[$i] ->firstname . "<br>";
            $ind = 1;
        }
        if(($arr1[$i] -> age) != ($arr2[$i] -> age)){
            echo "Значение " . $arr1[$i] -> age . " не совпадает с " . $arr2[$i] -> age ."<br>";
            $ind = 1;
        }
    }
    if ($ind == 0){
        echo "Изменений нет.<br>";
    }
}

function task3(){
    $arr = [];
    for ($i = 0; $i < 100; $i++){
        $arr[] =  rand(1, 100);
    }
    $fp = fopen('file.csv', "w");
    if (!$fp) { die('cant open file'); }
    fputcsv($fp, $arr, ';');
    $fp = fopen('file.csv', 'r');
    if (!$fp) { die('cant open file'); }
    $ret = [];
    while ($str = fgetcsv($fp, 1000*1024, ';')) {
        $ret[] = $str;
    }
    $ret = $ret[0];
    $count = count($ret);
    $res = 0;
    for ($i = 0; $i<=$count; $i++){
        if($ret[$i]%2 == 0){
            $res += $ret[$i];
        }
    }
    echo $res;
    echo "<br>";
}

function task4(){
    $fileData = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    $arr = json_decode($fileData);
    //print_r($arr);
    $num = '15580374';
    $obj = $arr -> query -> pages -> $num;
    echo $obj -> pageid;
    echo "<br>";
    echo $obj -> title;
}
//С помощью PHP запросить данные по этому адресу Вывести title и pageid