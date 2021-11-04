
<!DOCTYPE html>
<?php include "ConnectionManager.php"; ?>
<html>
<header>
    
    <title>

    </title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        
    </style>
</header>

<body>
    <?php 
    session_start();
    $userid = $_SESSION["userid"];
    include "nav_bar.php"; ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" style="border-right: 1px solid black">
                <br>
                <h6>For Job Posters<h6>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='add_job.php'">Post a Job</button>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='get_job.php'">Back to Home</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Applied Jobs</button>
                
            </div>
            <div class="col-sm-10">
                <h1 class='display-4 text-center fw-light'>My Postings</h1>
                    <?php
                    // Adapted From: https://getbootstrap.com/docs/5.0/components/alerts/
                        if (isset($_GET['delete'])){
                            if ($_GET['delete']  == "successful"){
                                echo "<div class='alert alert-success' role='alert'>
                                You have deleted a job successfully!
                              </div>";
                            }
                            else{
                                echo "<div class='alert alert-danger' role='alert'>
                                Deleting Job failed. Please try again.
                              </div>";
                            }
                        }
                        if (isset($_GET['update'])){
                            if ($_GET['update']  == "successful"){
                                echo "<div class='alert alert-success' role='alert'>
                                You have updated a job successfully!
                              </div>";
                            }
                            else{
                                echo "<div class='alert alert-danger' role='alert'>
                                Updating Job failed. Please try again.
                              </div>";
                            }
                        }
                       
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();

                        // SQL statement
                        $sql = "select * from job where createuserid = :userid";
                        $stmt=$pdo->prepare($sql);
                        $stmt->bindParam(':userid', $userid);

                        // Run SQL Statement
                        $stmt->execute();   
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                while($row = $stmt->fetch()){
                                    // Get Details
                                    $id = $row["jobid"];
                                    $jobName = $row["jobname"];
                                    $roleRequired = $row["rolerequired"];
                                    $JobDesc = $row["jobdesc"];
                                    $image = $row["picturepath"];
                                    $skills = $row["skills"];
                                    $startdate = $row["startdate"];
                                    $enddate = $row["enddate"];
                                    $address = $row["address"];
                                    $postedDate = $row["createdate"];
                                    $listingStatus = $row["listingstatus"];
                                    // $imagePath = "uploadImage/".$image;
                                    // echo "<img src='uploadImage/". $image."' width=50%>";
                                    
                                    ?>
                                    <!-- Adapted From: https://getbootstrap.com/docs/5.0/components/card/#horizontal -->
                                    <div class="card mb-3 mt-3" style="max-width: 900px; margin:auto">
                                        <div class="row g-0">
                                            <div class="col-md-3">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <?php echo "<img style='height:100%' class='img-fluid rounded-start'src='uploadImage/". $image."'>"; ?>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $jobName ?></h5>
                                                <p class="card-text mb-0"><small class="text-muted"><strong>From</strong> <?php echo date("d-M-Y", strtotime($startdate)); ?> <strong>to</strong> <?php echo date("d-M-Y", strtotime($enddate)); ?> </small></p>
                                                <p class="card-text mt-0"><small class="text-muted"><strong> Location: </strong> <?php echo $address; ?></small></p>
                                                <p class="card-text m-1"><strong>Role Required:</strong> <?php echo $roleRequired; ?></p>
                                                <p class="card-text m-1"><strong>Job Description: </strong><br><?php echo $JobDesc; ?></p>
                                                <p class="card-text m-1"><strong>Skills Required: </strong><?php echo $skills; ?></p>
                                                <button type="button" class="btn btn-sm btn-outline-secondary  mt-2" id="<?php echo $id?>" onclick="view(this.id)">View Applications</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary  mt-2" id="<?php echo $id?>" onclick="update_job(this.id)">Update Job</button>
                                                <input type="hidden" value="<?php echo $id?>">
                                                <button type="button" class="btn btn-sm btn-outline-danger  mt-2" id="<?php echo $id?>" onclick="delete_job(this.id)">Delete Job</button>
                                                <p class="card-text"><small class="text-muted">Job posted on <?php echo date("d-M-Y", strtotime($postedDate)); ?></small></p>
                                                <?php
                                                    if ($listingStatus == "Open"){
                                                        echo "<p class='card-text'><small class='text-success'>" . $listingStatus ."</small></p>";
                                                    }
                                                    else{
                                                        echo "<p class='card-text'><small class='text-danger'>" . $listingStatus ."</small></p>";
                                                    }
                                                ?>
                                                
                                            </div>
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
                </div> 
            </div>
        </div>
    
    <script>
        // Delete Job from Job Listing
        function delete_job(id){
            console.log("Deleted")
            console.log(id);
            var ans = confirm("Are you sure you want to delete the job?")
            if (ans){
                window.location.href='delete_job.php?id='+id;
            }
        }
        // Updating Job Listing
        function update_job(id){
            
                window.location.href='update_job.php?id='+id;
            
        }
        function view(id){
            
            window.location.href='viewApplication.php?id='+id;
        
        }
    </script>

    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>


