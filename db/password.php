<?php

    include __DIR__ ."./../pages/menu.php";  
    include_once __DIR__ ."./create.php";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        
        $mdp = htmlspecialchars($_POST['mdp']);
        $nv_mdp = htmlspecialchars($_POST['nv_mdp']);
        $mail = $_SESSION['email'];
        $session_pswd = $_SESSION['mot_de_passe'];

        
        if(isset($_POST['changer'])){

            $data = new insertData();

            $data->updateUserPassword($mdp, $nv_mdp, $mail, $session_pswd);
            
            header('Location:../pages/settings.php?donne=Mot de passe modifié');
            exit();
        }
    }



?>