<?php include "nav_bar.php"; 
?>

<?php include "./ConnectionManager.php"; ?>   


<!doctype html>

<!-- this file is for the home page -->

<html>
    <head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <style>
        #map {
        height: 400px;
        width: 100%;
      }
    </style>

    <body>


    <!-- Adapted From: https://getbootstrap.com/docs/5.1/examples/album -->

    <div class="container-fluid">
        <?php 
        // Adapted From: https://getbootstrap.com/docs/5.0/components/alerts/
         if (isset($_GET['add'])){
            if ($_GET['add'] == "successful"){
                echo "<div class='alert alert-success' role='alert'>
                You have created a job successfully!
            </div>";
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>
                Creating Job failed. Please try again.
            </div>";
            }
        }
        ?>

        <div class="row">
        <div class="col-sm">
                <br>
                <h6>For Job Posters<h6>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100 " onclick="window.location.href='poster_add_job.php'">Post a Job</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='poster_postings.php'">My Postings</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_liked.php'">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_applied.php'">Applied Jobs</button>
            </div>
            <div class="col-sm-10">
                <br>
                <br>
                <div class="container">
                    
                    <!-- google map api -->
                    <h1 class='display-4 text-center fw-light'>Jobs across Singapore</h1>
                    <div id="map"></div>
                    <script
                    defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGdgfbpfzPWvgFcl3T4Cp5wWalYzbwNKc&callback=initMap"
                    ></script>
                    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                    <script src="googlemapsapi.js"></script>


                </div>
                <br>
                <br>

                <h1 class='display-4 text-center fw-light'>Recent Postings</h1>
                    <div class="row">
                        <div class="col float-end">
                            <a href="side_bar.php?id=1" class="float-end mb-2 mt-3" style='color:black;'>View More </a>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" >
                    <?php
                        // php statement to connect to database
                        // retrieve job information
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();

                        // SQL statement
                        $sql = "select * from job ORDER BY jobid DESC LIMIT 8";
                        $stmt=$pdo->prepare($sql);

                        // Run SQL Statement
                        $stmt->execute();   
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                while($row = $stmt->fetch()){
                                    // Get Details and assign to new variables.
                                    // this is a while loop
                                    $image = $row["picturepath"];
                                    $id = $row["jobid"];
                                    $jobName = $row["jobname"];
                                    $address = $row["address"];
                                    $roleRequired = $row["rolerequired"];
                                    $createDate = $row["createdate"];
                                    // $imagePath = "uploadImage/".$image;
                                    // echo "<img src='uploadImage/". $image."' width=50%>";
                                    ?>

                                        <!-- while still in while loop, create a card for each job --> 
                                        <div class="col-sm">
                                        <div class="card shadow-sm" style="height: 700px; overflow: hidden;" id="<?php echo $id?>" onclick="getDetails(this.id)"> <!-- clicking this shadow brings to side bar page for that specific job id. -->
                                        

                                            <?php echo "<img class='img-fluid'src='uploadImage/". $image."'>"; ?>

                                            <div class="card-body">
                                            <h5 class="card-title"><?php echo $jobName ?></h5>  
                                            <p class="card-text mt-0"><small class="text-muted"><?php echo $address; ?></small></p>
                                            
                                            <p class="card-text"><strong>Role:</strong> <?php echo $roleRequired; ?></p>
                                            <small class="text-muted">Job Created: <?php echo date("d-M-Y", strtotime($createDate));?></small>
                                            </div>
                                        </div>
                                        </div>
                                    <?php
                                }
                                # Free up resources
                                $stmt = null;
                                $pdo = null;
                    ?>
                
                        </div>
                        <div class="row">
                        <div class="col float-end">
                            <a href="side_bar.php?id=1" class="float-end mb-5 mt-2" style='color:black;'>View More </a>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <script>
            // javascript function to get details
            function getDetails(id){
                window.location.href='side_bar.php?id='+id;
                // e.g id is 123, this function will 
                //  window.location.href = 'job_details.php?id=123'
                // go to jobdetails.php
            }
        </script>                       
                <!-- // Bootstrap  -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        
    </body>
</html>
