<?php
$host = 'db'; // Docker service name
$user = 'chatuser';
$pass = 'chatpass';
$dbname = 'chatapp';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

