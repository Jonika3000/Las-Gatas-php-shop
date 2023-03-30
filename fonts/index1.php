<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"><!--підключення bootstrap (стилів і тд.)-->
    <link rel="stylesheet" href="/css/style.css"><!--підключення наших стилів-->
    <link rel="stylesheet" href="/css/font-awesome.css">
</head>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?><!--підключення html коду з меню-->
<?php include($_SERVER["DOCUMENT_ROOT"] . "/connect.php"); ?><!--підключення файлу який конектить нас до бд-->
<body>
<main>
    <div class="container">
        <h1 class="text-center">Список категорій</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Фото</th>
                <th scope="col">Навва</th>
                <th scope="col">Опис</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php //початок php коду
                $sql = "SELECT * FROM tbl_categories";//записуємо команду sql для вибіркі данних з таблиці
                $command = $dbh->query($sql);//створення зміної яка буде зберігати дані з табл. dbh змінна бази даних і query це функція яка приймає як аргумент команду sql і виконує її
                foreach($command as $row) {//перебираємо змінну command
                    $name = $row["name"];//присвоємо дані з колонки name змінні name
                    $image = $row["image"];//присвоємо дані з колонки image змінні image
                    $des = $row["des"];//присвоємо дані з колонки des змінні des
                    echo " <!--виводимо дані на екран за допомогою echo.Echo не має значення, що повертається і може приймати кілька аргументів.-->
                <tr><!--добавляємо до таблиці рядкі з картинкою, іменем там описом-->
                    <td><img src='$image' width='50'/></td><!--картинка-->
                    <td>$name</td><!--імя-->
                    <td>$des</td><!--опис-->
                    <td>
                        <a href='#' class='text-primary' style='text-decoration: none;'>
                           <i class='fa fa-pencil fs-4'></i>
                        </a>
                        &nbsp;
                        <a href='#' class='text-danger'>
                           <i class='fa fa-times fs-4'></i>
                        </a>
                    </td>
                </tr>
                ";
                }
                ?><!--кінець php коду-->
            </tr>
            </tbody>
        </table>
        <a href="/create.php" class="btn btn-success">Додати категорію</a><!--кнопка яка переходить при клікові на /create.php-->
        <a href="/update.php" class="btn btn-success">Обновити дані</a><!--кнопка яка переходить при клікові на /update.php-->
        <a href="/Delete.php" class="btn btn-success">Видалити дані</a><!--кнопка яка переходить при клікові на /Delete.php-->
    </div>

</main>
</body>
</html>