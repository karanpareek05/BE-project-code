<?php
date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect('localhost','root','','spms');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

