<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>user searching</title>
</head>
<body>
    <?php 

        include "menu.php";

        include_once "../db/connection.php";       
    
    ?>
    
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
            <div class="col-lg-8 col-md-8 col-xs-12 col-12">
                <!--formulaire de recherche-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="row mt-5" >
                    <div class="col-lg-8 col-md-8 col-xs-8 col-8">
                        <input type="search" class="form-control" name="recherche" placeholder="Artisan">
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-4 col-4">
                        <button type="submit" name="submit" class="btn btn-primary mb-3">Recherche</button>
                    </div>
                </form>
                <!--end formulaire de recherche-->

                <!-- retour des valeurs demander -->
                <div class="container-fluid">
                    <?php
                    
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            
                            $conn = new DBconnection();

                            $recherche = htmlspecialchars($_POST['recherche'], ENT_QUOTES, 'utf-8');


                            if(empty(htmlspecialchars($_POST['recherche'])) && isset($_POST['submit'])){

                                echo "<p class='alert alert-warning text-start text-danger'>Utilisateur Non trouvé</p>";
                            }
                            else{
                                $sql = "SELECT * FROM utilisateurs WHERE name LIKE ? OR surname LIKE ?";
            
                                $stmt = $conn->createConnection()->prepare($sql);
                                
                                $search = "%".$recherche."%";

                                $stmt->execute([$search, $search]);
                
                                $data = $stmt->fetchAll();
                                
                                
                                foreach($data as $info){
                                    echo "<a href='userInfo.php?name=$info->name&amp;surname=$info->surname&photo=$info->photo&email=$info->email&prof=$info->profession' class='text-decoration-none'>";
                                    echo "<div class='card mb-2 p-2 rounded border-0 shadow-sm'>";
                                    echo "<div class='row'>";
                                    echo "<div class='col-lg-3 col-sm-3 col-md-3 col-3'>";
                                    echo "<img src='../photo/profile/$info->photo' class='card-img-top rounded-circle' alt='mypics' height='70px' width='70px' >";
                                    echo "</div>";
                                    echo "<div class='col-lg-5 col-md-5 col-sm-5 col-5'>";
                                    echo "<p class='card-text fw-bolder  text-dark'>". strtoupper($info->name). " ". strtoupper($info->surname) . "</p>";
                                    echo "<p class='card-text fw-light  text-dark'>". strtoupper($info->profession). "</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>"; 
                                    echo "</a>";
                                }
                            }
                                
                                
                        }
                    
                    
                    ?>
                </div>
                <!-- end retour des valeurs demander -->
            </div>
            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
        </div>
    </div>

</body>
</html>