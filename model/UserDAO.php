<?php
    require_once "common.php";

    class UserDAO {

        function retrieveAll(){
            $conn = new ConnectionManager();
            $pdo = $conn->getConnection();
            $sql = "Select * from user";
            $stmt = $pdo->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $stmt->execute();
            $result = [];
            while($row = $stmt->fetch()){
                $result[] = new User($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
            }
            $stmt = null;
            $pdo = null;
            
            return $result;
        }

    }
?>