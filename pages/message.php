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
    
    
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
            <div class="col-lg-8 col-md-8 col-xs-12 col-12">
                <!--formulaire de recherche-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="row mt-5">
                    <div class="col-lg-8 col-md-8 col-xs-8 col-8">
                        <input type="search" class="form-control" name="recherche" placeholder="Artisan Enrgbat">
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-4 col-4">
                        <button type="submit" name="submit" class="btn btn-primary mb-3">Recherche</button>
                    </div>
                </form>
                <!--end formulaire de recherche-->

                <!-- retour des valeurs demander -->
                <div class="container-fluid">
                    <!-- Search results from the form through the DB -->

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
                                    $_SESSION['recv'] = $info->email;
                                    $_SESSION['recv_name'] = $info->name;
                                    $_SESSION['recv_surname'] = $info->surname;
                                    $_SESSION['recv_photo'] = $info->photo;
                                    echo "<div class='card p-2 mb-3 rounded border-0 shadow-sm'>";
                                    echo "<div class='row'>";
                                    echo "<div class='col-lg-3 col-sm-3 col-md-3 col-3'>";
                                    echo "<img src='../photo/profile/$info->photo' class='card-img-top' alt='mypics' height='50px' width='50px' >";
                                    echo "</div>";
                                    echo "<div class='col-lg-5 col-md-5 col-sm-5 col-5'>";
                                    echo "<p class='card-text font-weight-bolder'>". strtoupper($info->name). " ". strtoupper($info->surname) . "</p>";
                                    echo "</div>";

                                    echo "<div class='col-lg-4 col-md-4 col-sm-4 col-4'>";
                                    echo "<a href='./chat.php?recv=".$_SESSION['recv']."&amp;name=$info->name&amp;surname=$info->surname&photo=$info->photo' class='btn btn-success card-text font-weight-bolder'>Message</a>";
                                    echo "</div>";


                                    echo "</div>";
                                    echo "</div>"; 
                                }
                                echo "<hr>";
                            }
                                
                                
                        }
                    ?>
                    <!-- End of search results from the form through the DB -->

                    <?php
                        // displaying the list fetched from the DB of users to whom you echanged messages
                        $db = new DBconnection(); 
                        // connection to the DB via __DIR__ ./../db/connection.php

                        $query = "SELECT utilisateurs.name, utilisateurs.surname, utilisateurs.photo, conversations.email, conversations.recv,
                        conversations.chats, conversations.date 
                        FROM utilisateurs INNER JOIN conversations ON utilisateurs.email = conversations.email
                        WHERE conversations.recv = ? AND NOT conversations.email = ?
                        GROUP BY conversations.email
                        ORDER BY conversations.date, conversations.chats DESC";

                        $stmt = $db->createConnection()->prepare($query);

                        $stmt->execute(array( $_SESSION['email'], $_SESSION['email'] ));

                        $rows = $stmt->fetchAll();

                        foreach($rows as $row){
                           

                            echo "<a href='./chat.php?recv=$row->email&amp;name=$row->name&amp;surname=$row->surname&photo=$row->photo' class='text-decoration-none text-dark mb-2'>";
                            
                            echo "<div class='card mb-3 p-2 rounded border-0 shadow-sm'>";
                            echo "<div class='row'>";
                            echo "<div class='col-lg-3 col-sm-3 col-md-3 col-3'>";
                            
                            echo "<img src='../photo/profile/$row->photo' class='card-img-top' alt='mypics' height='50px' width='50px' >";
                            echo "</div>";
                            echo "<div class='col-lg-7 col-md-7 col-sm-7 col-7'>";
                            echo "<p class='card-text fw-bolder'>". strtoupper($row->name)." ".strtoupper($row->surname). "</p>";
                            echo "<p class='card-text'>". $row->chats ." ...</p>";
                            echo "</div>";

                            echo "<div class='col-lg-1 col-md-1 col-sm-1 col-1'>";
                            echo "<span class='position-absolute top-50 start-90 translate-middle p-2 bg-danger border border-danger rounded-circle'>";
                            echo "<span class='visually-hidden'>New alerts</span>";
                            echo "</span>";
                            echo "</div>";


                            echo "</div>";
                            echo "</div>"; 


                            echo "</a>";
                        }

                        //End displaying the list fetched from the DB of users to whom you echanged messages
                    
                    ?>
                </div>
                <!-- end retour des valeurs demander -->
            </div>
            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
        </div>
    </div>



</body>
</html>