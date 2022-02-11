<?php
    require_once "common.php";

    class ProfileDAO {
        
        function getAll() {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();
            $sql = "select u.userid, name, rolename, email, address, country, phone, skills, bio, videoid, profilepic, portfoliolink, portfoliopath, facebook, instagram, youtube, pinterest from user u, profile p, role r where u.userid = p.userid and u.userid = r.userid;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $profiles = $stmt->fetchAll(PDO::FETCH_GROUP);
            
            $result = [];
            
            foreach ($profiles as $id => $row) {
                $role = [];
                if (count($row) > 0) {
                    foreach ($row as $subprofile) {
                        $role[] = $subprofile['rolename'];
                    }
                } else {
                    $role[] = $row['rolename'];
                }
                $result[] = new Profile($id, $row[0]['name'], $role, $row[0]['email'], $row[0]['address'], $row[0]['country'], $row[0]['phone'], $row[0]['skills'], $row[0]['bio'], $row[0]['videoid'], $row[0]['profilepic'], $row[0]['portfoliolink'], $row[0]['portfoliopath'], $row[0]['facebook'], $row[0]['instagram'], $row[0]['youtube'], $row[0]['pinterest']);
            }
            
            $stmt = null;
            $pdo = null;
            
            return $result;
        }
        
        function getOneProfile($userid) {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();

            $sql = "select u.userid, name, rolename, email, address, country, phone, skills, bio, videoid, profilepic, portfoliolink, portfoliopath, facebook, instagram, youtube, pinterest from user u, profile p, role r where u.userid = p.userid and u.userid = r.userid and u.userid = :userid;";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

            $stmt->execute();
            $profile = $stmt->FetchAll(PDO::FETCH_GROUP);

            $result = null;

            foreach ($profile as $id => $row) {
                $role = [];
                if (count($row) > 0) {
                    foreach ($row as $subprofile) {
                        $role[] = $subprofile['rolename'];
                    }
                } else {
                    $role[] = $row['rolename'];
                }
                $result = new Profile($id, $row[0]['name'], $role, $row[0]['email'], $row[0]['address'], $row[0]['country'], $row[0]['phone'], $row[0]['skills'], $row[0]['bio'], $row[0]['videoid'], $row[0]['profilepic'], $row[0]['portfoliolink'], $row[0]['portfoliopath'], $row[0]['facebook'], $row[0]['instagram'], $row[0]['youtube'], $row[0]['pinterest']);
            }
            
            $stmt = null;
            $pdo = null;
            
            return $result;
        }


        function createProfile($userid, $skills, $bio, $videoid, $profilepic, $portfoliolink, $portfoliopath, $facebook, $instagram, $youtube, $pinterest) {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();

            $sql = "INSERT INTO profile (userid, skills, bio, videoid, profilepic, portfoliolink, portfoliopath, facebook, instagram, youtube, pinterest) 
            VALUES (:userid, :skills, :bio, :videoid, :profilepic, :portfoliolink, :portfoliopath, :facebook, :instagram, :youtube, :pinterest);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindParam(':skills', $skills, PDO::PARAM_STR);
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':videoid', $videoid, PDO::PARAM_STR);
            $stmt->bindParam(':profilepic', $profilepic, PDO::PARAM_STR);
            $stmt->bindParam(':portfoliolink', $portfoliolink, PDO::PARAM_STR);
            $stmt->bindParam(':portfoliopath', $portfoliopath, PDO::PARAM_STR);

            $stmt->bindParam(':facebook', $facebook, PDO::PARAM_STR);
            $stmt->bindParam(':instagram', $instagram, PDO::PARAM_STR);
            $stmt->bindParam(':youtube', $youtube, PDO::PARAM_STR);
            $stmt->bindParam(':pinterest', $pinterest, PDO::PARAM_STR);

            $status = $stmt->execute();
    
            $stmt = null;
            $pdo = null;
            
            return $status;
        }

        function deleteAllIndivRole($userid) {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();

            $sql = " DELETE FROM role WHERE userid = :userid;";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            
            $status = $stmt->execute();
    
            $stmt = null;
            $pdo = null;
            
            return $status;
        }

        function addIndivRole($userid, $rolename) {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();

            $sql = "INSERT INTO role (userid, rolename) VALUES (:userid, :rolename);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindParam(':rolename', $rolename, PDO::PARAM_STR);
            
            $status = $stmt->execute();
    
            $stmt = null;
            $pdo = null;
            
            return $status;
        }


        function updateProfile($userid, $skills, $bio, $videoid, $profilepic, $portfoliolink, $portfoliopath, $facebook, $instagram, $youtube, $pinterest) {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();

            $sql = "UPDATE profile SET 
                skills = :skills, 
                bio = :bio, 
                videoid = :videoid, 
                profilepic = :profilepic, 
                portfoliolink = :portfoliolink, 
                portfoliopath = :portfoliopath,

                facebook = :facebook,
                instagram = :instagram,
                youtube = :youtube,
                pinterest = :pinterest

            WHERE userid = :userid;";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindParam(':skills', $skills, PDO::PARAM_STR);
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':videoid', $videoid, PDO::PARAM_STR);
            $stmt->bindParam(':profilepic', $profilepic, PDO::PARAM_STR);
            $stmt->bindParam(':portfoliolink', $portfoliolink, PDO::PARAM_STR);
            $stmt->bindParam(':portfoliopath', $portfoliopath, PDO::PARAM_STR);

            $stmt->bindParam(':facebook', $facebook, PDO::PARAM_STR);
            $stmt->bindParam(':instagram', $instagram, PDO::PARAM_STR);
            $stmt->bindParam(':youtube', $youtube, PDO::PARAM_STR);
            $stmt->bindParam(':pinterest', $pinterest, PDO::PARAM_STR);

            $status = $stmt->execute();
    
            $stmt = null;
            $pdo = null;
            
            return $status;
        }

        // populating fields
        function getRoles() {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();
            $sql = "select distinct rolename from role;";
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $stmt->execute();
        
            $result = [];
            while($row = $stmt->fetch()){
                $result[] = $row[0];
            }
        
            $stmt = null;
            $pdo = null;
            
            return $result;
        }

        function getLocations() {
            $conn = new Connection_Manager();
            $pdo = $conn->getConnection();
            $sql = "select distinct country from user;";
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $stmt->execute();
        
            $result = [];
            while($row = $stmt->fetch()){
                $result[] = $row[0];
            }
        
            $stmt = null;
            $pdo = null;
            
            return $result;
        }


    }
?>