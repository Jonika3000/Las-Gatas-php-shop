<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
if(isset($_POST['addBtn'])) {
    $dataEmail = $_POST['emailUser'];
    $dataLogin = $_POST['loginUser'];
    $pass = $_POST['passUser'];
    $activeDivId = $_POST['activeDivId'];
if (!empty($dataEmail) && !empty($dataLogin) && !empty($pass)) {
    $sql = "SELECT COUNT(login) AS num FROM users WHERE login = :username";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':username', $dataLogin);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0){
        echo '<script>alert("Login already exists")</script>';
    }
    else
    {
        $sql = "INSERT INTO `users` (`id`, `login`, `email`, `password`,`idAvatar`) VALUES (NULL, '$dataLogin', '$dataEmail','$pass','$activeDivId')";
        $dbh->exec($sql);
        header('Location: login.php');
        exit();
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
<body style="background-color: #343a40;padding: 0px">

<form method="post" style="height: 100%;margin: 0px 0px">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100" style="padding-top: 0.5rem !important;padding-bottom: 0.5rem !important;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                <p class="text-white-50 mb-5">Please fill in the empty fields!</p>
                                <input type="hidden" name="activeDivId" value="1">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="loginUser" id="typeLoginX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeLoginX">Login</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="emailUser" id="typeEmailX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="passUser" id="typePasswordX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <div class="container" style="margin: 15px 0px">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * FROM `avatars`";
                                            $command = $dbh->query($sql);
                                            foreach($command as $row) {
                                                $url= $row["urlImage"];
                                                $id= $row["id"];
                                                echo '
                                    <div class="col-sm" >
                                        <img src="'.$url.'"
                                        id="'.$id.'"
                                             class="avatarStyle noActive"
                                             onclick="changeActive(this)"
                                             style="width: 50px;height: 50px; cursor: pointer;"
                                             alt="Avatar" />
                                    </div> 
                                       ';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <label class="form-label">Select avatar</label>
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" name="addBtn" type="submit">Register</button>

                                <div class="d-flex justify-content-center text-center mt-2 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                            </div>

                            <div>
                                <p class="mb-0">Have account? <a href="/login.php" class="text-white-50 fw-bold">Sign in</a>
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
<style>
    .noActive{
        border-radius: var(--bs-border-radius-lg)!important;
    }

    .activeAvatar{
        border:solid #0a58ca;
        border-radius: var(--bs-border-radius-lg)!important;
    }

</style>
<script>
    function changeActive(element) {
        var boxes = document.querySelectorAll("img");
        for (var i = 0; i < boxes.length; i++) {
            boxes[i].classList.remove("activeAvatar");
        }
        element.classList.add("activeAvatar");
        var activeDiv = document.getElementsByName('activeDivId')[0];
        activeDiv.value = element.getAttribute('id');
        console.log( activeDiv.value);
    }

</script>