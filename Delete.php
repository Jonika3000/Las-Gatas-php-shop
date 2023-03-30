<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if(isset($_POST['deletebtn'])) {
    $data4 = $_POST['id'];//записуємо в змінну дані з форми по id input
    $sql = "DELETE FROM tbl_categories WHERE `tbl_categories`.`id` = '$data4'";//створюємо змінну з sql командою
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
    <h1>Delete</h1>
    <form  method="post">
        <div class="mb-3">
            <label for="name" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id">
        </div>
        <button type="submit" name="deletebtn" class="btn btn-primary">Видалити</button>
    </form>

</div>
</body>
</html>