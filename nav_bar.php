<?php 

include './session.php'; 
require_once 'model/common.php';

// Personal Profile in Nav

if (isset($_SESSION['userid'])) {

    $id = $_SESSION['userid'];
    $dao = new ProfileDAO();
    
    $profile = $dao->getOneProfile($id); 

    if ($profile != null) {
        
        $name = $profile->getName();
        $roles = implode(", " , $profile->getRoles());
        $profilepic = substr($profile->getProfilepic() . "?t=" . time(), 3);    
        $profilepicstyle = "";
        $viewbutton = ""; 

    } else {
        $name = "Please create a profile by clicking on 'Edit' button below";
        $roles = '';
        $profilepic = '';
        $profilepicstyle = "style='display: none;'";
        $viewbutton = "disabled";
    }
}
?>

<nav class="navbar navbar-expand-md navbar-dark" style = "background-color : black ; margin-bottom : 50px">
        <div class="container-fluid">

            <a class="navbar-brand" style="margin-left:30px" href="home.php">
                <img src = "starlight3.png" style = "height:80px">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
                <ul class="navbar-nav me-0 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 300px;">
                    <li class="nav-item px-3">
                        <a class="nav-link text-light" href="home.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link text-light" aria-current="page" href="people/index.php">People</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link text-light" href="side_bar.php?id=1">Jobs</a>
                    </li>
                    <li class="nav-item dropdown px-3">
                        <a class="nav-link dropdown-toggle text-light" href="/profile/index.php" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-light" aria-labelledby="navbarScrollingDropdown"
                            style="min-width:350px; ">
                            <li>
                                <div class="container">
                                    <div class="card m-3">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-sm-4">
                                                <img <?=$profilepicstyle;?> src="<?=$profilepic;?>" class="pt-4 img-fluid rounded-start"
                                                    alt="profile">
                                            </div>
                                            <div class="col">
                                                <div class="card-body">
                                                    <h6 class="card-title"><?=$name;?></h6>
                                                    <p class="card-subtitle text-muted"><?=$roles;?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col d-flex my-2 justify-content-center">
                                                <a class="btn btn-secondary fs-6 <?=$viewbutton;?>" href="profile/index.php" role="button"
                                                    style="width:100px;">View</a>
                                            </div>
                                            <div class="col d-flex my-2 justify-content-center">
                                                <a class="btn btn-secondary fs-6" href="profile/createProfile.php" role="button"
                                                    style="width:100px;">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./auth/logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
