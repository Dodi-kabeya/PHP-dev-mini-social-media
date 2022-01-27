<?php 

    include_once "connection.php";

    class insertData extends DBconnection{

        // inserting data in a database through a register form
        public function insert($name, $surname, $mail, $tel, $profession, $addresse, $gender, $photo, $mdp, $cfm_pswd, $artisan_num){

            $date = date('Y-m-d H:i:s');
    
            $conn = new DBconnection();

            $sql = "INSERT INTO utilisateurs(name, surname, email, phone, profession, address, gender, photo, mot_de_passe, artisan_num, date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->createConnection()->prepare($sql);

            $stmt->execute([$name, $surname, $mail, $tel, $profession, $addresse, $gender, $photo, $mdp, $artisan_num, $date]);
                
        }


        // updating data in a databse through a register form
        
        public function updateData($name, $surname, $mail, $tel, $profession, $addresse){

            // $date = date('Y-m-d H:i:s');
    
            $conn = new DBconnection();

            $sql_name = "UPDATE utilisateurs SET name = ? WHERE email = ? ";
            $sql_surname = "UPDATE utilisateurs SET surname = ? WHERE email = ? ";
            $sql_phone = "UPDATE utilisateurs SET phone = ? WHERE email = ? ";
            $sql_profession = "UPDATE utilisateurs SET profession = ? WHERE email = ? ";
            $sql_address = "UPDATE utilisateurs SET address = ? WHERE email = ? ";

            $stmt = $conn->createConnection()->prepare($sql_name);
            $stmt_surname = $conn->createConnection()->prepare($sql_surname);
            $stmt_phone = $conn->createConnection()->prepare($sql_phone);
            $stmt_profession = $conn->createConnection()->prepare($sql_profession);
            $stmt_address = $conn->createConnection()->prepare($sql_address);

            $stmt->execute([$name, $mail]);
            $stmt_surname->execute([$surname, $mail]);
            $stmt_phone->execute([$tel, $mail]);
            $stmt_profession->execute([$profession, $mail]);
            $stmt_address->execute([$addresse, $mail]);
                
        }

        // supprimer mon compte

        public function deleteUser($email){

            $conn = new DBconnection();

            $sql = "DELETE FROM utilisateurs WHERE email = ?";

            $stmt = $conn->createConnection()->prepare($sql);

            $stmt->execute([$email]);
        }

        // modifier mot de passe

        public function updateUserPassword($mdp, $nv_mdp, $mail, $session_pswd){

            $conn = new DBconnection();  
            
            $hash = md5($mdp);

            if($hash == $session_pswd){

                $sql = "UPDATE utilisateurs SET mot_de_passe = ? WHERE email = ? ";

                $stmt = $conn->createConnection()->prepare($sql);

                $nv_mdp = md5($nv_mdp);

                $stmt->execute([$nv_mdp, $mail]);
            }
            else{
                header('Location:../pages/settings.php?donne=Mot de passe actuel non conforme');
                exit();
            }
        }


        // publications des photo de l'utilisateur

        public function publication($mail, $photo, $comment, $date){
            
            $conn = new DBconnection();  
            
            $sql = "INSERT INTO posts(email, user_picture, comment, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->createConnection()->prepare($sql);

            $stmt->execute([$mail, $photo, $comment, $date]);
        }

        // sending messages
        public function messaging($sender, $recv, $msg, $date){
            
            $conn = new DBconnection();  
            
            $sql = "INSERT INTO conversations(email, recv, chats, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->createConnection()->prepare($sql);

            $stmt->execute([$sender, $recv, $msg, $date]);
        }



    }




?>