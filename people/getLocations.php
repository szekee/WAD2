<?php

require_once '../model/common.php';

$dao = new ProfileDAO();
$locations = $dao->getLocations(); // Get an Indexed Array of Post objects

$locationsJSON = json_encode($locations);
echo $locationsJSON;

?>
