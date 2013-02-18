<?php
/**
	* Web Site: www.liminastudio.com
	*/

include_once("class.emailtodb.php");

$cfg["db_host"] = 'localhost';
$cfg["db_user"] = 'PPG_CRM';
$cfg["db_pass"] = 'PPG_CRM123';
$cfg["db_name"] = 'PPG_CRM';

$mysql_pconnect = mysql_pconnect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
if(!$mysql_pconnect){echo "Connection Failed"; exit; }
$db = mysql_select_db($cfg["db_name"], $mysql_pconnect);
if(!$db){echo"DB Select Failed"; exit;}

echo "Connected to database.<br>";

//// EMPTY TABLES ////
/*
 * mysql_query("TRUNCATE TABLE `emailtodb_attach`");
mysql_query("TRUNCATE TABLE `emailtodb_dir`");
mysql_query("TRUNCATE TABLE `emailtodb_email`");
mysql_query("TRUNCATE TABLE `emailtodb_list`");
mysql_query("TRUNCATE TABLE `emailtodb_log`");
mysql_query("TRUNCATE TABLE `emailtodb_words`");

*/
$edb = new EMAIL_TO_DB();
$edb->connect('imap.gmail.com:993', '/imap/ssl/novalidate-cert', 'info@patriotpaymentgroup.com', 'ADD PASSWORD HERE');
echo "Connected to IMAP server, starting update.<br>";
$edb->db_update();
echo "Finished, closing connection.";
$edb->close();

?>