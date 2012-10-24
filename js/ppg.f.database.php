<?php
$sqllogin = 'PPG_CRM';
$sqlpassword = 'PPG_CRM123';
$host = 'localhost';
$db = 'PPG_CRM';	

$con = mysql_connect($host,$sqllogin,$sqlpassword);
	
if (!$con){
		die('Could not connect: ' . mysql_error());
}		
mysql_select_db($db, $con);

?>