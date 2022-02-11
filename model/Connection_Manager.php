<?php
class Connection_Manager {
    public function getConnection() {
        $servername = 'localhost';
        $dbname = 'wad2proj';
        $username ='wad2';
        $password = 'wad2';
        
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);     
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if fail, exception will be thrown

        // Return connection object
        return $conn;

    }
}
?>
