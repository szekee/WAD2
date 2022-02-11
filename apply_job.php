<?php
    include 'session.php';
    
    // this file is to connect to database and add a job to applylisting table

    $id = $_GET["id"];
    $applicationstatus = "Submitted";
    $backto = $_GET["backto"];


    include "ConnectionManager.php";
    // connect to database
    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection();

    // SQL statement
    $sql = 'insert into applylisting (jobid, userid, applicationstatus)
        values (:jobid, :userid, :applicationstatus)';
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':jobid', $id);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':applicationstatus', $applicationstatus);
    
    // execute statement
    // Redirect to get_job.php after insertion
    if ($stmt->execute()){
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&apply=successful');
    }
    else{
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&apply=unsuccessful');
    }
    
    // Free up resources
    $stmt = null;
    $pdo = null;

?>

</html>
