<?php
session_start();
if(!$_SESSION["userLogin"])
{
    header('Location: login.php');
    exit();
}
if( $_SESSION["isAdmin"] === "false")
{
    header('Location: index.php');
    exit();
}
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");


if (isset($_POST['AddBtn'])) {
    $target_dir = "Images/";
    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
    $tmpNameFile = uniqid() . "." . $imageFileType;
    $target_file = $target_dir . $tmpNameFile;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $stmt = $dbh->prepare("INSERT INTO `tbl_categories` (`name`, `image`) VALUES (:name,:img);");
        $stmt->bindParam(':img', $tmpNameFile);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->execute();
    }
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
<body style="padding: 0px;background-color: #343a40;">

<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBarAdmin.php"); ?>
    </div>
    <div class="Mycontent" style="color: white">
        <div class="container">
            <h1 style="color: white">Add Category</h1>
            <form  method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="name" style="color: white">Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-2">
                    <label for="fileToUpload" class="form-label">Image:</label>
                    <input  class="form-control" type="file" name="fileToUpload" id="fileToUpload" style="width: 300px;">
                </div>
                <button type="submit" name="AddBtn" class="btn btn-primary" style="margin-top: 15px;">Add Category</button>
            </form>
        </div>

    </div>
</div>

<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
