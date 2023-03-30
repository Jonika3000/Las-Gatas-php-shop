<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
session_start();
$idCategory=$_GET["id"];
if($_SERVER["REQUEST_METHOD"]=="GET") {

    $name = "";
    $image = "";
    $idProduct="";
    $sql = "SELECT * FROM products where idCategory=".$idCategory;
    $commandSQL = $dbh->query($sql);
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
    <link rel="stylesheet" href="/css/style.css"><!--підключення наших стилів-->
    <link rel="stylesheet" href="/css/font-awesome.css">
</head>
<body style="padding: 0px;background-color: #343a40;">
<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBar.php"); ?>
    </div>
    <div class="Mycontent"  >
        <div class="row">
            <?php foreach ($commandSQL as $row) : ?>
                <div class="col-sm-6 col-md-4 col-lg-3" style="max-width:280px;">
                    <div class="container d-flex justify-content-center mt-5">
                        <?php
                        $idProduct = $row["id"];
                        $sql = "SELECT urlImage
                        FROM imagesproduct 
                        WHERE imagesproduct.idProduct = :id";
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindValue(':id', $idProduct);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $image = $result['urlImage'];
                        $name = $row["name"];
                        $price = $row["price"];
                        $description = $row["description"];
                        ?>
                        <div class="product-wrapper mb-45 text-center">
                        <div class="product-img">
                            <a href="<?php echo "product.php/?id=".$idProduct; ?>"" data-abc="true">
                                <img src="<?php echo $image; ?>" style="max-width:100%;height: 250px; object-fit: cover" alt="#">
                            </a>
                            <span class="text-center" style="background-color: #212529;color: white">
                      <?php echo $price; ?>$
          </span>
                        </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
