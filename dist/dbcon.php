<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'systemvista';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
  die('Database connection failed: ' . $db->connect_error);
}
date_default_timezone_set("Asia/Calcutta"); 
?>