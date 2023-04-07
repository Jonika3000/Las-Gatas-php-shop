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
if(isset($_POST['product'])) {
    $productName = $_POST['productN'];
    $stmt = $dbh->prepare('SELECT id FROM products WHERE name = :name');
    $stmt->execute(array(':name' => $productName));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($productName != "Select a product") {
        header("Location: editProduct.php?id={$row['id']}");

    }

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
            <h1>Edit Products</h1>
            <form method="POST"  >
                <div class="form-group">
                    <select class="form-control" id="select" name="productN"  name="select" >
                        <option value="">Select a product</option>
                        <?php
                        $stmt = $dbh->query('SELECT * FROM products');
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit"   name="product" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
