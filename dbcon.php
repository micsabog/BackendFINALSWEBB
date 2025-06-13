<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'your_database_name';

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die(''. $conn->connect_error);
}
?>