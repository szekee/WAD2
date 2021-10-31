<?php

require_once '../model/common.php';

$dao = new ProfileDAO();
$allprofiles = $dao->getAll(); // Get an Indexed Array of Post objects

$locations = [];
$roles = [];
$profiles = [];


if ( isset($_GET['locations']) && isset($_GET['roles'])) {
    $locations = explode("; ", $_GET['locations']);
    $roles = explode("; ", $_GET['roles']);

} else {
    try {
        $json = file_get_contents('php://input');

        $data = json_decode($json);

        $locations = explode("; " , $data->locations);
        $roles = explode("; " , $data->roles);

    } catch (Exception $e) {
        $status = json_encode("failed");
        echo $status;
    }
}

// filter by role and locations
foreach ($allprofiles as $profile) {
    if (in_array($profile->getCountry(), $locations)) {
        $profiles[] = $profile;
        continue;
    } elseif (count(array_intersect($roles, $profile->getRoles())) > 0) {
        $profiles[] = $profile;
    }
}

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

