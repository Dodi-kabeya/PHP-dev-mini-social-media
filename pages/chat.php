<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chat.css">
    
    <title>Message</title>
</head>
<body>

    <?php 

    include "menu.php";

    include_once "../db/connection.php";
    ?>

    <div class="containeur mt-5">
        
        <!-- chat appearence -->

        <div class="card border-0">

            <!-- displaying user photo and name -->
            <div class="card-header bg-white border-0 position-fixed top-10 w-100 mt-3" style="z-index: 1;">
                <div class="d-flex float-end mx-3">

                    <div class="col-auto fw-bold fs-5">
                        <?php echo strtoupper($_GET['name']) . " ". strtoupper($_GET['surname']);?>
                    </div>

                    <div class="col-auto align-item-center">
                        <img src="../photo/profile/<?= $_GET['photo'];?>" alt="" class="rounded-circle" width="50px" height="50px">
                    </div>
                    
                </div>
            </div>
            <div class="clr"></div>
            <!-- displaying users exchange messages -->
            <div class="card-body mt-5">
                <?php
                    if(empty($_GET['send'])){
                        echo "";
                    }else{
                        echo "<p>". $_GET['send'] ."</p>";
                    }
                ?>
                <!-- chat Element -->
                <div class="chatting-list mb-5">
                
                    <div class="chats mb-5">
                        <!-- fetching messages from the database -->
                        <?php

                            $sender = $_SESSION['email'];
                            $recv = $_GET['recv'];
                            $db = new DBconnection();
                        
                            $sql = "SELECT utilisateurs.name, utilisateurs.surname, conversations.email, conversations.recv, conversations.chats, conversations.date 
                            FROM utilisateurs INNER JOIN conversations ON utilisateurs.email = conversations.email
                            WHERE conversations.email = ? AND conversations.recv = ? OR conversations.email = ? AND conversations.recv = ? 
                            ORDER BY conversations.date";

                            $stmt = $db->createConnection()->prepare($sql);

                            $stmt->execute([ $sender, $recv, $recv, $sender ]);

                            $messages = $stmt->fetchAll();

                            foreach($messages as $message){
                                if($message->recv == $sender){
                                    echo "<p class='chatting'>" . $message->chats . "</p>";
                                    echo "<p class='text-start mb-5'>". substr($message->date,10) ."</p>";
                                }else{
                                    echo "<p class='receiver chatting'>" . $message->chats . "</p>";
                                    echo "<p class='text-end mb-5'>". substr($message->date, 10) ."</p>";
                                }
                            }
                        
                        
                        ?>
                    </div>
                
                </div>
                <!-- end chat Element -->
            
            </div>
            <!-- end of displaying users exchange messages -->

        </div>
        <!-- end chat appearence -->
        <div class="clr"></div>
        <!-- formulaire send message -->
        <form action="../db/sendMessage.php?recv=<?= $_GET['recv']."&name=".$_GET['name']."&surname=".$_GET['surname']."&photo=".$_GET['photo']; ?>" method="post" class="myform" enctype="multipart/form-data">

            <div class="form-group">
                <textarea name="chat" id="message" require></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" id="send" name="submit" value="envoie">
            </div>
            
        </form>   
        <!-- end formulaire send message -->
    </div>
    <!-- <script src="../js/chat.js"></script> -->
</body>
</html>