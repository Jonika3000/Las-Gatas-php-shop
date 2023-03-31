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
if(isset($_POST['DeleteBtn'])) {
    $id = $_POST['idImage'];
    $sql1 = "DELETE FROM imagesproduct WHERE `imagesproduct`.`id` = '$id'";
    $dbh->exec($sql1);
}
?>

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
<body style="padding: 0px;background-color: #343a40;">

<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBarAdmin.php"); ?>
    </div>
    <div class="Mycontent" style="color: white">
        <div class="container">
            <h1 style="color: white">Delete Product Image</h1>
            <form method="post" >
                <div class="form-group">
                    <label for="idProduct" style="color: white">Image:</label>
                    <select class="form-control" name="idImage">
                        <option value="">Select a image</option>
                        <?php
                        $stmt = $dbh->query("SELECT * FROM imagesproduct");
                        while ($row = $stmt->fetch()) {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['urlImage'] . "\" id product ->" . $row['idProduct']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="DeleteBtn" class="btn btn-primary" style="margin-top: 15px;">Delete</button>
            </form>
        </div>

    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
