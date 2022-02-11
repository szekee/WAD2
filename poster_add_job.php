<?php
    
    include "./ConnectionManager.php";
    // <!-- Nav Bar -->
    include "nav_bar.php";
    // connect to database
    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection();
    
    // var_dump($_SESSION["userid"]);

    // Check if submitted
    if (isset($_POST["uploadfilesubmit"])){

        
        // Adapted From: https://github.com/mauricemuteti/Upload-And-Insert-Image-Into-Mysql-Database-Using-Php-Html/blob/master/uploadimage.php
        $filename = $_FILES["uploadfile"]["name"];
        $filetmpname = $_FILES["uploadfile"]["tmp_name"];
        $folder = 'uploadImage/';

        move_uploaded_file($filetmpname, $folder.$filename);
        /********************************/
        $jobName = $_POST["jobName"];
        $role = $_POST["role"];
        $jobDesc = $_POST["jobDesc"];
        $skills = $_POST["skills"];
        $sDate = $_POST["sDate"];
        $eDate = $_POST["eDate"];
        $address = $_POST["address"];
        $listingStatus = "Open";
        $userid = $_SESSION["userid"];
        
        // $currentDate = date("Y-M-D");
        

        // SQL statement
        $sql = 'insert into job (jobname, jobdesc, rolerequired, picturepath, skills,startdate,enddate, address, createuserid, listingstatus)
            values (:jobName, :jobdesc, :role, :filename, :skills, :sDate, :eDate, :address,:userid, :listingStatus)';
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':jobName', $jobName);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':jobdesc', $jobDesc);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':sDate', $sDate);
        $stmt->bindParam(':eDate', $eDate);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(":userid", $userid);
        $stmt->bindParam(':listingStatus',$listingStatus);
        
        
        // execute statement
        // Redirect to home page index.php after insertion
        if ($stmt->execute()){
            // Redirect to get_job.php after insertion
            // header('Location: index.php?add=successful');
            echo("<script type='application/javascript'>location.href = 'home.php?add=successful';</script>");
        }
        else{
            // Redirect to home page index.php after insertion
            // header('Location: index.php?add=unsuccessful');
            echo("<script type='application/javascript'>location.href = 'home.php?add=unsuccessful';</script>");
        }
        
        // Free up resources
        $stmt = null;
        $pdo = null;
        
        
    }
?>
<!doctype html>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Vue Use CDN Library -->
        <script type="application/javascript" src="https://unpkg.com/vue@3.0.11/dist/vue.global.prod.js"></script>
    </head>
    <body>
            
            <br>
        <div id="app">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <br>
                <h6>For Job Posters<h6>
                <button type="button" class="btn btn-lg btn-secondary mt-2 w-100 disabled" onclick="window.location.href='poster_add_job.php'">Post a Job</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='poster_postings.php'">My Postings</button>
                <hr>
                <h6>For Job Seekers</h6>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_liked.php'">Liked Jobs</button>
                <button type="button" class="btn btn-lg btn-outline-secondary  mt-2 w-100" onclick="window.location.href='seeker_applied.php'">Applied Jobs</button>
            </div>
            <div class="col-sm-10 mt-3">
                <div class="container border border-0 bg-light rounded p-5">
                    <!-- Adapted From: https://getbootstrap.com/docs/5.0/forms/overview/ -->
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="checkField()">
                                
                        <div class="mb-3">
                            <label for="jobName" class="form-label">Job Name</label>
                            <input type="text" name = "jobName" class="form-control" id="jobName" placeholder="Video Content Creator" required v-model="jobName">
                        </div>
                        <div class="mb-3">
                        <label for="role" class="form-label">Role Required</label>
                            <input type="text" class="form-control" name="role" id="role" placeholder="Videographer" required v-model="role">
                        </div>
                        <div class="mb-3">
                        <label for="jobDesc" class="form-label">Job Description</label>
                            <textarea class="form-control" name="jobDesc"  id="jobDesc" rows="6" placeholder="Job Description...." required v-model="jobDesc"></textarea>
                        </div>
                        <div class="mb-3">
                        <label for="image" class="form-label">Job Image</label>
                        <input type="file"  class="form-control" id="image" name="uploadfile" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                            <input type="text" name="skills" class="form-control" id="skills" placeholder="Familiar with Video Editing Software"  required required v-model="skills">
                        </div>
                        <div class="mb-3">
                            <label for="sDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name= "sDate" id="sDate" required v-model="sDate">
                        </div>
                        <div class="mb-3">
                            <label for="eDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" name= "eDate" id="eDate" required v-model="eDate">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name= "address" id="address" required v-model="address">
                        </div>
                        <input type="submit" class="btn btn-primary" name="uploadfilesubmit" :disabled='isDisabled'>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
            <script type="application/javascript">
                const app = Vue.createApp({
                data() {
                    return {
                    // add properties here
                    jobName: "",
                    jobDesc: "",
                    role:"",
                    skills:"",
                    sDate:"",
                    eDate:"",
                    address:""
                    }
                },
                computed: {
                    //  Adapted From: https://jsfiddle.net/willywg/2g7m5qy5/
                    isDisabled: function(){
                        if (this.jobName!="" && this.jobDesc!="" && this.role!="" && this.skills!="" && this.sDate!="" && this.eDate!="" && this.address!=""){
                            return false;
                        }
                        else{
                            return true;
                        }
                    
                }
                }
                })
                const vm = app.mount('#app')
            </script>
        <!-- Bootstrap  -->
        <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                
            
    </body>
</html>
