<?php

//This will be used in the future for the UBC server connection instead of my local one

// $servername = "localhost";
// $username = "13290333";
// $password = "13290333";
// $dbname = "db_13290333";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myblog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>