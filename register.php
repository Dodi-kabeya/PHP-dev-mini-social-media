
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

    <?php 

        include_once "db/create.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $mail = htmlspecialchars($_POST['email']);
            $tel = htmlspecialchars($_POST['phone']);
            $mdp = htmlspecialchars($_POST['pswd']);
            $cfm_pswd = htmlspecialchars($_POST['cfm_pswd']);
            $profession = htmlspecialchars($_POST['profession']);
            $addresse = htmlspecialchars($_POST['address']);
            $photo = $_FILES['picture']['name'];
            $gender = htmlspecialchars($_POST['radio_btn']);

            if(isset($_POST['submit'])){

                if( move_uploaded_file($_FILES['picture']['tmp_name'], './photo/profile/' . basename($photo) ) ){

                    if( $mdp == $cfm_pswd ){

                        $mdp = md5($mdp);
                            
                        $data = new insertData();

                        $artisan_num = rand(10000000, 99999999);
    
                        $data->insert($name, $surname, $mail, $tel, $profession, $addresse, $gender, $photo, $mdp, $cfm_pswd, $artisan_num);
        
                        $dir ='index.php';
                        $ext = './';
        
                        header('Location:'. $ext . $dir);
                        exit();
        
                    }else{
                        echo "Password are not equal";
                    }

                }
            }
        }

    ?>

    <div class="container my-2">
        <!--form registering -->
        <div class="row">

            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
            <div class="col-lg-8 col-md-8 col-xs-12 col-12">
                <div class="card p-2">
                    <!-- <img src="photo/app/app.png" alt="enrgbat" class="card-img-top img-fluid" height="100px" width="100px"> -->

                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="m-2 p-2" enctype="multipart/form-data">
                            <legend class="text-center fs-2 fw-bold">ENRGBAT</legend>

                            <div class="row py-2">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">

                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="surname" class="form-label">Prénom</label>
                                    <input type="text" name="surname" id="surname" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="phone" class="form-label">Numéro de téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="pswd" class="form-label">Mot de passe</label>
                                    <input type="password" name="pswd" id="pswd" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="cfm_pswd" class="form-label">Confirmer le mot de passe</label>
                                    <input type="password" name="cfm_pswd" id="cfm_pswd" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="profession" class="form-label">Profession</label>
                                    <input type="text" name="profession" id="profession" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="address" class="form-label">Addresse</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                                    <label for="picture" class="form-label">Photo</label>
                                    <input type="file" name="picture" id="picture" class="form-control">
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-12 form-check">
                                    <p class="text-center">Gender</p>
                                    <div class="form-check">

                                        <input type="radio" name="radio_btn" id="radio_btn_2" value="F" class="form-check-input">
                                        <label for="Female" class="form-label">Female</label>
                                    
                                    </div>
                                    <div class="form-check">

                                        <input type="radio" name="radio_btn" id="radio_btn_2" value="M" class="form-check-input">
                                        <label for="Female" class="form-label">Male</label>
                                    
                                    </div>
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
            <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
        
        
        
        </div>
        <!--end form registering-->
    
    
    </div>

    <!--bootstrap library JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>