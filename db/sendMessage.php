<?php

    include_once "../pages/menu.php";
    include_once "create.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){


        if(isset($_POST['submit'])){
            
            $send_message = new insertData();

            $sender = $_SESSION['email'];

            $recv = $_GET['recv'];

            $msg = htmlspecialchars($_POST['chat']);

            $date = date("Y-m-d H:i:s");

            $send_message->messaging($sender, $recv, $msg, $date);

            header("Location:../pages/chat.php?recv=".$_GET['recv']."&name=".$_GET['name']."&surname=".$_GET['surname']."&photo=".$_GET['photo']);
            exit();

        }
    }

?>