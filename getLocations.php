<?php
// php statement to connect to database
// retrieve job locations

include 'ConnectionManager.php';

// connect to database
$connMgr = new ConnectionManager();
$pdo = $connMgr->getConnection();

// SQL statement
$sql = "select jobid, jobname, address from job where listingstatus = 'open';";
$stmt=$pdo->prepare($sql);

// Run SQL Statement
$stmt->execute();   
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$locations = [];
while($row = $stmt->fetch()){
    $joblocations[] = array(
        'jobid' => $row['jobid'], 
        'jobname' => $row['jobname'], 
        'address' => $row["address"]
    );
}

$stmt = null;
$conn = null;

echo json_encode($joblocations);

?>