<?php
ob_start();
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if (isset($_POST['addBtn'])) {
    $login = $_POST['typeLoginX'];
    $password = $_POST['typePasswordX'];

if (!empty($login) && !empty($password)) {
    $sql = "SELECT COUNT(login) AS num FROM users WHERE login = :username and password = :pass";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':username', $login);
    $stmt->bindValue(':pass', $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {

        $sql = "SELECT id
                FROM users 
                WHERE users.login = :Logini";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':Logini',$login);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["idUser"] = $result['id'];
        $_SESSION["userLogin"] = $login;
        if($_SESSION["userLogin"] === "admin")
        {
            $_SESSION["isAdmin"] = "true";
            header('Location: indexAdmin.php');
        }
        else
            {
                $_SESSION["isAdmin"] = "false";
                header('Location: index.php');
            }

        exit();
    }
    else {
        echo '<script>alert("invalid username or password")</script>';
    }
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
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body style="background-color: #343a40">
<form method="post">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="typeLoginX" name="typeLoginX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="typePasswordX" id="typePasswordX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" name="addBtn" type="submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="/register.php" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>
