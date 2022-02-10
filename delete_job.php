<?php
    // this file is to connect to database and delete a job from jobs table
    
    include 'session.php';

    $id = $_GET["id"];
    
    // Connect to Database
    include "ConnectionManager.php";
    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection();

    // SQL 
    $sql = "Delete from job where jobid=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Execute SQL Statement
    $stmt->execute();
    
    if ($stmt->execute()){
        // Redirect to get_job.php after insertion
        header('Location: poster_postings.php?delete=successful');
    }
    else{
        // Redirect to get_job.php after insertion
        header('Location: poster_postings.php?delete=unsuccessful');
    }
    // Free up resources
    $stmt = null;
    $pdo = null;
    
?>