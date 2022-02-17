<?php
try {
  date_default_timezone_set('Asia/Kolkata');
  $conn = mysqli_connect('localhost','root','','spms');
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
} catch (\Throwable $th) {
  date_default_timezone_set('Asia/Kolkata');
  $conn = mysqli_connect('localhost','id17740846_root','18103047@Apsit','id17740846_spms');
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
}
try {
  date_default_timezone_set('Asia/Kolkata');
  $conn = mysqli_connect('localhost','id17740846_root','18103047@Apsit','id17740846_spms');
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
} catch (\Throwable $th) {
  date_default_timezone_set('Asia/Kolkata');
  $conn = mysqli_connect('localhost','root','','spms');
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
}




?>




