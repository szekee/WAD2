<?php

require_once '../model/common.php';
session_start();
$_SESSION['userid'] = 1;

$dao = new ProfileDAO();

if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $profile = $dao->getOneProfile($id); 
    
    $item = [];
    $item["name"] = $profile->getName();
    $item["roles"] = $profile->getRoles();
    $item["email"] = $profile->getEmail();
    $item["address"] = $profile->getAddress();
    $item["country"] = $profile->getCountry();
    $item["gender"] = $profile->getGender();
    $item["phone"] = $profile->getPhone();
    $item["skills"] = $profile->getSkills();
    $item["bio"] = $profile->getBio();
    $item["profilepic"] = $profile->getProfilepic();
    $item["portfoliolink"] = $profile->getPortfoliolink();
    $item["portfoliopath"] = $profile->getPortfoliopath();
    
    
    // make profile into json and return json data
    $profileJSON = json_encode($item);
    echo $profileJSON;
} 


?>

