<? include './session.php'?>

<!doctype html>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
    </head>

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

    <body>
        <?php include "nav_bar.php"; 
        ?>

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

            

        ?>

    
    <!-- Adapted From: https://getbootstrap.com/docs/5.0/examples/sidebars/ -->
    <div class="container-fluid mb-4">
        <div class="row">
            
            <div class="col-md-6" style="border-right:1px solid black;">
                <div class="row">
                    <h6>For Job Posters</h6>
                    <div class="col">
                    <select class="form-select form-select-lg mb-3" id="JPredirect" onChange="JPredirect()">
                        <option value='' disabled selected>Go to...</option>
                        <option value='home.php'>Back to Home</option>
                        <option value='poster_add_job.php'>Post a Job</option>
                        <option value='poster_postings.php'>View My Posting</option>
                    </select>
                    </div>
                </div>
            </div>
               
            <div class="col-md-6">
                <div class="row">
                    <h6>For Job Seekers</h6>
                    <div class="col">
                    <select class="form-select form-select-lg mb-3" id="JSredirect" onChange="JSredirect()">
                        <option value='' disabled selected>Go to...</option>
                        <option value='home.php'>Back to Home</option>
                        <option value='seeker_liked.php'>Liked Job</option>
                        <option value='seeker_applied.php'>Applied Jobs</option>
                    </select>
                    </div>
                </div>
            </div>

            </div>

        <hr>
        <div class="row">
            <div class="col-md-4">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" >
                <span class="fs-5 fw-semibold align-items-center p-3">Job Listing</span>
            <?php
            // Retrieve Everything
            include "./ConnectionManager.php";
            // connect to database
            $connMgr = new ConnectionManager();
            $pdo = $connMgr->getConnection();

            // SQL statement
            $sql = "select * from job";
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
                    $createDate = $row["createdate"];

                    $create_date = date('d-M-Y', strtotime($createDate));
                    $active ="";
                    $isActive = False;  
                    if (isset($_GET["id"])){
                        if ($_GET["id"] == $id){
                            $active = "active";
                            $isActive = True;
                        }
                    }

                    echo "    
                    <a href='#' class='list-group-item list-group-item-action py-3 lh-tight $active' id ='$id' onclick='getDetails(this.id)'>
                        <div class='d-flex w-100 align-items-center justify-content-between' id='item'>
                            <input type='hidden' name='id' id ='$id' value='$id'>
                            <strong class='mb-1'>$jobName</strong>";
                           
                            if ($isActive == True){
                                echo "<small class='text-light'>$create_date</small>";
                            }
                            else{
                                echo "<small class='text-muted'>$create_date</small>";
                            }
                        echo "</div>
                        <div class='col-10 mb-1 small'>$JobDesc</div>
                    </a>
                    
                    ";
                }
             # Free up resources
             $stmt = null;
             $pdo = null;
            ?>

                </div>
            </div>
            <div class="col-md">
                <?php
                    if(isset($_GET["id"])){
                        $id = $_GET['id'];
                        $connMgr = new ConnectionManager();
                        $pdo = $connMgr->getConnection();

                        // SQL statement
                        $job_sql = "select a.jobid,a.jobname,a.rolerequired,a.jobdesc,a.picturepath,a.skills,a.startdate,a.enddate,a.address,a.createdate,a.listingstatus,c.applydate,c.applicationstatus,b.is_liked from (select * from job where jobid = :id) a left join likelisting b on a.jobid=b.jobid and b.userid=:userid left join applylisting c on c.jobid=a.jobid and c.userid=:userid order by jobid desc;";
                        $stmt=$pdo->prepare($job_sql);
                        $stmt->bindParam(':id', $id);
                        $stmt->bindParam(':userid', $userid);

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
                            $createDate = $row["createdate"];
                            $applydate = $row["applydate"];
                            $applicationstatus = $row["applicationstatus"];
                            $isliked = $row["is_liked"];

                            $create_date = date('d-M-Y', strtotime($createDate));
                        }
                        # Free up resources
                        $stmt = null;
                        $pdo = null;
                    
                    
                ?>
                            <div class="container bg-white mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-3 border-right mt-4">
                                    <img class='img-fluid'src='uploadImage/<?php echo $image ?>'>
                                </div>
                                <div class="col-md  border-right">
                                <div class="px-2">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Job Details</h4>
                                </div>
                                <hr>
                            
                                <div class="row mt-2">
                                    <div class="col-md">
                                        <h5><?php echo $jobName; ?></h5>
                                        <span class="text-muted"><?php echo date("d-M-Y", strtotime($startdate)); ?> - <?php echo date("d-M-Y", strtotime($enddate)); ?></span><br>

                                        <!-- application -->
                                    </div>
                                    <div class="col-md pt-0">
                                        <!-- liked -->
                                        <?php 
                                            if ($isliked == 1){
                                                echo "<button class='btn mt-2 w-30 liked' onclick='event.stopPropagation();Buttontoggle(".$id.");' id='like".$id."'>♥ Liked</button><br";
                                            } else {
                                                echo "<button class='btn mt-2 w-30 like' onclick='event.stopPropagation();Buttontoggle(".$id.");' id='like".$id."'>♥ Like</button>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                    <?php if ($listingStatus == "Open"){?>
                                        <div class="row mb-2"><div class="col-md"><p class="mb-0"><strong>Status: </strong> <span class = "text-success"> <?php echo $listingStatus; ?></span></p></div></div>
                                    <?php }
                                    else{?>
                                    <div class="row mt-0 mb-2"><div class="col-md"><p><strong>Status: </strong> <span class = "text-danger"> <?php echo $listingStatus; ?></span></p></div></div>
                                    <?php }?>
                                    <div>
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
                                                if ($listingStatus == "Open"){
                                                    echo "<button type='button' class='btn btn-outline-success w-30' id='".$id."'onclick='event.stopPropagation();confirmapply(this.id);'>Apply Now</button>";
                                                }
                                                else{
                                                    echo "<button type='button' class='btn btn-danger w-30 disabled' onclick='event.stopPropagation()'>No longer accepting applications</button";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                
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
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getDetails(id){
            window.location.href='side_bar.php?id='+id;
        }
        function JPredirect(){
            var redirect = document.getElementById("JPredirect").value;
            window.location.href=redirect;
        }
        function JSredirect(){
            var redirect = document.getElementById("JSredirect").value;
            window.location.href=redirect;
        }

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

        // To like and unlike a job
        function Buttontoggle(id){
            var t = document.getElementById("like"+id);
            if(t.innerHTML=="♥ Like"){
                t.innerHTML="♥ Liked";
                t.classList.remove("like");
                t.classList.add("liked");
                window.location.href='add_like.php?backto=side_bar.php&id='+id;

            }
            else{
                t.innerHTML="♥ Like";
                t.classList.remove("liked");
                t.classList.add("like");                
                window.location.href='delete_like.php?backto=side_bar.php&id='+id;
                }
            }

        // Apply for a job
        function confirmapply(id) {
            var r = confirm("Confirm your application. \r\nYour profile will be sent to the job poster upon your confirmation.");
            if (r == true) {
                window.location.href="apply_job.php?backto=side_bar.php&id="+id;
            }}
    </script>
    <!-- Bootstrap  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>
