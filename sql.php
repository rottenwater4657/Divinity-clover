<?php

function conntodb()
{
    $host = "localhost";
    $username = "root";
    $password = null; // or "" if needed
    $database = "login";

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    return $conn;
}
?>