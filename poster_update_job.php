<?php include "nav_bar.php";?>
<!DOCTYPE html>
<?php 

    include "ConnectionManager.php"; 

?>

<html>
<head>
    
    <title>

    </title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        
    </style>
</head>

<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <br>
                <h6>For Job Posters<h6>
                <button type="button" class="btn btn-lg btn-outline-secondary mt-2 w-100" onclick="window.location.href='poster_add_job.php'">Post a Job</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='poster_postings.php'">My Postings</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_liked.php'">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_applied.php'">Applied Jobs</button>
            </div>
            <div class="col-md-10">
                <h1 class='display-4 text-center fw-light'>Update Posting</h1>
                <div class="container">
                <form action='' method='post'>
                    <?php

                        $id = $_GET["id"];
                        
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();

                        // SQL statement
                        $sql = "select * from job where jobid=:id";
                        $stmt=$pdo->prepare($sql);
                        $stmt->bindParam(':id', $id);

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
                                    $listingStatus = $row["listingstatus"];
                                    
                                    ?>
                                    
                                    <div class="row" >
                                        <div class="col-5"></div>
                                        <div class="col">
                                    <?php
                                        echo "<img class='img-fluid rounded-start' src='uploadImage/". $image."' >"; 
                                    ?>
                                        </div>
                                        <div class="col-5"></div>
                                    </div>
                                    <div class="row">
                                    
                                    
                                    <div class='mb-3'>
                                        <label for='jobName' class='form-label'>Job Name</label>
                                        <input type='text' name ='jobName' class='form-control' id='jobName' value='<?php echo $jobName;?>'>   
                                    </div> 
                                  
                                    <div class='mb-3'>
                                        <label for='role' class='form-label'>Role Required</label>
                                        <input type='text' name ='role' class='form-control' id='role' value='<?php echo $roleRequired;?>'>   
                                    </div>
                                    <div class='mb-3'>
                                        <label for='jobDesc' class='form-label'>Job Description</label>
                                        <textarea class="form-control" name="jobDesc" id="jobDesc" rows="6"><?php echo $JobDesc;?></textarea>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='skills' class='form-label'>Skills</label>
                                        <input type='text' name ='skills' class='form-control' id='skills' value='<?php echo $skills;?>'>   
                                    </div>
                                    <div class='mb-3'>
                                        <label for='sDate' class='form-label'>Start Date</label>
                                        <input type='date' name = 'sDate' class='form-control' id='sDate' value='<?php echo $startdate;?>'>   
                                    </div>
                                    <div class='mb-3'>
                                        <label for='eDate' class='form-label'>End Date</label>
                                        <input type='date' name = 'eDate' class='form-control' id='eDate' value='<?php echo $enddate;?>'>   
                                    </div>
                                    <div class='mb-3'>
                                        <label for='address' class='form-label'>Address</label>
                                        <input type='text' name = 'address' class='form-control' id='address' value='<?php echo $address;?>'>   
                                    </div>
                                    
                                    <?php 
                                    if ($listingStatus == "Open"){
                                        $isOpen = "selected";
                                    }
                                    else{
                                        $isOpen = "";
                                    }
                                    if ($listingStatus == "Closed"){
                                        $isClosed = "selected";
                                    }
                                    else{
                                        $isClosed = "";
                                    }
                                    ?>
                                    <div class='mb-3'>
                                        <label for='status' class='form-label'>Job Status</label>
                                        <select class='form-select' name = 'listingStatus' value='<?php echo $listingStatus;?>'>
                                            <option value='Open' <?php echo $isOpen;?>> Open </option>
                                            <option value = 'Closed' <?php echo $isClosed;?>> Closed </option>
                                        </select>   
                                    </div>
                                    
                                    
                                    <input type='submit' class='btn btn-primary mb-3' name='Submit'>
                                    
                                    </div> 
                                
                                <?php
                                }
                                # Free up resources
                                $stmt = null;
                                $pdo = null;
                    ?>

                    <?php
                    if (isset($_POST["Submit"])){
                        $jobName = $_POST["jobName"];
                        $roleRequired = $_POST["role"];
                        $JobDesc = $_POST["jobDesc"];
                        $skills = $_POST["skills"];
                        $startdate = $_POST["sDate"];
                        $enddate = $_POST["eDate"];
                        $address = $_POST["address"];
                        $listingStatus = $_POST["listingStatus"];
                        
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();


                        // SQL Statement
                        $update_sql = "update job set jobname=:jobName, jobdesc=:JobDesc, rolerequired=:roleRequired, skills =:skills, startdate =:startDate,enddate=:endDate, address=:address, listingstatus = :listingStatus where jobid=:id";
                        $stmt = $pdo->prepare($update_sql);
                        $stmt->bindParam(':jobName', $jobName);
                        $stmt->bindParam(':roleRequired', $roleRequired);
                        $stmt->bindParam(':JobDesc', $JobDesc);
                        $stmt->bindParam(':skills', $skills);
                        $stmt->bindParam(':startDate', $startdate);
                        $stmt->bindParam(':endDate', $enddate);
                        $stmt->bindParam(':address', $address);
                        $stmt->bindParam(':listingStatus', $listingStatus);
                        $stmt->bindParam(':id', $id);

                        // Run SQL

                        $stmt->execute();

                        if ($stmt->execute()){
                            // header('Location: poster_postings.php?update=successful');
                            echo("<script>location.href = 'poster_postings.php?update=successful';</script>");
                        }
                        else{
                            // header('Location: poster_postings.php?update=unsuccessful');
                            echo("<script>location.href = 'poster_postings.php?update=unsuccessful';</script>");
                              
                        }

                        # Free up resources
                        $stmt = null;
                        $pdo = null;
                    }
                    ?>
                        <!-- </div>
                    </div> -->
                    </form>
                </div> 
            </div>
        </div>
    
    

    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>


