<?php
require 'config.php';

$memberId = $_POST['memberId'];


$sql = "DELETE FROM members WHERE m_id = '$memberId';";
echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "Member Deleted";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}