<?php
//print_r($_POST);
try {
    $pdo = new PDO("mysql:host=localhost;dbname=burgers", 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}

extract($_POST);
$email = mb_strtolower($email);
$callback = $callback ? 0 : 1;
$phone = preg_replace('/[^0-9]/', '', $phone);

$query = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$query->execute([':email' => $email]);
$user = $query->fetchAll(PDO::FETCH_ASSOC);

if(count($user)){
    $id = $user[0]['id'];
    $query = $pdo->prepare("UPDATE  users SET name=:name, phone=:phone WHERE id = $id");
    $query->execute([':name' => $name,
        'phone' => $phone
    ]);
}else{
    $query = $pdo->prepare("INSERT INTO users (name, email, phone)
       VALUES(?, ?, ?)");
    $query->execute([$name, $email, $phone]);
    //
    $id = $pdo->lastInsertId();
};

$query = $pdo->prepare("INSERT INTO orders (userId, street, home, part, appt, floor, comment, payment, callback)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
$query->execute([$id, $street, $home, $part, $appt, $floor, $comment, $payment, $callback]);
$orderId = $pdo->lastInsertId();

$text = "<h1>Заказ №$orderId</h1>";
$text .= "<p>Ваш заказ будет доставлен по адресу: улица $street, дом $home корпус $part, квартира $appt, этаж $floor.</p>";
$text .= "<h2>Содержимое заказа</h2>";
$text .= "<p>DarkBeefBurger за 500 рублей, 1 шт.</p>";

$query = $pdo->prepare("SELECT id FROM orders WHERE userId = ?");
$query->execute([$id]);
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$count = count($orders);
if($count == 1){
    $text .= "Спасибо - это ваш первый заказ!";
}else{
    $text .= "Спасибо! Это уже $count заказ!";
}

$fp = fopen("../mails/$orderId.html", "w");
fwrite($fp, $text);
fclose($fp);

header("Location: ../");
//Содержимое заказа всегда одинаковое - DarkBeefBurger за 500 рублей, 1 шт, нигде в базе не хранится,
// только высылается в письме. Внизу, под заказом идет дополнительная строка - “Спасибо - это ваш первый заказ” или “Спасибо!
// Это уже 555 заказ”, где 555 - это кол-во разов, сколько пользователь заказал. Письмо высылается функцией mail или записывается с помощью
// функции file_put_contents в отдельную папку с временем отправки.

