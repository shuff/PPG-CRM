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

$edb = new EMAIL_TO_DB();
$edb->connect('imap.gmail.com:993', '/imap/ssl/novalidate-cert', 'username@gmail.com', 'password');
echo $edb->getNumNewMessages();
$edb->close();

?>