<?php
session_start();
if(!$_SESSION["userLogin"])
{
    header('Location: login.php');
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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<?php include($_SERVER["DOCUMENT_ROOT"]."/connect.php"); ?>
<body style="padding: 0px;background-color: #343a40;">

        <div class="Mycontainer">
            <div class="sidebar">
                <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBar.php"); ?>
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
