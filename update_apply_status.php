<?php

if (isset($_POST["update"])){
    $applyid = $_POST["applyid"];
    $status = $_POST["status"];
    $sql3 = "update applylisting set applicationstatus = :status where applyid = :applyid";
    $stmt3=$pdo->prepare($sql3);
    $stmt3->bindParam(':status', $status);
    $stmt3->bindParam(':applyid', $applyid);
    

    // Run SQL Statement
    // $stmt3->execute();
    if ($stmt3->execute()){
        echo("<script>location.href = 'viewApplication.php?id=$id&updateStatus=successful';</script>");
    }
    else{
        echo("<script>location.href = 'viewApplication.php?id=$id&updateStatus=unsuccessful';</script>");
    }
    
}

?>