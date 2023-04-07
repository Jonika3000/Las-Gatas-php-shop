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
    $id = $_POST['idProduct'];
    $sql2 = "SELECT urlImage
                        FROM imagesproduct 
                        WHERE `imagesproduct`.`idProduct` = '$id'";
    $ImagesProduct = $dbh->query($sql2)->fetch();
    unlink("Images/".$ImagesProduct['urlImage']);
    $sql1 = "DELETE FROM imagesproduct WHERE `imagesproduct`.`idProduct` = '$id'";
    $sql = "DELETE FROM products WHERE `products`.`id` = '$id'";
    $dbh->exec($sql1);
    $dbh->exec($sql);
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
            <h1 style="color: white">Delete Product</h1>
            <form method="post" >
                <div class="form-group">
                    <label for="idCategory" style="color: white">Product:</label>
                    <select class="form-control" name="idProduct">
                        <option value="">Select a product</option>
                        <?php
                        $stmt = $dbh->query("SELECT * FROM products");
                        while ($row = $stmt->fetch()) {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
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
