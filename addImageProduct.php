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

    $images = $_POST["images"];
    foreach ($images as $base64) {
        list(, $content) = explode(',', $base64);
        $bytes = base64_decode($content);
        $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/Images/";
        $fileName = uniqid() . ".png";
        $fileSave = $target_dir . $fileName;
        file_put_contents($fileSave, $bytes);
        $stmt = $dbh->prepare("INSERT INTO `imagesproduct` (`urlImage`, `idProduct`) VALUES (:img, :idProduct);");
        $stmt->bindParam(':img', $fileName);
        $stmt->bindParam(':idProduct', $_POST['idProduct']);
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
            <h1 style="color: white">Add Product Image</h1>
            <form method="post" >
                <div class="form-group">
                    <div class="mb-3">
                        <div class="row" id="listImages">
                        </div>
                        <div class="col-md-2">
                            <label for="image" class="form-label">
                                <img src="/Images/upload.png"
                                     style="cursor: pointer"
                                     alt="фото категорії"
                                     id="selectImage"
                                     width="50"
                                     height="50"
                                >
                            </label>
                            <input type="file"
                                   class="d-none"
                                   id="image">
                        </div>
                        <div class="invalid-feedback">
                            Вкажіть шлях до фото товару
                        </div>
                    </div>
                </div>
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
                <button type="submit" name="AddBtn" class="btn btn-primary" style="margin-top: 15px;">Add Image</button>
            </form>
        </div>

    </div>
</div>
<script>
    window.addEventListener("load", (event) => {
        const image = document.getElementById("image");
        image.onchange = (e) => {
            const file = e.target.files[0];
            const fr = new FileReader();
            fr.addEventListener("load", () => {
                const base64 = fr.result;
                const data = `
<div class="col-md-2">
    <img src="${base64}"
         style="cursor: pointer"
         alt="product image"
         width="100%">
    <input type="hidden"
           class="d-none"
           value="${base64}"
           name="images[]">
</div>`;

                document.getElementById("listImages").innerHTML += data;

            });
            fr.readAsDataURL(file);

            image.value = "";
        }
    });
</script>
<script src="/js/bootstrap.bundle.min.js"  ></script>
</body>
</html>
