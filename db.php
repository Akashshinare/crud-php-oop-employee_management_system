<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "testdb";

$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}
echo("Connected Successfully");
?>