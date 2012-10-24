<?
/**
  * Author: Ted Hayes
	* Based on code by: Ernest Wojciuk
	* Web Site: www.liminastudio.com
	*/

include_once("class.emailtodb_tedb0t.php");

$cfg["db_host"] = 'localhost';
$cfg["db_user"] = 'db_user';
$cfg["db_pass"] = 'db_pass';
$cfg["db_name"] = 'db_name';

$mysql_pconnect = mysql_pconnect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
if(!$mysql_pconnect){echo "Connection Failed"; exit; }
$db = mysql_select_db($cfg["db_name"], $mysql_pconnect);
if(!$db){echo"DB Select Failed"; exit;}

echo "Connected to database.<br>";

//// EMPTY TABLES ////
mysql_query("TRUNCATE TABLE `emailtodb_attach`");
mysql_query("TRUNCATE TABLE `emailtodb_dir`");
mysql_query("TRUNCATE TABLE `emailtodb_email`");
mysql_query("TRUNCATE TABLE `emailtodb_list`");
mysql_query("TRUNCATE TABLE `emailtodb_log`");
mysql_query("TRUNCATE TABLE `emailtodb_words`");
//////////////////////

$edb = new EMAIL_TO_DB();
$edb->connect('imap.gmail.com:993', '/imap/ssl/novalidate-cert', 'username@gmail.com', 'password');
echo "Connected to IMAP server, starting update.<br>";
$edb->db_update();
echo "Finished, closing connection.";
$edb->close();

?>