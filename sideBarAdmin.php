<?php
if(!$_SESSION["userLogin"])
{
    header('Location: login.php');
    exit();
}
?>
<div class="main position-fixed" style="width: 280px" >
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="height: 100vh">
        <a href="/indexAdmin.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img class="bi me-2" style="width: 30px;height: 30px" src="https://cdn.discordapp.com/attachments/1008702280633163836/1089994449800667168/icons8_cat_96px_1.png"/>
            <span class="fs-4">Las gatas</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="indexAdmin.php" class="nav-link text-white" id="HomePageid" aria-current="page">
                    <img style="width: 30px;height: 30px" src="https://cdn.discordapp.com/attachments/1008702280633163836/1089992366179491860/icons8_home_480px_1.png"/>
                    Home
                </a>
            </li>
            <?php
            $sql = "SELECT * FROM `tbl_categories`";
            $command = $dbh->query($sql);
            foreach($command as $row) {
                $url= $row["image"];
                $id= $row["id"];
                $name = $row["name"];
                echo '
                                <li>
                               <a href="http://local.pv121.com/categoryProducts.php?id='.$id.'" class="nav-link text-white" id="'.$id.'">
                               <img style="width: 30px;height: 30px" src="'.$url.'"/>
                               '.$name.'
                               </a>
                                 </li>
                                       ';
            }
            ?>

        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img <?php
                $sql = "SELECT avatars.urlImage
                FROM avatars
                JOIN users ON avatars.id = users.idAvatar
                WHERE users.id = :Logini";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':Logini', $_SESSION["idUser"]);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $urlimage = $result['urlImage'];
                echo '<img src="'.$urlimage.'"';?>
                    alt="" width="32" height="32" class="rounded-circle me-2">
                <?php
                echo " <strong>" . $_SESSION["userLogin"] . "</strong>";?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="/addProduct.php">New product</a></li>
                <li><a class="dropdown-item" href="/addCategory.php">New category</a></li>
                <li><a class="dropdown-item" href="/addImageProduct.php">New product image</a></li>
                <li><a class="dropdown-item" href="#">Shopping cart</a></li>
                <li><a class="dropdown-item" href="/deleteProduct.php">Delete product</a></li>
                <li><a class="dropdown-item" href="/deleteImageProduct.php">Delete product image</a></li>
                <li><a class="dropdown-item" href="/deleteCategory.php">Delete category</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/login.php">Sign out</a></li>
            </ul>
        </div>
        <?php
        if(isset($idCategory))
        {
            echo ' <script>
                change();
               function change()
               {
                   
                  var btnSelect = document.getElementById("' . $idCategory . '"); 
                      if (btnSelect.classList.contains("nav-link")) {
                          btnSelect.classList.add("active");
                   
                }
                  }
                 </script>';
        }
        else{
            echo ' <script>
                change();
               function change()
               {
                  
                          btnSelect = document.getElementById("HomePageid");
                          btnSelect.classList.add("active");
                    
            }
 
               </script>';
        }
        ?>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var boxes = document.getElementsByClassName("nav-link");
        for (var i = 0; i < boxes.length; i++) {
            boxes[i].classList.remove("active");
        }

        function changeActive(element) {
            var boxes = document.getElementsByClassName("nav-link");
            for (var i = 0; i < boxes.length; i++) {
                boxes[i].classList.remove("active");
            }
            element.classList.add("active");
        }
</script>