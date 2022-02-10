<?php
    // this file is to connect to database and delete a job from jobs table
    
    include 'session.php';

    $id = $_GET["id"];
    $backto = $_GET["backto"];

    
    // Connect to Database
    include "ConnectionManager.php";
    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection();

    // SQL 
    $sql = "Delete from likelisting where jobid=:id and userid=:userid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':userid', $userid);

    // Execute SQL Statement
    // Redirect to get_job.php after insertion
    if ($stmt->execute()){
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&unlike=successful');
    }
    else{
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&unlike=unsuccessful');
    }
    // Free up resources
    $stmt = null;
    $pdo = null;
    
?>