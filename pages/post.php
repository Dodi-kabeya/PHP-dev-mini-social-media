<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="#" method="post" enctype="multipart/form-data">

        <!--static profile modale-->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Poster</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-2">
                    
                        <div class="col-auto">
                            <!--Image du profile-->
                            <img src="../photo/app/imageholder.png" alt="user profile" id="imageholder"  height="160px" width="160px">
                            <!--end Image du profile-->
                            <!--Input du profile-->
                            <input type="file" name="profile" id="profile" onChange="displayImage(this)" style="display: none;">
                            <!--end Input du profile--> 
                        </div>
                        <div class="col-auto">
                            <textarea name="formulaire" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="post" class="btn btn-primary">
                </div>
                </div>
            </div>
        </div>
        <!--end static profile modale -->

    </form>


</body>
</html>