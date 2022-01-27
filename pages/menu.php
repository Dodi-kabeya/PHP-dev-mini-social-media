<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/menu.css">
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   
    <title>menu</title>
</head>
<body>

            
    <ul class="navigation">
        <li>
            <a href="./home.php">
                <img src="../photo/app/app.png" width="80px" height="80px" alt="enrgbat" class="img-fluid">
            </a>
        </li>
        <li>
            <a href="./message.php">
                <i class="far fa-comments fa-2x position-relative">
                    <span class="position-absolute top-50 start-100 translate-middle p-2 bg-danger border border-white rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </i>
                <!-- <span class="position-absolute top-10  translate-middle badge bg-primary">new</span> -->
            </a>
        </li>

        <li>
            <a href="./recherche.php">
                <i class="fas fa-search fa-2x"></i>
            </a>
        </li>

        <li>
            <a href="./profile.php">
                <i class="fas fa-user fa-2x"></i>
            </a>
        </li>

        <li>
            <a href="./settings.php">
                <i class="fas fa-user-cog fa-2x"></i>
            </a>
        </li>

        <li>
            <a href="logout.php">
                <i class="fas fa-power-off fa-2x"></i>
            </a>
        </li>

        
    </ul>


    
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>