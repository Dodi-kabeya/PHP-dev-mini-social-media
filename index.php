<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap library CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>ENRGBAT INTRANET</title>
</head>
<body>
 <!-- php login code -->
    <?php


        include_once "db/connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $mail = htmlspecialchars($_POST['mail']);
            $mdp = htmlspecialchars($_POST['pswd']);

            if(isset($_POST['submit'])){

                

                $mdp = md5($mdp);

                if(empty($mail) || empty($mdp)){
                    header("Location:index.php?Error=Erreur E-mail ou Mot de passe Incorrect");
                    exit();
                }
                else{
                    $conn = new DBconnection();

                    $sql = "SELECT * FROM utilisateurs WHERE email = ? and mot_de_passe = ? LIMIT 1";

                    $stmt = $conn->createConnection()->prepare($sql);

                    $stmt->execute([$mail, $mdp]);

                    $fetch = $stmt->fetchAll();

                    if($fetch){

                        foreach($fetch as $row){
                            $_SESSION['id'] = $row->id;
                            $_SESSION['name'] = $row->name;
                            $_SESSION['surname'] = $row->surname;
                            $_SESSION['email'] = $row->email;
                            $_SESSION['profession'] = $row->profession;
                            $_SESSION['address'] = $row->address;
                            $_SESSION['phone'] = $row->phone;
                            $_SESSION['gender'] = $row->gender;
                            $_SESSION['photo'] = $row->photo;
                            $_SESSION['artisan_num'] = $row->artisan_num;
                            $_SESSION['date'] = $row->date;
                            $_SESSION['mot_de_passe'] = $row->mot_de_passe;
                        }

                        $dir ='home.php';
                        $ext = './pages/';

                        header('Location:'. $ext . $dir);
                        exit();
                        
                        
                    }
                    else{
                        header("Location:index.php?Error=Utilisateur introuvable");
                        exit();
                    }
                }


            }
        }
    
    
    ?>
    <!-- php end login code -->
    
    <!--login form-->
    <div class="container p-3">

        <div class="row">
        
            <div class="col-lg-3 col-md-3 col-xs-3 col-0"></div>
            <div class="col-lg-6 col-md-6 col-xs-6 col-12">

                <div class="card p-2">
                    <img src="photo/app/user.png" alt="enrgbat" class="card-img-top img-fluid" width="100px" height="100px">
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="m-2 p-2" method="post">

                             
                            <?php 
                                if(empty($_GET['Error'])){
                                    echo "";
                                }
                                else{
                                    echo "<p class='alert alert-warning text-center text-danger'>" . $_GET['Error'] ."</p>";
                                }
                            ?>

                            <div class="mb-2">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="mail" id="mail" class="form-control" placeholder="engrbat@gmail.com">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Mot de passe</label>
                                <input type="password" name="pswd" id="pswd" class="form-control" placeholder="*********">
                            </div>

                            <div class="mb-2">
                                <a href="#" class="text-decoration-underline text-primary">
                                    Mot de Passe oublié
                                </a>
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" name="check" id="check" class="form-check-input">
                                <label for="accepte" class="form-check-label">J'accepte de sauvegarder mes identifiants</label>
                            </div>

                            <div class="mb-2 col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-xs-6 col-xs-offset-6 col-12">
                                <input type="submit"  name="submit" id="submit" value="se connecter" class="btn btn-success">
                            </div>
                        
                        
                        </form>
                    </div>
                </div>
            
            
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3 col-0"></div>
    
        </div>
    
    
    
    </div>

    <!--end login form-->


    <!--bootstrap library JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>