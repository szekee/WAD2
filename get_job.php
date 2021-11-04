<!doctype html>

<html>
    <head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <?php include "nav_bar.php"; 
    session_start();
    $userid = $_SESSION["userid"];
    
    ?>
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
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='add_job.php'">Post a Job</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='view_job.php'">View My Posting</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Applied Jobs</button>
                
            </div>
            <div class="col-sm-10">
                <div class="container">
                <h1 class='display-4 text-center fw-light'>Recent Postings</h1>
                    <div class="row">
                        <div class="col float-end">
                            <a href="side_bar.php" class="float-end mb-2 mt-3" style='color:black;'>View More </a>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" >
                    <?php

                   


                        include "ConnectionManager.php";
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
                                    // Get Details
                                    $image = $row["picturepath"];
                                    $id = $row["jobid"];
                                    $jobName = $row["jobname"];
                                    $address = $row["address"];
                                    $roleRequired = $row["rolerequired"];
                                    $createDate = $row["createdate"];
                                    // $imagePath = "uploadImage/".$image;
                                    // echo "<img src='uploadImage/". $image."' width=50%>";
                                    ?>
                                        <div class="col-sm">
                                        <div class="card shadow-sm" id="<?php echo $id?>" onclick="getDetails(this.id)">
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
                            <a href="side_bar.php" class="float-end mb-5 mt-2" style='color:black;'>View More </a>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <script>
            function getDetails(id){
                window.location.href='job_details.php?id='+id;
            }
        </script>                       
                <!-- // Bootstrap  -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        
    </body>
</html>