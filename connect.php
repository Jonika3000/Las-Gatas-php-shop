<?php
$user="root";//створюємо змінну з назвою користувача
$pass="";//створюємо змінну з паролем
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try{//пробуємо законектитись до бази даних
    $dbh = new PDO("mysql:host=localhost;dbname=newData",$user,$pass);//оголошуємо конструктор який приймає параметри налаштування підключення
}
catch (Exception $ex){//ловимо можливу помилку
    print "Error".$ex->getMessage()."</br>";//виводимо помлку жирним шрифтом
    exit();//припиняємо виконання скрипта
}

