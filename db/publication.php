<?php 
    
    include "../pages/menu.php";
    include_once "create.php";

        
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $comment = htmlspecialchars($_POST['commentaire']);
        $date = date('Y-m-d H:i:s'); 
        $mail = $_SESSION['email'];
        $photo = $_FILES['upload']['name'];

        $target_file = '../photo/posts/' . basename($photo);

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // envoyer le formulaire
        if(isset($_POST['submit'])){

            // vérifier la taille de l'image
            if($_FILES['upload']['size'] > 300000000){

                header('Location:./../pages/profile.php?post=veuillez poster une image moins de 3 Mo');
                exit();

            }else{
                // vérifier réelement si c'est bien une image qui est mises en ligne
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){

                    header('Location:./../pages/profile.php?post=le fichier que vous venez de poster n\'est pas une image, veuillez poster une image!!!');
                    exit();
                }
                else{

                    // àpres plusieurs vérification l'image peut être mises en ligne 
                    if( move_uploaded_file($_FILES['upload']['tmp_name'], '../photo/posts/' . basename($photo) ) ){

                        $post = new insertData();
        
                        $post->publication($mail, $photo, $comment, $date);
                        header('Location:./../pages/profile.php?post=vous venez de posté');
                        exit();
                        
                    }
                }
                
            }
            
        }

    }


?>