
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
 <title>More info</title>
</head>
<body>

    <?php 
        include "menu.php";
        include_once "../db/connection.php";
    ?>
    

    <div class="container mt-5">

        <div class='row'>
            <!-- espace reservé -->
            <div class="col-lg-3 col-md-3 col-xs-3 col-0">
            </div>
            <!-- espace reservé end -->

            <div class="col-lg-6 col-md-6 col-xs-6 col-12 mt-4">

                <!-- afficher l'image -->
                <div class="row mb-2">

                    <img src="../photo/posts/<?= $_GET['pub'];?>" alt="" height="350px">
                
                </div>
                <!-- afficher l'image end -->

                <!-- afficher commentaire et autres  -->
                <div class="row">

                    <!-- affichage du proprio de la publication -->
                    
                        <?php

                            if(!empty($_GET['photo']) && !empty($_GET['name'] || $_GET['surname']) ){
                                $user_image = $_GET['photo'];
                                echo "<div class='row g-2 bg-dark mb-2'>";
                                echo "<div class='col-auto'>";
                                echo "<img src='../photo/profile/$user_image' alt='ownersPic' height='50px' width='50px' class='rounded-circle'>";
                                echo "</div>";

                                echo "<div class='col-auto'>"; 
                                echo "<p class='text-white fs-5'>" . $_GET['name'] . " ". $_GET['surname'] ."</p>";
                                echo "<p class='text-white'>Publié le " . substr($_GET['date'], 0, 10) ." à ". substr($_GET['date'], 10) ."</p>";
                                
                                echo "</div>";
                                echo "</div>";
                            }else{
                                echo "";
                            }
                        
                        ?>
                        
                    <!-- end affichage du proprio de la publication end -->

                    <!-- affichage du commentaire complet de l'auteur -->
                    <div class="row">
                    
                        <p class="text-start">
                            <?php 

                                $conn = new DBconnection();

                                $sql = "SELECT utilisateurs.name, utilisateurs.surname, posts.user_picture, posts.comment, posts.date 
                                FROM utilisateurs INNER JOIN posts ON utilisateurs.email = posts.email AND posts.user_picture = ? ";

                                $stmt = $conn->createConnection()->prepare($sql);

                                $stmt->execute([$_GET['pub'] ]);

                                $rows = $stmt->fetchAll();

                                foreach($rows as $row){
                                    echo "<p>" . $row->comment . "</p>";
                                }
                            
                            
                            ?>
                        </p>
                    
                    </div>
                    <!-- affichage du commentaire complet de l'auteur end -->
                    
                </div>
                <!-- afficher commentaire et autres end -->
            
            
            </div>

            <!-- espace 2 reservé  -->
            <div class="col-lg-3 col-md-3 col-xs-3 col-0"></div>
            <!-- espace 2 reservé end -->


        </div>



    </div>
    
</body>
</html>