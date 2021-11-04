<?php
require_once '../model/common.php';
session_start();
$_SESSION['userid'] = 3;

// if (!isset($_SESSION['userid'])) {
//     header('Location: login.php');
//     exit;
// }

$_POST['skills'] = 'music producing, transcribing, videography';
$_POST['bio'] = 'Music is greatttt';
$_POST['profilepic'] = 'face.jpeg';
$_POST['portfoliolink'] = 'www.happyyappy.com';
$_POST['portfoliopath'] = '';

$status = false;
$result = [];

if( isset($_POST['skills']) && isset($_POST['bio']) && isset($_POST['profilepic']) && isset($_POST['portfoliolink']) && isset($_POST['portfoliopath']) ) {

    $userid = $_SESSION['userid'];

    $skills = $_POST['skills'];
    $bio = $_POST['bio'];
    $profilepic = $_POST['profilepic'];
    $portfoliolink = $_POST['portfoliolink'];
    $portfoliopath = $_POST['portfoliopath'];

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


