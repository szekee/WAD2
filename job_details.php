<!DOCTYPE html>

<html>
<header>
    <title>

    </title>
    <style>

    </style>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</header>

<body>
     <!-- Nav Bar -->
     <?php include "nav_bar.php"; ?>
    <?php
        session_start();
        $userid = $_SESSION["userid"];

        $id = $_GET["id"];

        
        include "ConnectionManager.php";
        // connect to database
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        // SQL statement
        $sql = "select * from job where jobid = :id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        // Run SQL Statement
        $stmt->execute();   
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()){
                $id = $row["jobid"];
                $jobName = $row["jobname"];
                $roleRequired = $row["rolerequired"];
                $JobDesc = $row["jobdesc"];
                $image = $row["picturepath"];
                $skills = $row["skills"];
                $startdate = $row["startdate"];
                $enddate = $row["enddate"];
                $address = $row["address"];
                $listingStatus = $row["listingstatus"];
            }
    ?>
    <!-- Adapted From: https://bbbootstrap.com/snippets/bootstrap-5-myprofile-90806631 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <br>
                <h6>For Job Posters<h6>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='get_job.php'">Back to Home</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='view_job.php'">View My Posting</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100">Applied Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='get_job.php'">Back to Home</button>
                
            </div>
            <div class="col-sm-10 mt-3">
    <div class="container bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right  mt-4">
        <img class='img-fluid'src='uploadImage/<?php echo $image ?>'>
        </div>
        <div class="col-md  border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Job Details</h4>
                </div>
                <hr>
                
                <div class="row mt-2">
                    <?php if ($listingStatus == "Open"){?>
                    <div class="col-md"><h5><?php echo $jobName; ?></h5></div><div class="col-md pt-0"><button type="button" class="btn btn-sm btn-outline-primary" onclick="window.location.href='#'">Apply Now</button></div>
                    <?php } ?>
                </div>
                    <?php if ($listingStatus == "Open"){?>
                    <div class="row"><div class="col-md"><p class="mb-0"><strong>Status: </strong> <span class = "text-success"> <?php echo $listingStatus; ?></span></p></div></div>
                    <?php }
                    else{?>
                    <div class="row mt-0"><div class="col-md"><p><strong>Status: </strong> <span class = "text-danger"> <?php echo $listingStatus; ?></span></p></div></div>
                    <?php }?>
                    <div class="row mt-0"><div class="col-md mt-0"><span class="text-muted"><?php echo date("d-M-Y", strtotime($startdate)); ?> - <?php echo date("d-M-Y", strtotime($enddate)); ?></span></div></div>
                
                <div class="row mt-3">
                    <p class="mb-0"><strong>Role: </strong> <?php echo $roleRequired; ?></p>
                </div>
                <div class="row mt-3">
                    <p class="mb-0"><strong>Location: </strong><?php echo $address; ?></p>
                </div>
                <div class="row mt-3">
                    <p class="mb-0"><strong>Job Descripion: </strong> <br><?php echo $JobDesc; ?></p>
                </div>
                <div class="row mt-3">
                    <p class="mb-0"><strong>Skills: </strong> <br><?php echo $skills; ?></p>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
</div>




    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>