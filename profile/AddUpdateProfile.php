<?php
session_start();
require_once '../model/common.php';


$userid = $_SESSION['userid'];



// process profile picture
function processProfilePicture($userid) {
    if (isset($_POST['processed_profilepic'])) {
        $profilepic = $_POST['processed_profilepic'];
        $profilepic_d = "../profileimg/u" . $userid; 
        
        if (!file_exists($profilepic_d)) {
            mkdir($profilepic_d, 0777, true);
        }

        // send to database
        if (preg_match('/^data:image\/(\w+);base64,/', $profilepic, $type)) {
            $data = substr($profilepic, strpos($profilepic, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
        
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
            $profilepic_dir = $profilepic_d . "/profileimg." . $type; 
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        // shift file into storage
        decodeImage($profilepic, $profilepic_d . "/profileimg");
    } else {
        if (strpos($_POST['profilepic'], '?')) {
            $profilepic_dir = substr( $_POST['profilepic'], 0, strpos($_POST['profilepic'], '?'));
        }
        else {
            $profilepic_dir = $_POST['profilepic'];
        }
    }
    return $profilepic_dir;
}

// process gallery
function processGallery($userid) {
    if (isset($_POST['processed_gallery']) && strlen($_POST['processed_gallery']) > 0) {
        $galleries = explode(' ', $_POST['processed_gallery']);
        
        // send to database
        $gallery_dir = "../profileimg/u" . $userid . "/gallery";

        if (!file_exists($gallery_dir)) {
            mkdir($gallery_dir, 0777, true);
        }
        
        // clear all pics from storage
        $files = glob($gallery_dir . '/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                unlink($file); // delete file
            }
        }

        // shift to storage
        $count = 1;
        foreach ($galleries as $gallery) {
            $target_dir = $gallery_dir . "/galleryimg{$count}";
            $count++;
            decodeImage($gallery, $target_dir);
        }
    } else {
        if ($_POST['portfoliopath'] != '' ) {
            $temp = substr($_POST['portfoliopath'], 0, strrpos($_POST['portfoliopath'], '/'));
            $gallery_dir = $temp;
        } else {
            $gallery_dir = '';
        }
    }
    return $gallery_dir;
}

// https://stackoverflow.com/questions/11511511/how-to-save-a-png-image-server-side-from-a-base64-data-uri/11511605#11511605
function decodeImage($data, $target_dir) {
    if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif
    
        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
            throw new \Exception('invalid image type');
        }
        $data = str_replace( ' ', '+', $data );
        $data = base64_decode($data);
    
        if ($data === false) {
            throw new \Exception('base64_decode failed');
        }
    } else {
        throw new \Exception('did not match data URI with image data');
    }

    $target_dir = $target_dir . "." . $type;

    if (file_exists($target_dir)) {
        unlink($target_dir);
    } 

    file_put_contents($target_dir, $data);
}


// process youtube video id
function processYoutubeid() {
    if (isset($_POST['youtubelink'])) {
        $videoid = $_POST['youtubelink'];
        $videoid = substr($videoid, strpos($videoid, '=') + 1);
        if ($videoid == false) {
            $videoid = '';
        }
    } 
    return $videoid;
}

try {
    // update database with other fields
    
    $status = false;
    $result = [];
    
    if(isset($_POST['submit'])) {
    
        if (isset( $_POST['skills'])) {
            $skills = $_POST['skills'];
        } else {
            $skills = '';
        }
    
        if (isset($_POST['bio'])) {
            $bio = $_POST['bio'];
        } else {
            $bio = '';
        }
    
        if (isset($_POST['portfoliolink'])) {
            if (substr($_POST['portfoliolink'], 0, 8) === 'https://' ) {
                $portfoliolink = str_replace('https://', '', $_POST['portfoliolink']);
            } elseif (substr($_POST['portfoliolink'], 0, 7) === 'http://') {
                $portfoliolink = str_replace('http://', '', $_POST['portfoliolink']);
            } else {
                $portfoliolink = $_POST['portfoliolink'];
            }
        } else {
            $portfoliolink = '';
        }
    
        $videoid = processYoutubeid();
        $profilepic_dir = processProfilePicture($userid);
        $gallery_dir = processGallery($userid); 

        if (isset($_POST['facebook'])) {
            if (substr($_POST['facebook'], 0, 8) === 'https://' ) {
                $facebook = str_replace('https://', '', $_POST['facebook']);
            } elseif (substr($_POST['facebook'], 0, 7) === 'http://') {
                $facebook = str_replace('http://', '', $_POST['facebook']);
            } else {
                $facebook = $_POST['facebook'];
            }
        } else {
            $facebook = '';
        }

        if (isset($_POST['instagram'])) {
            if (substr($_POST['instagram'], 0, 8) === 'https://' ) {
                $instagram = str_replace('https://', '', $POST['instagram']);
            } elseif (substr($_POST['instagram'], 0, 7) === 'http://') {
                $instagram = str_replace('http://' , '', $_POST['instagram']);
            } else {
                $instagram = $_POST['instagram'];
            }
        } else {
            $instagram = '';
        }

        if (isset($_POST['youtube'])) {
            if (substr($_POST['youtube'], 0, 8) === 'https://' ) {
                $youtube = str_replace('https://', '', $_POST['youtube']);
            } elseif (substr($_POST['youtube'], 0, 7) === 'http://') {
                $youtube = str_replace('http://', '', $_POST['youtube']);
            } else {
                $youtube = $_POST['youtube'];
            }
        } else {
            $youtube = '';
        }

        if (isset($_POST['pinterest'])) {
            if (substr($_POST['pinterest'], 0, 8) === 'https://' ) {
                $pinterest = str_replace('https://', '', $_POST['pinterest']);
            } elseif (substr($_POST['pinterest'], 0, 7) === 'http://') {
                $pinterest = str_replace('http://', '', $_POST['pinterest']);
            } else {
                $pinterest = $_POST['pinterest'];
            }
        } else {
            $pinterest = '';
        }
    
    

    
    
        // interact with database
        $dao = new ProfileDAO();
        $profile_obj = $dao->getOneProfile($userid);
        
        if (!is_null($profile_obj)) {
            $dao->updateProfile($userid, $skills, $bio, $videoid, $profilepic_dir, $portfoliolink, $gallery_dir, $facebook, $instagram, $youtube, $pinterest);

            if (isset($_POST['role'])) {
                $dao->deleteAllIndivRole($userid);
                foreach ($_POST['role'] as $role) {
                    if (strlen($role) > 0) {
                        $dao->addIndivRole($userid, $role);
                    }
                }
            }
    
        } else {
            $dao->createProfile($userid, $skills, $bio, $videoid, $profilepic_dir, $portfoliolink, $gallery_dir, $facebook, $instagram, $youtube, $pinterest);

            if (isset($_POST['role'])) {
                $dao->deleteAllIndivRole($userid);
                foreach ($_POST['role'] as $role) {
                    if (strlen($role) > 0) {
                        $dao->addIndivRole($userid, $role);
                    }
                }
            }
        }
    
    
    } else {
        $error_message = 'Nothing was submitted';
    } 
        // try {
        //     $json = file_get_contents('php://input');
        //     $data = json_decode($json);
    
        //     $skills = $data->skills;
        //     $bio = $data->bio;
            
        //     $bio = $data->bio;
    
    
        //     $profilepic = $data->profilepic;
        //     $portfoliolink = $data->portfoliolink;
        //     $portfoliopath = $data->portfoliopath;
    
        //     $facebook = $data->facebook;
        //     $instagram = $data->$instagram;
        //     $youtube = $data->youtube;
        //     $pinterest = $data->pinterest;
                
    
    
        //     $dao = new ProfileDAO();
        //     $profile_obj = $dao->getOneProfile($userid);
            
        //     if (!is_null($profile_obj)) {
        //         $status = $dao->updateProfile($userid, $skills, $bio, $videoid, $profilepic_dir, $portfoliolink, $gallery_dir, $facebook, $instagram, $youtube, $pinterest);
        //     } else {
        //         $status = $dao->createProfile($userid, $skills, $bio, $videoid, $profilepic_dir, $portfoliolink, $gallery_dir, $facebook, $instagram, $youtube, $pinterest);
        //     }    
    
        // } catch (Exception $e) {
        //     $status = false;
        // }
      
    
} catch (Exception $e) {
    $error_message = $e->getMessage();
}


// var_dump($error_message);

if (!isset($error_message)) {
    header('Location:createProfile.php?edit=success');
}
else {
    header('Location:createProfile.php?edit=fail' . "&error=" . $error_message);
}


?>


