<?php
$user="root";
$pass="";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try{
    $dbh = new PDO("mysql:host=localhost;dbname=newData",$user,$pass);
}
catch (Exception $ex){
    print "Error".$ex->getMessage()."</br>";
    exit();
}

