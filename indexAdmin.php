<?php
session_start();
if(!isset($_SESSION["userLogin"]))
{
    header('Location: login.php');
    exit();
}
if( $_SESSION["isAdmin"] === "false")
{
    header('Location: index.php');
    exit();
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Las gatas</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"><!--підключення bootstrap (стилів і тд.)-->
    <link rel="stylesheet" href="/css/style.css">
</head>
<?php include($_SERVER["DOCUMENT_ROOT"]."/connect.php"); ?><!--підключення файлу який конектить нас до бд-->
<body style="padding: 0px;background-color: #343a40;">

<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBarAdmin.php"); ?>
    </div>
    <div class="Mycontent">
        <div class="justify-content-center align-items-center h-100">
            <p class="text-center text-white fw-bold fs-1" style="padding-top: 5rem;"  "> Welcome back <?php
            echo '
                     '. $_SESSION["userLogin"] .'
                     '; ?></p>
        </div>
    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
