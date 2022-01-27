
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
  <title>INTRANET</title>
</head>
<body>

    <?php 
    
        include "menu.php";
        include_once "../db/connection.php";   

    ?>

    <div id="offset">

        <div class="container mt-4">
            <div class="narrow">

                <div class="row px-2">
                    
                    <!-- <p class="text-center text-dark fs-2 fw-bold my-2"><?php echo $_SESSION['name'];?></p> -->

                    <!--people online and ads-->
                    <div class="col-lg-2 col-md-2 col-xs-0 col-0"></div>
                    <!--end people online and ads -->


                    <!--publications-->
                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">

                        <div class="row mt-5">

                            <!--formulaire de publications-->
                            <form action="../db/publication.php" method="post" class="d-flex p-3 justify-content-center align-center ms-auto" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <div class="card border-0">
                                        <div class="card-body row g-3 align-middle">

                                            <div class="col-auto">
                                                <textarea name="commentaire" id="commentaire" cols="50" rows="5" class="form-control" placeholder="Quoi de neuf?"></textarea>
                                            </div>

                                            <div class="col-auto">
                                                <img src="../photo/app/imageholder.png" alt="" onclick="triggerclick()" id="profileDisplay" height="100px" width="100px">
                                                <input type="file" name="upload" id="profileImage" onchange="displayImage(this)" class="form-control" style="display:none;">
                                            </div>

                                            <div class="col-auto">
                                                <input type="submit" name="submit" value="Publier" class="btn btn-success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                            </form>
                            <!--end formulaire de publications-->

                        </div>


                        <!--Photo publications-->
                        <div class="row ">
                            <?php
                                if(!empty($_GET['post'])){
                                    echo "<div class='alert alert-success text-center alert-dismissible fade show' role='alert'>";
                                    echo $_GET['post'];
                                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                                    echo "</div>";
                                }else{
                                    echo "";
                                }
                            ?>
                            <?php
                                $conn = new DBconnection();

                                $sql = "SELECT utilisateurs.name, utilisateurs.email, utilisateurs.profession, utilisateurs.surname, utilisateurs.photo, posts.user_picture, posts.comment, posts.date 
                                FROM utilisateurs INNER JOIN posts ON utilisateurs.email = posts.email ORDER BY posts.date DESC";

                                $stmt = $conn->createConnection()->prepare($sql);

                                $stmt->execute();

                                $rows = $stmt->fetchAll();

                                foreach($rows as $row){
                                    // début d'affiche photo
                                    echo "<div class='card mb-3'  style='max-height: 600px;'>";
                                    // card-header
                                    echo "<div class='card-header bg-white'>";

                                    
                                    // user photo and names
                                    echo "<a href='userInfo.php?name=$row->name&amp;surname=$row->surname&photo=$row->photo&email=$row->email&prof=$row->profession' class='text-decoration-none text-dark'>";
                                    
                                    // user picture header
                                    echo "<div class='row g-2'>";
                                    echo "<div class='col-auto'>";
                                    echo "<img src='../photo/profile/$row->photo' class='rounded-circle' height='50px' width='50px' >";
                                    echo "</div>";

                                    echo "<div class='col-auto'>";
                                    echo "<p class='fw-bold'>".strtoupper($row->name) ." ". strtoupper($row->surname)."</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    // end user picture header
                                    echo "</div>"; 
                                    // end card-header

                                    
                                    echo "</a>";
                                    // end user photo and names

                                    echo "<img src='../photo/posts/$row->user_picture' height='250px'>";
                                    // card body
                                    echo "<div class='card-body'>";
                                    if(strlen($row->comment) >= 250){
                                        echo "<p class='card-text text-start'>" . substr($row->comment, 0, 250 ). " <a href='moreinfo.php?name=$row->name&surname=$row->surname&photo=$row->photo&pub=$row->user_picture&date=$row->date&email=$row->email' class='text-decoration-none'>Lire la suite...</a> </p>";
                                        echo "<p class='card-text text-end'> Publié le " . substr($row->date, 0, 10) ." à ". substr($row->date, 10) ."</p>";

                                    }else{
                                        echo "<p class='card-text text-start'>" . $row->comment . "</p>";
                                        echo "<p class='card-text text-end'> Publié le " . substr($row->date, 0, 10) ." à ". substr($row->date, 10) . "</p>";

                                    }
                                    echo "</div>";
                                    // end card body
                                    echo "</div>";
                                    // end affiche photo
                                }
                             ?>
                        </div>
                        <!--end Photo publications-->




                    </div>
                    <!--end publications-->

                    <!--people online and ads-->
                    <div class="col-lg-4 col-md-4 col-xs-0 col-0 mt-5 px-5">
                        <!--announcement-->
                        <div class="row my-4" style="max-height: 350px">
                            <div class="card border-0 shadow-lg annonce">
                                <div class="card-header">
                                    Annonce
                                </div>

                                <div class="card-body">
                                    <p class="card-text fs-3 fw-bold">Ici se trouve tous les annonces</p>
                                </div>

                            </div>
                        </div>
                        <!--end announcement-->

                        <!--People online-->
                        <!-- <div class="row mb-5" style="max-height: 350px">
                            <div class="card border-0 shadow-lg">
                                <div class="card-header">
                                    En Ligne
                                </div>

                                <div class="card-body">
                                    <p class="card-text fs-3 fw-bold">Ici se trouve tous les annonces</p>
                                </div>

                            </div>
                        </div> -->
                        <!--end People online-->
                    </div>
                    <!--end people online and ads -->
                </div>


            </div>
        </div>



    </div>
    

    <script src="../js/profile.js"></script>

</body>
</html>