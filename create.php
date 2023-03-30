<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if(isset($_POST['deletebtn'])) {
    $data1 = $_POST['name']; //записуємо в змінну дані з форми по id input
    $data2 = $_POST['image'];//записуємо в змінну дані з форми по id input
    $data3 = $_POST['description'];//записуємо в змінну дані з форми по id input
    $sql = "INSERT INTO `tbl_categories` (`id`, `name`, `image`, `des`) VALUES (NULL, '$data1', '$data2', '$data3')"; //створюємо змінну з sql командою
    if($data3 != '')//перевірка на null
        $dbh->exec($sql);//виконуємо sql команду
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
<?php include($_SERVER["DOCUMENT_ROOT"]."/_header.php"); ?><!--підключення html коду з меню-->
<body>
<div class="container">
    <h1>Add</h1>
    <form  method="post"class="needs-validation">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
                Вкажіть шлях до фото категорії
            </div>
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
        <button type="submit" name="deletebtn" class="btn btn-primary">Додати</button>
    </form>
</div>
</body>
</html>