<?php
    include_once "../pages/menu.php";
    include_once "create.php";

    $delete = new insertData();

    echo $_SESSION['email'];

    $email = $_SESSION['email'];

    $delete->deleteUser($email);

    $ext = '../';
    $file = 'index.php';
    header('Location:'.$ext . $file);
    exit();


?>