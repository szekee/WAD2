<?php
    require_once "common.php";

    class ProfileDAO {

        // function retrieveAll() {
        //     $conn = new ConnectionManager();
        //     $pdo = $conn->getConnection();
        //     $sql = "select u.userid, name, email, address, country, gender, phone, skills, bio, portfoliolink, portfoliopath from user u, profile p where u.userid = p.userid;";
        //     $stmt = $pdo->prepare($sql);
        //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //     $stmt->execute();
        //     $result = [];

        //     while($row = $stmt->fetch()){
        //         $result[] = new Profile($row['userid'], $row['name'], [], $row['email'], $row['address'], $row['country'], $row['gender'], $row['phone'], $row['skills'], $row['bio'], $row['portfoliolink'], $row['portfoliopath']);
        //     }

        //     $stmt = null;
        //     $pdo = null;
            
        //     return $result;
        // }

        function getAll() {
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = "select u.userid, name, rolename, email, address, country, gender, phone, skills, bio, profilepic, portfoliolink, portfoliopath from user u, profile p, role r where u.userid = p.userid and u.userid = r.userid;";
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
                $result[] = new Profile($id, $row[0]['name'], $role, $row[0]['email'], $row[0]['address'], $row[0]['country'], $row[0]['gender'], $row[0]['phone'], $row[0]['skills'], $row[0]['bio'], $row[0]['profilepic'], $row[0]['portfoliolink'], $row[0]['portfoliopath']);
            }

            $stmt = null;
            $pdo = null;
            
            return $result;
        }

        function getRoles() {
            $conn = new ConnectionManager();
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
            $conn = new ConnectionManager();
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