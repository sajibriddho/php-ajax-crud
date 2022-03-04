<?php
require 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$occupation = $_POST['occupation'];

$sql = "INSERT INTO members(m_name, m_email, m_contact, m_occupation)
VALUES ('$name', '$email', '$contact', '$occupation')";

if ($conn->query($sql) === TRUE) {
  echo "New member inserted";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

