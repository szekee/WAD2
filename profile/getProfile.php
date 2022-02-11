<?php

require_once '../model/common.php';
include '../session.php';

$dao = new ProfileDAO();


$id = $_SESSION['userid'];


$profile = $dao->getOneProfile($id); 

if ($profile != null) {
    
    $item = [];
    $item["name"] = $profile->getName();
    $item["roles"] = $profile->getRoles();
    $item["email"] = $profile->getEmail();
    $item["address"] = $profile->getAddress();
    $item["country"] = $profile->getCountry();
    $item["phone"] = $profile->getPhone();

    $item["skills"] = $profile->getSkills();
    $item["bio"] = $profile->getBio();
    $item["videoid"] = $profile->getVideoid();
    $item["profilepic"] = $profile->getProfilepic() . "?t=" . time();
    $item["portfoliolink"] = $profile->getPortfoliolink();

    
    if (strlen($profile->getPortfoliopath()) > 0 ) {
        $allimgpath = [];   
        foreach (glob($profile->getPortfoliopath() . "/*") as $file) {
            array_push($allimgpath, $file . "?t=" . time());
        }
        $item["portfoliopath"] = $allimgpath;
    } else {
        $item["portfoliopath"] = '';
    }

    $item["facebook"] = $profile->getFacebook();
    $item["instagram"] = $profile->getInstagram();
    $item["youtube"] = $profile->getYoutube();
    $item["pinterest"] = $profile->getPinterest();

    
    // make profile into json and return json data
    $profileJSON = json_encode($item);
    echo $profileJSON;

    
} else {
    echo json_encode("No profile found");
    

}



?>

