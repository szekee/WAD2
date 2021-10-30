<?php

require_once '../model/common.php';

$dao = new ProfileDAO();
$roles = $dao->getRoles(); // Get an Indexed Array of Post objects

$rolesJSON = json_encode($roles);
echo $rolesJSON;

?>
