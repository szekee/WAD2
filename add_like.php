<?php
    include 'session.php';
    
    // this file is to connect to database and add a job to likelisting table

    $id = $_GET["id"];
    $is_liked = "1";
    $backto = $_GET["backto"];

    include "ConnectionManager.php";
    // connect to database
    $connMgr = new ConnectionManager();
    $pdo = $connMgr->getConnection();

    // SQL statement
    $sql = 'insert into likelisting (jobid, userid, is_liked)
        values (:jobid, :userid, :is_liked)';
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':jobid', $id);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':is_liked', $is_liked);
    
    // execute statement
    // Redirect to get_job.php after insertion
    if ($stmt->execute()){
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&like=successful');
    }
    else{
        // Redirect to get_job.php after insertion
        header('Location:'.$backto.'?id='.$id.'&like=unsuccessful');
    }
    
    // Free up resources
    $stmt = null;
    $pdo = null;

?>

</html>
