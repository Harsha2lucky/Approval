<?php
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "opas";
    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed due to: " . $conn->connect_error);
    }
?>