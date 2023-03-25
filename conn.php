<?php
$servername = "localhost";
    $username = "root";
    $pass = "123";
    $dbname = "gobble";
    

    // Create connection
    $conn = new mysqli($servername,$username, $pass, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: ". $conn->connect_error);
    }
    ?>