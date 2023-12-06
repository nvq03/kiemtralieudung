<?php
$mysqli = new mysqli("localhost","root","","kiemtralieudung");

// Check connection
if ($mysqli->connect_errno) {
  echo "Kết Nối Mysql lỗi " . $mysqli->connect_error;
  exit();
}
?>  