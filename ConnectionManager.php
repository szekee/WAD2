<?php
class ConnectionManager {

public function getConnection() {
    $dsn = "mysql:host=localhost;dbname=wad2proj";
    $pdo = new PDO($dsn, "wad2", "wad2"); 
    return $pdo;
}
}
?>
