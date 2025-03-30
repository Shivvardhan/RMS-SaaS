<?php

require "../dbcon.php";

$today = date("Y-m-d");
$table_name = "u_login_log";

$sql = "SELECT COUNT(*) FROM u_login_log ;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $count = $row["COUNT(*)"];
   
} 


$sqls = "SELECT COUNT(*) FROM users WHERE usertype = 'radmin';";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $totalradmin = $rows["COUNT(*)"];
   
} 
$sqls = "SELECT COUNT(*) FROM users WHERE usertype = 'admin';";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $totaladmin = $rows["COUNT(*)"];
   
} 

$sqls = "SELECT COUNT(*) FROM t_users ;";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $totaltacc = $rows["COUNT(*)"];
   
} 
$sqls = "SELECT COUNT(*) FROM users  WHERE l_token = ' ' ;";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $notlogged = $rows["COUNT(*)"];
   
} 



 $sqls = "SELECT COUNT(*) FROM `orders` where timestamp like '$today %';";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $todayordercount = $rows["COUNT(*)"];
   
} 


 $sqls = "SELECT COUNT(*) FROM `orders` ;";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $totalorders = $rows["COUNT(*)"];
   
} 

 $currentdateetime = date('l, F j, Y \a\t g:i:s A');

 

 $sqls = "SELECT COUNT(*) FROM `r_menu` ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $totalmenuitems = $rows["COUNT(*)"];
    
 } 

 $sqls = "SELECT COUNT(*) FROM `r_menu` where timestamp like '$today %' ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $ttotalmenuitems = $rows["COUNT(*)"];
    
 } 

 session_start();
 $uid = $_SESSION['uid'];

 $sqls = "SELECT COUNT(*) FROM `r_table` WHERE uid = $uid ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $utable = $rows["COUNT(*)"];
    
 } 
 $sqls = "SELECT COUNT(*) FROM `r_menu` WHERE uid = $uid ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $rmenu = $rows["COUNT(*)"];
    
 } 
 $sqls = "SELECT COUNT(*) FROM `orders` where timestamp like '$today %' AND uid = $uid ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $todayorderu = $rows["COUNT(*)"];
    
 } 
 $sqls = "SELECT COUNT(*) FROM `orders` where  uid = $uid ;";
 $results = mysqli_query($conn, $sqls);
 
 if (mysqli_num_rows($results) > 0) {
     $rows = mysqli_fetch_assoc($results);
     $todayallorderu = $rows["COUNT(*)"];
    
 } 


// Retrieve analytical data
$data = array(
    'todaylogged' => $count,
    'totalradmin' => $totalradmin,
    'totaladmin' => $totaladmin,
    'totaltacc' => $totaltacc,
    'notlogged' => $notlogged,
    'todayordercount' => $todayordercount,
    'totalorders' => $totalorders,
    'totalorders' => $totalorders,
    'currentdateetime' => $currentdateetime,
    'totalmenuitems' => $totalmenuitems,
    'ttotalmenuitems' => $ttotalmenuitems,
    'utable' => $utable,
    'rmenu' => $rmenu,
    'todayorderu' => $todayorderu,
    'todayallorderu' => $todayallorderu,
   
);

// Encode data into JSON format
$json_data = json_encode($data);

// Return JSON data
echo $json_data;
?>