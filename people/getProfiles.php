<?php

require_once '../model/common.php';
$dao = new ProfileDAO();
$profiles = $dao->getAll(); // Get an Indexed Array of Post objects

$items = [];
foreach( $profiles as $profile_object) {
    $item = [];
    $item["name"] = $profile_object->getName();
    $item["roles"] = $profile_object->getRoles();
    $item["email"] = $profile_object->getEmail();
    $item["address"] = $profile_object->getAddress();
    $item["country"] = $profile_object->getCountry();
    $item["gender"] = $profile_object->getGender();
    $item["phone"] = $profile_object->getPhone();
    $item["skills"] = $profile_object->getSkills();
    $item["bio"] = $profile_object->getBio();
    $item["profilepic"] = $profile_object->getProfilepic();
    $item["portfoliolink"] = $profile_object->getPortfoliolink();
    $item["portfoliopath"] = $profile_object->getPortfoliopath();
    $items[] = $item;
}

// make profiles into json and return json data
$profilesJSON = json_encode($items);
echo $profilesJSON;
?>
