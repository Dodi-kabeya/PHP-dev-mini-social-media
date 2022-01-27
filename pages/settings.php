<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>user Data settings</title>
</head>
<body>

    <?php 
    
        include "menu.php";      
        include_once "../db/create.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $mail = $_SESSION['email'];
            $tel = htmlspecialchars($_POST['phone']);
            $profession = htmlspecialchars($_POST['profession']);
            $addresse = htmlspecialchars($_POST['address']);

            if(isset($_POST['submit'])){

                $data = new insertData();


                $data->updateData($name, $surname, $mail, $tel, $profession, $addresse);

                $dir ='settings.php?donne=Modification réussi';
                $ext = './';

                header('Location:'. $ext . $dir);
                exit();
            }
        }
    
    ?>
    <div class="container-fluid p-5 mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-0 col-0"></div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-12 bg-light p-3">

                <?php
                    if(!empty($_GET['donne'])){
                        echo "<p class='alert alert-success text-center'>". $_GET['donne'] ."</p>";
                    }else{
                        echo "";
                    }
                ?>

                <!--confidentialité -->
                <div class="card bg-light mb-3">
                    <div class="row p-2">
                        <div class="col-lg-4 col-md-4 col-xs-4 col-4">
                            <img src="../photo/app/placeholder.png" height="50px" width="50px" alt="" class="rounded-circle">
                        </div>
                        <div class="col-lg-8 col-md-8 col-xs-8 col-8">
                            Politique
                        </div>
                    </div>
                </div>
                <!--end confidentialité -->

                <!--Mot de passe -->
                <div class="card bg-light mb-3 accordion" id="modifier_mdp">

                    <div class="accordion-item bg-light">
                        <div class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#modifier" aria-expanded="false" aria-controls="modifier">
                              Modifier Mot de Passe
                            </button>

                        </div>
                        <div id="modifier" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#modifier_mdp">
                        <div class="accordion-body">

                            <form action="../db/password.php" method="post" class="m-2 p-2" enctype="multipart/form-data">

                                    <div class="row py-2">

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="mdp" class="form-label">Mot de passe actuel</label>
                                            <input type="password" name="mdp" id="mdp" class="form-control">
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="nv_mdp" class="form-label">Nouveau mot de passe</label>
                                            <input type="password" name="nv_mdp" id="nv_mdp" class="form-control">
                                        </div>                               


                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-xs-12 col-12 mb-2">
                                            <input type="submit" value="changer" name="changer" class="btn btn-success">
                                        </div>
                                    
                                    </div>                                                
                            
                                </form>

                        </div>
                        </div>
                    </div>

                </div>
                <!--end Mot de passe -->

                <!--Changer les Données -->
                <div class="card bg-light mb-3 accordion" id="changer_donnee">

                    <div class="accordion-item bg-light">
                        <div class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#changer" aria-expanded="false" aria-controls="changer">
                                Changer les Données
                            </button>
                        </div>
                        <div id="changer" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#changer_donner">
                            <div class="accordion-body">
                                

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="m-2 p-2" enctype="multipart/form-data">

                                    <div class="row py-2">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">

                                            <label for="name" class="form-label">Nom</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="surname" class="form-label">Prénom</label>
                                            <input type="text" name="surname" id="surname" class="form-control">
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="phone" class="form-label">Numéro de téléphone</label>
                                            <input type="tel" name="phone" id="phone" class="form-control">
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" name="profession" id="profession" class="form-control">
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                                            <label for="address" class="form-label">Addresse</label>
                                            <input type="text" name="address" id="address" class="form-control">
                                        </div>                               


                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-xs-12 col-12 mb-2">
                                            <input type="submit" value="submit" name="submit" class="btn btn-success">
                                        </div>
                                    
                                    </div>                                                
                            
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end Changer les Données -->

                <!--Supprimer Mon compte -->
                <div class="card bg-light mb-3 accordion" id="supprimer_mon_compte">

                    <div class="accordion-item bg-light">
                        <div class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#supprimer" aria-expanded="false" aria-controls="supprimer">
                                Supprimer mon compte
                            </button>
                        </div>
                        <div id="supprimer" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#supprimer_mon_compte">
                        <div class="accordion-body">
                            <p class="text-card text-break">En cliquant sur <a href="../db/supprimer.php">supprimer mon compte</a> vous acceptez de ne plus avoir access à ce compte</p>
                        </div>
                        </div>
                    </div>

                </div>
                <!--end Supprimer Mon compte -->

            </div>
            <div class="col-lg-4 col-md-4 col-xs-0 col-0"></div>
        </div>
    </div>



</body>
</html>