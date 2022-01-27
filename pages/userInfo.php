
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
                    <img src="../photo/profile/<?php echo $_GET['photo'];?>" alt="user profile" id="hold" height="160px" width="160px">
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
                <p class="text-start fs-2 fw-bold text-break"><?= $_GET['name']; ?> <?= $_GET['surname'] ?></p>
                <p class="text-start fs-2 fw-bold text-break"><?= $_GET['prof']; ?></p>
            </div>
        </div>

        <div class='row'>
            <!--end post textfield-->
            <p class="text-primary text-center fs-2 fw-bold">Ses Oeuvres</p>
            <div class="col-lg-3 col-md-3 col-xs-2 col-0"></div>
            <!-- Affichage des images et postes -->
            <div class="col-lg-6 col-md-6 col-xs-8 col-12 mb-3">

               <?php

                    $user = $_GET['email'];

                    $conn = new DBconnection();

                    $sql = "SELECT utilisateurs.name, utilisateurs.surname,utilisateurs.photo, utilisateurs.email, posts.user_picture, posts.comment, posts.date 
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
                            echo "<p class='card-text text-start'>" . substr($row->comment, 0, 300 ). " <a href='moreinfo.php?name=$row->name&surname=$row->surname&photo=$row->photo&pub=$row->user_picture&date=$row->date&email=$row->email' class='text-decoration-none'>Lire la suite...</a> </p>";
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
    
    <!-- <script src="../js/profile.js"></script> -->
    <!-- <script src="../js/background.js"></script> -->
</body>
</html>