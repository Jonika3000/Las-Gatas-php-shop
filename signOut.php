<?php
session_start();
unset($_SESSION["userLogin"]);
unset($_SESSION["idUser"]);
unset($_SESSION["isAdmin"]);
header("Location:login.php");
?>