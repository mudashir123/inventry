<?php
// Enter your Host, username, password, database below.
//$con = mysqli_connect("localhost","vacademy_utest","FhKOcRbh40n)","vacademy_test");
$conn = mysqli_connect("localhost","root","","inventry");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
    date_default_timezone_set('Asia/Kolkata');
?>