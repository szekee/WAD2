<?php
class ConnectionManager {

public function getConnection() {
    $dsn = "mysql:host=localhost;dbname=wad2proj";
    $pdo = new PDO($dsn, "root", ""); 
    return $pdo;
}
}
?>