<?php
require_once '../model/common.php';
session_start();
$_SESSION['userid'] = 3;

// if (!isset($_SESSION['userid'])) {
//     header('Location: login.php');
//     exit;
// }

$_GET['skills'] = 'music producing, transcribing, videography';
$_GET['bio'] = 'Music is greatttt';
$_GET['profilepic'] = 'face.jpeg';
$_GET['portfoliolink'] = 'www.happyyappy.com';
$_GET['portfoliopath'] = '';

$status = false;
$result = [];

if( isset($_GET['skills']) && isset($_GET['bio']) && isset($_GET['profilepic']) && isset($_GET['portfoliolink']) && isset($_GET['portfoliopath']) ) {

    $userid = $_SESSION['userid'];

    $skills = $_GET['skills'];
    $bio = $_GET['bio'];
    $profilepic = $_GET['profilepic'];
    $portfoliolink = $_GET['portfoliolink'];
    $portfoliopath = $_GET['portfoliopath'];

    $dao = new ProfileDAO();
    $profile_obj = $dao->getOneProfile($userid);
    
    if (is_null($profile_obj)) {
        var_dump($profile_obj);
        $status = $dao->updateProfile($userid, $skills, $bio, $profilepic, $portfoliolink, $portfoliopath);
        
    } else {
        $status = $dao->createProfile($userid, $skills, $bio, $profilepic, $portfoliolink, $portfoliopath);
    }


} else {
    try {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $skills = $data->skills;
        $bio = $data->bio;
        $profilepic = $data->profilepic;
        $portfoliolink = $data->portfoliolink;
        $portfoliopath = $data->portfoliopath;
            
        $dao = new ProfileDAO();
        $profile_obj = $dao->getOneProfile($userid);
    
        if (isset($profile_obj)) {
            $status = $dao->updateProfile($userid, $skills, $bio, $profilepic, $portfoliolink, $portfoliopath);
        
        } else {
            $status = $dao->createProfile($userid, $skills, $bio, $profilepic, $portfoliolink, $portfoliopath);
        }      

    } catch (Exception $e) {
        $status = false;
    }
  
}

if ($status)
    $result["status"] = "success";
else 
    $result["status"] = "failed";

$profileJSON = json_encode($result);
echo $profileJSON;
?>


