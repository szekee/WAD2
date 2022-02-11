<?php include "nav_bar.php"; ?>
<!DOCTYPE html>
<?php include "ConnectionManager.php"; ?>
<html>
<header>

    
    <title>

    </title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .content {
            padding: 0 0px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            }
        .liked {
            background-color: #FF7F7F;
            color: white;
            outline-color: #FF7F7F;
            outline-width : thin ;
            outline-style : solid ;
            }

        .liked:hover{
            background-color: white;
            color: #FF7F7F;
            outline-color: #FF7F7F;
            outline-width : thin ;
            outline-style : solid ;
        }
        .like {
            background-color: white;
            color: #FF7F7F;
            outline-color: #FF7F7F;
            outline-width : thin ;
            outline-style : solid ;
        }

        .like:hover{
            background-color: #FF7F7F;
            color: white;
            outline-color: #FF7F7F;
            outline-width : thin ;
            outline-style : solid ;
        }
    </style>
</header>

<body>
    

    <?php 
        // Adapted From: https://getbootstrap.com/docs/5.0/components/alerts/
        if (isset($_GET['apply'])){
            if ($_GET['apply'] == "successful"){
                echo "<div class='alert alert-success' role='alert'>
                Your application has been sent!
            </div>";
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>
                Application failed. Please try again!
            </div>";
            }
        }
        /*
        if (isset($_GET['like'])){
            if ($_GET['like'] == "successful"){
                echo "<div class='alert alert-success' role='alert'>
                Liked!
            </div>";
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>
                Like failed.
            </div>";
            }
        }

        if (isset($_GET['unlike'])){
            if ($_GET['unlike'] == "successful"){
                echo "<div class='alert alert-success' role='alert'>
                Unliked!
            </div>";
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>
                Unlike failed.
            </div>";
            }
        }
        */
    ?>
    
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
                <button type="button" class="btn btn-lg btn-secondary disabled mt-2 w-100" onclick="window.location.href='seeker_applied.php'">Applied Jobs</button>
            </div>
            <div class="col-sm-10">
                <h1 class='display-4 text-center fw-light'>My Applied Jobs</h1>
                    <?php
                        // connect to database
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();
                        
                        // SQL statement
                        $sql = "select job.jobid,job.jobname,job.rolerequired,job.jobdesc,job.picturepath,job.skills,job.startdate,job.enddate,job.address,job.createdate,job.listingstatus,applylisting.applydate,applylisting.applicationstatus,likelisting.is_liked from job inner join applylisting on applylisting.jobid=job.jobid and applylisting.userid=:userid left join likelisting on applylisting.jobid=likelisting.jobid and likelisting.userid=:userid";
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
                                    $applydate = $row["applydate"];
                                    $applicationstatus = $row["applicationstatus"];
                                    $isliked = $row["is_liked"];

                                    // $imagePath = "uploadImage/".$image;
                                    // echo "<img src='uploadImage/". $image."' width=50%>";

                                    ?>
                                    
                                    <!-- Adapted From: https://getbootstrap.com/docs/5.0/components/card/#horizontal -->
                                    <div class="card mb-3 mt-3 lh-tight active" style="max-width: 900px; margin:auto"  id="<?php echo $id?>" onclick="getDetails(this.id)">
                                        <div class="row g-0">
                                            <div class="col-md-3">
                                            <?php echo "<img class='img-fluid rounded-start' style='width:100%,height:auto,object-fit' src='uploadImage/". $image."'>"; ?>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $jobName ?></h5>
                                                <p class="card-text mb-0"><small class="text-muted"><strong>From</strong> <?php echo date("d-M-Y", strtotime($startdate)); ?> <strong>to</strong> <?php echo date("d-M-Y", strtotime($enddate)); ?> </small></p>
                                                <p class="card-text mt-0"><small class="text-muted"><strong> Location: </strong> <?php echo $address; ?></small></p>
                                                <p class="card-text m-1"><strong>Role Required:</strong> <?php echo $roleRequired; ?></p>
                                                <p class="card-text m-1"><strong>Job Description: </strong><br><?php echo $JobDesc; ?></p>
                                                <p class="card-text m-1"><strong>Skills Required: </strong><?php echo $skills; ?></p>
                                                <p class="card-text text"><small class="text-muted">Job posted on <?php echo date("d-M-Y", strtotime($postedDate)); ?></small></p>

                                                <!-- listing status -->
                                                <?php
                                                    if ($listingStatus == "Open"){
                                                        echo "<p class='card-text'><small class='text-success'>" . $listingStatus ."</small></p>";
                                                    }
                                                    else{
                                                        echo "<p class='card-text'><small class='text-danger'>" . $listingStatus ."</small></p>";
                                                    }
                                                ?>
                                                
                                                <!-- application -->
                                                <?php
                                                    if (isset($applydate)){
                                                        echo "<button type='button' class='btn btn-success w-30 disabled' style ='margin-right: 10px' onclick = 'event.stopPropagation()'>Applied</button>";
                                                        echo "<button type='button' class='btn btn-outline-primary w-30 collapsible' onclick = 'event.stopPropagation()'>View Application Details</button>";
                                                        echo "<div class='content'>";
                                                        echo "<br>";
                                                        if ($applicationstatus == "accepted"){
                                                            echo "<p class='card-text application-details'><strong> Application Status: </strong><small class='text-success'>". $applicationstatus . "</small></p>";
                                                        }
                                                        else{
                                                            echo "<p class='card-text application-details'><strong> Application Status: </strong><small class='text-warning'>". $applicationstatus . "</small></p>";
                                                        }
                                                        echo "<p class = 'card-text application-details'><strong>Date Applied :</strong> " . $applydate ."</p>";
                                                        echo "</div>";
                                                    } else {
                                                        if ($listingStatus == "open"){
                                                            echo "<button type='button' class='btn btn-outline-success w-30' id='".$id."'onclick='event.stopPropagation();confirmapply(this.id);'>Apply Now</button>";
                                                        }
                                                        else{
                                                            echo "<button type='button' class='btn btn-danger w-30 disabled' onclick='event.stopPropagation()'>No longer accepting applications</button";
                                                        }
                                                    }
                                                ?>
                                                <!-- liked -->
                                                <div style = "position:absolute;top:5px;right:10px">
                                                <?php 
                                                    if ($isliked == 1){
                                                        echo "<button class='btn mt-2 w-30 liked' onclick='event.stopPropagation();Buttontoggle(".$id.");' id='like".$id."'>♥ Liked</button>";
                                                    } else {
                                                        echo "<button class='btn mt-2 w-30 like' onclick='event.stopPropagation();Buttontoggle(".$id.");' id='like".$id."'>♥ Like</button>";
                                                    }
                                                ?>
                                                </div>   
                                                                            
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                      
                                    <?php
                                }
                                # Step 5: Free up resources
                                $stmt = null;
                                $pdo = null;
                    ?>
                        
                    </div>
                </div> 
            </div>
        </div>

    <!-- Bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script>
        // Collapsible javascript
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
            content.style.maxHeight = null;
            } else {
            content.style.maxHeight = content.scrollHeight + "px";
            } 
        });
        }

        // Click card to go to side bar
        function getDetails(id){
            window.location.href='side_bar.php?id='+id;
                // e.g id is 123, this function will 
                //  window.location.href = 'job_details.php?id=123'
                // go to jobdetails.php
            }

        // To like and unlike a job
        function Buttontoggle(id){
            var t = document.getElementById("like"+id);
            if(t.innerHTML=="♥ Like"){
                t.innerHTML="♥ Liked";
                t.classList.remove("like");
                t.classList.add("liked");
                window.location.href='add_like.php?backto=seeker_applied.php&id='+id;

            }
            else{
                t.innerHTML="♥ Like";
                t.classList.remove("liked");
                t.classList.add("like");                
                window.location.href='delete_like.php?backto=seeker_applied.php&id='+id;
                }
            }

        // Apply for a job
        function confirmapply(id) {
            var r = confirm("Confirm your application. \r\nYour profile will be sent to the job poster upon your confirmation.");
            if (r == true) {
                window.location.href="apply_job.php?backto=seeker_applied.php&id="+id;
            }}

    </script>
</body>

</html>
