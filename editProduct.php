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
$idProduct=$_GET["id"];
$sql= ('SELECT name, price, description FROM products WHERE id = :name');
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':name' => $idProduct));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {

}
if(isset($_POST['EditBtn'])) {
    $stmt = $dbh->prepare("UPDATE products SET name = :nameP, price = :priceP, description = :descriptionP WHERE id = :idP");
    $stmt->bindParam(':nameP', $_POST['nameI']);
    $stmt->bindParam(':priceP', $_POST['priceI']);
    $stmt->bindParam(':descriptionP', $_POST['desI']);
    $stmt->bindParam(':idP', $idProduct);
    $stmt->execute();

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('nameI').value = <?php echo json_encode($row['name']); ?>;
        document.getElementById('imageI').value = <?php echo json_encode($row['price']); ?>;
        document.getElementById('desI').value = <?php echo json_encode($row['description']); ?>;
    });
</script>

<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBarAdmin.php"); ?>
    </div>
    <div class="Mycontent" style="color: white">
        <div class="container">
            <h1 style="color: white">Edit product</h1>

            <form method="POST">
                <div class="form-group">
                    <label for="name" style="color: white">Name:</label>
                    <input type="text" class="form-control" name="nameI"  id="nameI">
                </div>
                <div class="form-group">
                    <label for="name" style="color: white">Price:</label>
                    <input type="text" class="form-control" name="priceI"  id="imageI">
                </div>
                <div class="form-group">
                    <label for="name" style="color: white">Description:</label>
                    <textarea type="text" class="form-control" name="desI"  id="desI"></textarea>
                </div>
                <button type="submit" name="EditBtn" class="btn btn-primary" style="margin-top: 15px;">Edit product</button>
            </form>
        </div>


    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>