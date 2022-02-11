<?php include "nav_bar.php"; ?>
<!DOCTYPE html>
<?php include "ConnectionManager.php"; ?>   
<html>
<head>

    <title>

    </title>
    <style>

    </style>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<!-- firstly = Select * from applylisting where jobid= 1
secondly = select * from user where userid = 2
thrid = select * from profile where userid=2
fourth = update applylisting where jobid = 1, userid = 1 -->
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
            <?php if (isset($_GET['updateStatus'])){
                    if ($_GET['updateStatus']  == "successful"){
                        echo "<div class='alert alert-success' role='alert'>
                        Application status updated successfully!
                        </div>";
                    }
                    else{
                        echo "<div class='alert alert-danger' role='alert'>
                        Updating Status failed. Please try again.
                        </div>";
                    }
                }?>
                <div class="container">
                    <div class="row">
                    <?php
                        $id = $_GET["id"];

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
                                    <div class="mb-3 mt-3">
                                        <div class="row g-0">
                                            <div class="col-md-3">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <?php echo "<img class='img-fluid rounded-start'src='uploadImage/". $image."'>"; ?>
                                            </div>
                                            <div class="col-md-9">
                                            <div class="m-5">
                                                <h5><?php echo $jobName ?></h5>
                                                <p class="mb-0"><small class="text-muted"><strong>From</strong> <?php echo date("d-M-Y", strtotime($startdate)); ?> <strong>to</strong> <?php echo date("d-M-Y", strtotime($enddate)); ?> </small></p>
                                                <p class="mt-0"><small class="text-muted"><strong> Location: </strong> <?php echo $address; ?></small></p>
                                                <p class="m-1"><strong>Role Required:</strong> <?php echo $roleRequired; ?></p>
                                                <p class="m-1"><strong>Job Description: </strong><br><?php echo $JobDesc; ?></p>
                                                <p class="m-1"><strong>Skills Required: </strong><?php echo $skills; ?></p>
                                                
                                                <p><small class="text-muted">Job posted on <?php echo date("d-M-Y", strtotime($postedDate)); ?></small></p>
                                                <?php
                                                    if ($listingStatus == "Open"){
                                                        echo "<p><small class='text-success'>" . $listingStatus ."</small></p>";
                                                    }
                                                    else{
                                                        echo "<p><small class='text-danger'>" . $listingStatus ."</small></p>";
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
                    <h4 class='display-6 fw-light'>All Applications</h4>
                    <div class="row">
                        <!-- Accordion adapted From: https://getbootstrap.com/docs/5.0/components/accordion/ -->
                        <div class="accordion mb-5 mt-3">
                    <?php
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();
                         // SQL statement
                         $sql = "Select * from applylisting inner join user on user.userid = applylisting.userid inner join profile on profile.userid = user.userid where jobid = :id";
                         $stmt=$pdo->prepare($sql);
                         $stmt->bindParam(':id', $id);
 
                         // Run SQL Statement
                         $stmt->execute();   
                         $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                 while($row = $stmt->fetch()){
                                     // Get Details
                                     $userid = $row["userid"];
                                     $applicationstatus = $row["applicationstatus"];
                                     $applydate = $row["applydate"];
                                     $applyid = $row["applyid"];
                                     
                                    // Get Details
                                    $username = $row["name"];
                                    $gender = $row["gender"];
                                    $email = $row["email"];
                                    $phone= $row["phone"];
                                    $skills = $row["skills"];
                                    $bio = $row["bio"];
                                    $portfolio_link = $row["portfoliolink"];
                                    $portfolio = $row["portfoliopath"];
                                    $profilepic = $row["profilepic"];
                                    
                                    if ($gender == "F"){
                                        $gender = "Female";
                                    }
                                    if ($gender == "M"){
                                        $gender = "Male";
                                    }
                                    
                               ?>
                   
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="<?php echo $userid?>">
                                    
                                    <div class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#user<?php echo $userid;?>" aria-expanded="false" aria-controls="user<?php echo $userid;?>">
                                        <img src="uploadImage/<?php echo $profilepic; ?>" class="rounded" width="10%">
                                        <span class="mr-2">&nbsp;&nbsp;Name: <?php echo $username ?> <br>
                                        &nbsp;&nbsp;Gender: <?php echo $gender ?> <br>
                                        &nbsp;&nbsp;Email: <a href="mailto: <?php echo $email ?>"><?php echo $email ?><a><br>
                                        &nbsp;&nbsp;Phone: <?php echo $phone ?></span>
                                </div>
                                    </h2>
                                    <div id="user<?php echo $userid;?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $userid;?>" >
                                    
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <ul>
                                                    <li><strong>Bio:</strong> <?php echo $bio; ?></li>
                                                    <li><strong>Skills:</strong> <?php echo $skills; ?></li>
                                                    <li><strong>View <a href = 'http://<?php echo $portfolio_link;?>' target="_blank">Porfolio</a> </strong> </li>
                                                    <!--<li><strong>Download Porfolio: </strong><?php echo $portfolio; ?> </strong></li>-->
                                                    <li><strong>Application Status: </strong><?php echo $applicationstatus; ?> </strong></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <form method="post">
                                                    <div class="input-group">
                                                    <input type="hidden" name="applyid" value="<?php echo $applyid?>">
                                                        <select name="status" class="form-select">
                                                            <?php
                                                            $submitted = "";    
                                                            $rejected = "";
                                                            $accepted = "";
                                                                if ($applicationstatus == "Submitted"){
                                                                    $submitted = "selected";
                                                                }
                                                                elseif ($applicationstatus == "Rejected"){
                                                                    $rejected = "selected";
                                                                }
                                                                elseif ($applicationstatus == "Accepted"){
                                                                    $accepted = "selected";
                                                                }
                                                            
                                                            ?>
                                                            <option value="Submitted" disabled <?php echo $submitted; ?>>Submitted</option>
                                                            <option value="Rejected" <?php echo $rejected; ?>>Reject</option>
                                                            <option value="Accepted" <?php echo $accepted; ?>>Accept</option>
                                                        </select> 
                                                        <button class="btn btn-outline-secondary" name="update" id="<?php echo $applyid?>" type="submit">Update</button>
                                                        
                                                    </div>
                                                </form>
                                                <?php 
                                                    // var_dump($applyid);
                                                    // var_dump($status);                                                      
                                                    include "update_apply_status.php";
                                                    ?>
                                            </div>  
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            
    
                        <?php }      
                        # Free up resources
                        $stmt = null;
                        $pdo = null;
                    ?>
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
