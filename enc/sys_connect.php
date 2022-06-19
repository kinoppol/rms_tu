<?php
$hostname = "localhost"; 
$user = "root"; 
$password = "bncc2019!"; 
$dbname = "rms2012"; 
$destination_path = 'files';
mysql_connect($hostname,$user,$password) or die("Can not Connect MYSQL");
mysql_query("SET NAMES tis620");
mysql_select_db($dbname) or die("Can not Connect DB");
?>
