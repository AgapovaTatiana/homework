<?php


function orders(){
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=burgers", 'root', '');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die;
    }
    $orders = $pdo->query("SELECT o.*, u.name, u.email, u.phone FROM orders o, users u WHERE o.userId=u.id");
    foreach ($orders as $order){
        echo "</tr>";
        echo "<td>".$order['id']."</td>";
        echo "<td>".$order['name']."</td>";
        echo "<td>".$order['email']."</td>";
        echo "<td>".$order['phone']."</td>";
        echo "<td>".$order['street']."</td>";
        echo "<td>".$order['home']."</td>";
        echo "<td>".$order['part']."</td>";
        echo "<td>".$order['appt']."</td>";
        echo "<td>".$order['floor']."</td>";
        echo "<td>".$order['comment']."</td>";
        if ($order['payment']==1){$payment="Потребуется сдача";}
        else if ($order['payment']==2){$payment="Оплата по карте";}
        echo "<td>$payment</td>";
        $callback = $order['callback'] ? "да" : "нет";
        echo "<td>$callback</td>";
        echo "</tr>";
    }
}
function users(){
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=burgers", 'root', '');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die;
    }
    $users = $pdo->query("SELECT u.id, u.name, u.email, u.phone FROM users u");
    foreach ($users as $user){
        echo "</tr>";
        echo "<td>".$user['id']."</td>";
        echo "<td>".$user['name']."</td>";
        echo "<td>".$user['email']."</td>";
        echo "<td>".$user['phone']."</td>";
        echo "</tr>";
    }
}

