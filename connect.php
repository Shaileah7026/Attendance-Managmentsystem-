<?php
$database="project";
$conn = new mysqli("localhost", "root", "", "project");

if ($conn->connect_error) {
    die('Cannot connect to server: ' . $conn->connect_error);
}

?>