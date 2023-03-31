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
        $stmt = $dbh->prepare("INSERT INTO products (name, price, description, idCategory) VALUES (:name, :price, :description, :idCategory)");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':price', $_POST['price']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':idCategory', $_POST['idCategory']);
        $stmt->execute();

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
            <h1 style="color: white">Add Product</h1>
            <form method="post" >
                <div class="form-group">
                    <label for="name" style="color: white">Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="price" style="color: white">Price:</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <div class="form-group">
                    <label for="description" style="color: white">Description:</label>
                    <textarea class="form-control" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="idCategory" style="color: white">Category:</label>
                    <select class="form-control" name="idCategory">
                        <option value="">Select a category</option>
                        <?php
                        $stmt = $dbh->query("SELECT * FROM tbl_categories");
                        while ($row = $stmt->fetch()) {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="AddBtn" class="btn btn-primary" style="margin-top: 15px;">Add Product</button>
            </form>
        </div>

    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
