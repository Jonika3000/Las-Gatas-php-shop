<?php
session_start();
if(!$_SESSION["userLogin"])
{
    header('Location: login.php');
    exit();
}
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
$idProduct=$_GET["id"];
if($_SERVER["REQUEST_METHOD"]=="GET") {
    $sql = "SELECT * FROM products WHERE id =:id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':id' => $idProduct));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $nameP = $result['name'];
    $priceP = $result['price'];
    $descriptionP = $result['description'];
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
<?php include($_SERVER["DOCUMENT_ROOT"]."/connect.php"); ?><!--підключення файлу який конектить нас до бд-->
<body style="padding: 0px;background-color: #343a40;">

<div class="Mycontainer">
    <div class="sidebar">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/sideBar.php"); ?>
    </div>
    <div class="Mycontent" style="padding-top: 2rem;">
        <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
        <div class="container-fluid mt-2 mb-3">
            <div class="row no-gutters">
                <div class="col-md-5 pr-2">
                    <?php
                    $sql = "SELECT urlImage
                        FROM imagesproduct 
                        WHERE imagesproduct.idProduct = ".$idProduct."";
                    $ImagesProduct = $dbh->query($sql);
                    ?>
                    <div class="card" style="background-color: #212529;height: 425px;width: 100%;">
                        <div class="demo" style="height: 100%;width: 100%;">
                            <ul id="lightSlider" style="height: 100%;width: 100%;">
                                <?php foreach ($ImagesProduct as $row) : ?>
                                <?php $imgUrl = $row["urlImage"]; ?>
                                 <li data-thumb="/Images/<?php echo $imgUrl; ?>" style="height: 320px;width: 320px;">
                                    <img src="/Images/<?php echo $imgUrl; ?>" style="object-fit:contain;height: 100%;width: 100%;" />
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="card" style="background-color: #212529;color: white; ">
                        <div class="about">
                            <span class="font-weight-bold"><?php echo $nameP; ?></span>
                            <h4 class="font-weight-bold"><?php echo $priceP; ?> $</h4>
                        </div>
                        <div class="buttons"> <button class="btn btn-outline-warning btn-long cart">Add to Cart</button>
                            <button class="btn btn-warning btn-long buy">Buy it Now</button>

                        <hr>
                        <div class="product-description">
                            <div class="d-flex flex-row align-items-center">
                                <i class="fa fa-calendar-check-o"></i>
                                <span class="ml-1"> Delivery from Spain, 15-45 days</span>
                            </div>
                            <div class="mt-2">
                                <span class="font-weight-bold">Description</span>
                                <p>
                                    <?php echo $descriptionP; ?>
                                </p>
                            </div>


                        </div>
                    </div>

                </div>
            </div> </div> <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
        <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
        <script> $('#lightSlider').lightSlider({ gallery: true, item: 1, loop: true, slideMargin: 0, thumbItem: 9 });
        </script>
</div>
<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
