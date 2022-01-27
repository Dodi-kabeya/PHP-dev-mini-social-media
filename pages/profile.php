
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
 <title>Profil d'utilisateur</title>
</head>
<body>

    <?php 
        include "menu.php";
        include_once "../db/connection.php";
    ?>
    

    <div class="container mt-5">

        <!--formulaire de photo -->
        <div class="row mt-5">
        
            <div class="position-relative">
                <!--static background image-->
                <div class="position-relative" id="bg_dark">
                </div>
                <!--end static background image-->
                
                <!--Profile image-->
                <div class="position-absolute top-100 start-50 translate-middle mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    
                    <!--Image du profile-->
                    <img src="../photo/profile/<?php echo $_SESSION['photo'];?>" alt="user profile" id="hold" height="160px" width="160px">
                    <!--end Image du profile-->

                </div>
                <!--end Profile image-->

            </div>

            <!--début formulaire-->
            
            <!--end formulaire-->

        </div>
        <!--end formulaire de photo -->


        <div class="row my-5">
            <div class="my-4">
                <p class="text-center fs-2 fw-bold text-break"><?= $_SESSION['name']; ?> <?= $_SESSION['surname'] ?></p>
                <p class="text-center fs-2 fw-bold text-break"><?php echo $_SESSION['artisan_num'];?></p>
            </div>
        </div>

            <!--post textfield-->
        <div class="row">
            <?php
                if(!empty($_GET['post'])){
                    echo "<div class='alert alert-success text-center alert-dismissible fade show' role='alert'>";
                    echo $_GET['post'];
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
                else{
                    echo "";
                }
            
            ?>
            <!--début formulaire de publication d'image-->
            <form action="../db/publication.php" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-xs-5 col-7">

                        <div class="mb-3">
                            <textarea name="commentaire" id="" cols="30" rows="8" class="form-control" placeholder="Quoi de neuf?"></textarea>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-5">

                        <div class="mb-3">
                            <img src="../photo/app/imageholder.png" alt="" onclick="triggerclick()" id="profileDisplay" height="200px" width="150px">
                            <input type="file" name="upload" id="profileImage" onchange="displayImage(this)" class="form-control" style="display: none;">
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-3 col-12 px-3">
                        <div class="mb-3">
                            <input type="submit" value="Publier" name="submit" class="form-control btn btn-success">
                        </div>
                    </div>
                </div>

            </form>
            <!--end formulaire de publication d'image-->
        </div>

        <div class='row'>
            <!--end post textfield-->
            <p class="text-primary text-center fs-2 fw-bold">Vos Oeuvres</p>
            <div class="col-lg-3 col-md-3 col-xs-2 col-0"></div>
            <!-- Affichage des images et postes -->
            <div class="col-lg-6 col-md-6 col-xs-8 col-12 mb-3">

               <?php

                    $user = $_SESSION['email'];

                    $conn = new DBconnection();

                    $sql = "SELECT utilisateurs.name, utilisateurs.surname, posts.user_picture, posts.comment, posts.date 
                    FROM utilisateurs INNER JOIN posts ON utilisateurs.email = posts.email AND utilisateurs.email = ? ORDER BY posts.date DESC";

                    $stmt = $conn->createConnection()->prepare($sql);

                    $stmt->execute([ $user]);

                    $rows = $stmt->fetchAll();

                    foreach($rows as $row){
                        
                        // début d'affiche photo
                        echo "<div class='card mb-3' style='max-height: 600px;'>";
                        echo "<img src='../photo/posts/$row->user_picture' height='300px'>";
                        // card body
                        echo "<div class='card-body'>";

                        if(strlen($row->comment) >= 300){
                            echo "<p class='card-text text-start'>" . substr($row->comment, 0, 300 ). " <a href='moreinfo.php?pub=$row->user_picture&date=$row->date&comment=$row->comment' class='text-decoration-none'>Lire la suite...</a> </p>";
                            echo "<p class='card-text text-end'> Publié le " . substr($row->date, 0, 10) ." à ". substr($row->date, 10) . "</p>";

                        }else{
                            echo "<p class='card-text text-start'>" . $row->comment . "</p>";
                            echo "<p class='card-text text-end'> Publié le " . substr($row->date, 0, 10) ." à ". substr($row->date, 10) . "</p>";

                        }

                        echo "</div>";
                        // end card body
                        echo "</div>";
                        // end affiche photo
                    }
               ?>

               

            </div>
            <!--end Affichage des images et postes -->
            <div class="col-lg-3 col-md-3 col-xs-2 col-0"></div>
        </div>



    </div>
    
    <script src="../js/profile.js"></script>
    <!-- <script src="../js/background.js"></script> -->
</body>
</html>