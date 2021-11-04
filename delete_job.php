<?php
    session_start();
    $userid = $_SESSION["userid"];
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
        header('Location: view_job.php?delete=successful');  
    }
    else{
        header('Location: view_job.php?delete=unsuccessful');  
    }

    
    // Free up resources
    $stmt = null;
    $pdo = null;
    
?>