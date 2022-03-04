<?php
require 'config.php';

$memberId = $_POST['memberId'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$occupation = $_POST['occupation'];

$sql = "UPDATE members SET m_name='$name', m_email='$email', m_contact='$contact', m_occupation='$occupation' WHERE m_id='$memberId'";

if ($conn->query($sql) === TRUE) {
  echo "Member information updated";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
