<?php
    session_start();


    require_once __DIR__ ."./connection.php";

    class Logs extends DBconnection{

        public function user($email, $password){

            $conn = new DBconnection();

            if(isset($_POST['submit'])){

                $sql = "SELECT * FROM utilisateurs WHERE email = ? and mot_de_passe = ? LIMIT 1";

                $stmt = $conn->createConnection()->prepare($sql);

                if($stmt->execute([$email, $password])){

                    $dir = '/home.php';
                    $ext = '../pages';
                    header('Location:'.$ext . $dir);
                    exit();

                }

            }else{
                echo "Connection Failed";
            }
        }
    }

    $email = htmlspecialchars($_POST['mail']);

    $password = htmlspecialchars($_POST['pswd']);

    $login = new Logs();

    $login->user($email, $password);



?>