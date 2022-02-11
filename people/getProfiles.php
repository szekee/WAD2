<?php

require_once '../model/common.php';
$dao = new ProfileDAO();
$profiles = $dao->getAll(); // Get an Indexed Array of Post objects

$items = [];
foreach( $profiles as $profile) {
    $item = [];
    $item["userid"] = $profile->getUserid();
    $item["name"] = $profile->getName();
    $item["roles"] = $profile->getRoles();
    $item["email"] = $profile->getEmail();
    // $item["address"] = $profile->getAddress();
    $item["country"] = $profile->getCountry();
    $item["phone"] = $profile->getPhone();
    // $item["skills"] = $profile->getSkills();
    $item["bio"] = $profile->getBio();
    // $item["videoid"] = $profile->getVideoid();
    $item["profilepic"] = $profile->getProfilepic(). "?t=" . time();
    // $item["portfoliolink"] = $profile->getPortfoliolink();
    // $item["portfoliopath"] = $profile->getPortfoliopath();
    // $item["facebook"] = $profile->getFacebook();
    // $item["instagram"] = $profile->getInstagram();
    // $item["youtube"] = $profile->getYoutube();
    // $item["pinterest"] = $profile->getPinterest();
    $items[] = $item;
}

// make profiles into json and return json data
$profilesJSON = json_encode($items);
echo $profilesJSON;

?>

