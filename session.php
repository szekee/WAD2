<?php
session_start();
    $userid = $_SESSION["userid"];

    if(!isset($_SESSION["userid"])) {
        header("location: index.php");
        // $URL="https://starlight-project.000webhostapp.com/";
        // echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        // echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
