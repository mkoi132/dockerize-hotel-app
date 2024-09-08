<?php
// if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "hotel";
// } else {
//     $servername = "talsprddb02.int.its.rmit.edu.au";
//     $username = "s3871704";
//     $password = "";
//     $dbname = "s3871704";
// }
// Create connection
$connection = new mysqli('db', 'master-user', 'docker-compose1', 'hotel');
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
