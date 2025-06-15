<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'register_php';

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die(''. $conn->connect_error);
}
?>