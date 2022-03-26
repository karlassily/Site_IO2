<?php


$host="localhost";
$username="root";
$password="";
$database="Site_IO2";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>