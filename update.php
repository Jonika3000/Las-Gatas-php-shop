<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if(isset($_POST['deletebtn'])) {

    $data4 = $_POST['id'];//записуємо в змінну дані з форми по id input
    $data1 = $_POST['name'];//записуємо в змінну дані з форми по id input
    $data2 = $_POST['image'];//записуємо в змінну дані з форми по id input
    $data3 = $_POST['description'];//записуємо в змінну дані з форми по id input
    // Формируем SQL-запрос на удаление записи
    $sql = "UPDATE `tbl_categories` SET `name` = '$data1', `image` = '$data2', `des` = '$data3' WHERE `tbl_categories`.`id` = '$data4'";

    $dbh->exec($sql);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<!--підключення файлу який конектить нас до бд-->
<?php include($_SERVER["DOCUMENT_ROOT"]."/_header.php"); ?><!--підключення html коду з меню-->
<body>
<div class="container">
    <h1>Update</h1>
    <form  method="post">
        <div class="mb-3">
            <label for="name" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">URL фото</label>
            <input type="text" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <div class="form-floating">
                    <textarea class="form-control"
                              name="description"
                              placeholder="Leave a comment here"
                              id="description"
                              style="height: 100px"></textarea>
                <label for="description">Опис</label>
            </div>
        </div>
        <button type="submit" name="deletebtn" class="btn btn-primary">Обновити</button>
    </form>

</div>
</body>
</html>