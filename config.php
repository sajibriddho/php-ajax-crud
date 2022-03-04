<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "php-ajax-crud";

// Create connection
$conn = new mysqli($server, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
}
