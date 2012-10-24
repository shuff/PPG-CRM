<?php

//set_error_handler('fileErrorHandler');

include "goodies.class.php";

//connect to database
$c = new goodies;
$sqllogin = $c->getlogin();
$d = new goodies;
$sqlpassword = $d->getpassword();
$e = new goodies;
$host = $e->gethost();
$f = new goodies;
$db = $f->getdbname();
$con = mysql_connect("$host","$sqllogin","$sqlpassword");
if (!$con)
{
	echo "Could not connect:"  . mysql_error();
	die();
}
else
{


$MY_DB = 'PPG_CRM';



echo "hello world, I am creating your new database $MY_DB !<br><br>";

//*******************************************
// 				DROP DATABASE
//*******************************************
if (mysql_query("DROP DATABASE $MY_DB",$con))
{
	echo "Database dropped<br>";
}
else
{
	echo "Error dropping database:<br> " . mysql_error();
}
//*******************************************
// 				CREATE DATABASE
//*******************************************
if (mysql_query("CREATE DATABASE $MY_DB",$con))
{
	echo "Database created<br>";
}
else
{
	echo "Error creating database:<br> " . mysql_error();
}
//*******************************************
// 				CREATE TABLES
//*******************************************
////***********************
//		EMAIL_INDEX
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE email_index
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id varchar(100),
ID	varchar(50),
subject	varchar(255),
insert_date varchar(25),
payment_timestamp	timestamp
)";

// Execute query
echo "<br>Creating payouts = ";
$doit = mysql_query($sql,$con);
echo $doit;
////***********************
//		transaction History
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE transaction_history
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id varchar(100),
amount_processed	varchar(50),
number_processed	varchar(50),
timestamp varchar(50)
)";

// Execute query
echo "<br>Creating transaction history = ";
$doit = mysql_query($sql,$con);
echo $doit;
////***********************
//		PAYMENTS
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE payouts
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
payment_id varchar(50),
orders_id	varchar(50),
rep_id	varchar(50),
commission_total varchar(11),
payment_timestamp	timestamp
)";

// Execute query
echo "<br>Creating payouts = ";
$doit = mysql_query($sql,$con);
echo $doit;
////***********************
//		PENDING PAYOUTS
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE pending_payouts
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
payment_id varchar(50),
orders_id	varchar(50),
rep_id	varchar(50)

)";
/*
// Execute query
echo "<br>Creating pending_payouts = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		PAYMENT
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE payment
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id varchar(50),
payment_status	varchar(20),
rep_id	varchar(50),
commission_total varchar(11),
commission_amount_paid varchar(11),
commission_paid_date varchar(15),
payment_received_date varchar(15),
payment_due_date  varchar(15),
ppg_payment_total varchar(11),
payment_amount_received varchar(11),
ballance_due varchar(11),
amount_due_rep varchar(11),
amount_due_ppg varchar(11),
payment_timestamp	timestamp
)";

// Execute query
echo "<br>Creating payment = ";
$doit = mysql_query($sql,$con);
echo $doit;
*/
////***********************
//		Rep
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE rep
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
rep_id varchar(25),
rep_name varchar(50),
rep_email varchar(100),
rep_phone varchar(15),
rep_street varchar(255),
rep_zipcode varchar(255),
rep_city varchar(255),
rep_state varchar(2),

payment_timestamp	timestamp
)";

// Execute query
echo "<br>Creating rep = ";
$doit = mysql_query($sql,$con);
echo $doit;

/*
////***********************
//		Shipping
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE shipping
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id varchar(50),
tracking varchar(50),
carrier varchar(25),
shipping_status varchar(25),
shipping_notes mediumtext,
shipping_timestamp	timestamp
)";

// Execute query
echo "<br>Creating shipping = ";
$doit = mysql_query($sql,$con);
echo $doit;
*/

////***********************
//		Order
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE orders
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id	varchar(100),
rep_id  varchar(50),
shipped_date varchar(25),
order_notes 	mediumtext,
original_application	mediumtext,
order_status  varchar(25),
lead_source varchar(100),
processor  varchar(100),
type varchar(100),
pricing_structure  varchar(100),
equipment_setup  varchar(100),
terminal_type  varchar(100),
pin_debit varchar(100),
monthly_service_fee  varchar(11),
qual_discount_rate  varchar(11),
authorization_fee  varchar(11),
setup_fee_one_time  varchar(11),
annual_fee  varchar(11),
date_submitted varchar(25),
date_approved  varchar(25),
date_activated  varchar(25),
date_last_updated varchar(25),
contact_name  varchar(100),
contact_email  varchar(100),
contact_phone  varchar(15),
contact_cell  varchar(15),
contact_street  varchar(100),
contact_city  varchar(100),
contact_state  varchar(2),
contact_zip  varchar(15),
company_name  varchar(50),
company_email	varchar(100),
company_phone varchar(15),
company_street varchar(50),
company_city 	varchar(50),
company_state  varchar(2),
company_zip		varchar(15),
company_notes	mediumtext,
company_country	varchar(50),
amount_processed varchar(50),
number_processed varchar(50),
company_status_code varchar(10),
amounts_since varchar(50),
tracking varchar(50),
carrier varchar(25),
shipping_status varchar(25),
shipping_notes mediumtext,
payment_status	varchar(20),
commission_total varchar(11),
commission_amount_paid varchar(11),
commission_paid_date varchar(15),
payment_received_date varchar(15),
payment_due_date  varchar(15),
ppg_payment_total varchar(11),
payment_amount_received varchar(11),
ballance_due varchar(11),
amount_due_rep varchar(11) DEFAULT '0',
amount_due_ppg varchar(11),
unknown_field varchar(25),
enabled varchar(4) DEFAULT 'yes',
order_timestamp	timestamp
)";

// Execute query
echo "<br>Creating order = ";
$doit = mysql_query($sql,$con);
echo $doit;




////***********************
//		CONTACT
////***********************
// Create table    
/*
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE contact
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id  varchar(50),
contact_name  varchar(100),
contact_email  varchar(100),
contact_phone  varchar(15),
contact_cell  varchar(15),
contact_street  varchar(100),
contact_city  varchar(100),
contact_state  varchar(2),
contact_zip  varchar(15),
contact_timestamp timestamp
)";

// Execute query
echo "<br>Creating contact = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		Company
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE company
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
merchant_id	varchar(100),
company_name  varchar(50),
company_email	varchar(100),
company_phone varchar(15),
company_street varchar(50),
company_city 	varchar(50),
company_state  varchar(2),
company_zip		varchar(15),
company_notes	mediumtext,
company_country	varchar(50),
amount_processed varchar(50),
number_processed varchar(50),
company_status_code varchar(10),
amounts_since varchar(50),
unknown_field varchar(25),

company_timestamp	varchar(50)
)";

// Execute query
echo "<br>Creating company = ";
$doit = mysql_query($sql,$con);
echo $doit;
*/
////***********************
//		CLIENT
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE client
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
client_username varchar(50),
client_password varchar(25),
client_enabled varchar(3) DEFAULT 'yes',
client_id varchar(50),
client_name  varchar(50),
client_email	varchar(100),
client_phone varchar(15),
client_street varchar(50),
client_city 	varchar(50),
client_state  varchar(2),
client_zip		varchar(15),
client_notes	mediumtext,
timestamp	timestamp
)";



// Execute query
echo "<br>Creating client = ";
$doit = mysql_query($sql,$con);
echo $doit;
////***********************
//		FLAGGED
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE flagged
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
client_id varchar(25),
merchant_id varchar(100),
timestamp	timestamp
)";



// Execute query
echo "<br>Creating client = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		STATES
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE states
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
name	varchar(2)
)";

// Execute query
echo "<br>Creating states = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		GROUP_ADMIN
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE group_admin
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
name varchar(15) DEFAULT 'Admin',
client_id varchar(25)
)";

// Execute query
echo "<br>Creating group_admin = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		GROUP_REP
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE group_rep
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
name varchar(15) DEFAULT 'Representative',
client_id varchar(25)
)";
// Execute query
echo "<br>Creating group_rep = ";
$doit = mysql_query($sql,$con);
echo $doit;
////***********************
//		Lead list
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE lead_list
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
name varchar(25)
)";
// Execute query
echo "<br>Creating lead_list = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		order status list
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE order_status_list
(
pkey int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (pkey),
order_code varchar(25) DEFAULT 'Submitted'
)";
// Execute query
echo "<br>Creating order_status_list = ";
$doit = mysql_query($sql,$con);
echo $doit;

////***********************
//		payment status list
////***********************
// Create table
mysql_select_db("$MY_DB", $con);
$sql = "CREATE TABLE payment_status_list
(
payment_status_id int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (payment_status_id),
payment_code varchar(25) DEFAULT 'Not Paid'
)";
// Execute query
echo "<br>Creating payment_status_list = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_email` (
  `ID` int(11) NOT NULL auto_increment,
  `IDEmail` varchar(255) NOT NULL default '0',
  `EmailFrom` varchar(255) NOT NULL default '',
  `EmailFromP` varchar(255) NOT NULL default '',
  `EmailTo` varchar(255) NOT NULL default '',
  `DateE` datetime NOT NULL default '0000-00-00 00:00:00',
  `DateDb` datetime NOT NULL default '0000-00-00 00:00:00',
  `DateRead` datetime NOT NULL default '0000-00-00 00:00:00',
  `DateRe` datetime NOT NULL default '0000-00-00 00:00:00',
  `Status` tinyint(3) NOT NULL default '0',
  `Type` tinyint(3) NOT NULL default '0',
  `Del` tinyint(3) NOT NULL default '0',
  `Subject` varchar(255) default NULL,
  `Message` text  NOT NULL,
  `Message_html` text  NOT NULL,
  `MsgSize` int(11) NOT NULL default '0',
  `Kind` tinyint(2) NOT NULL default '0',
  `IDre` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `IDEmail` (`IDEmail`),
  KEY `EmailFrom` (`EmailFrom`)
) ENGINE=MyISAM";

// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_dir` (
  `IDdir` int(11) NOT NULL auto_increment,
  `IDsubdir` int(11) NOT NULL default '0',
  `Sort` int(11) NOT NULL default '0',
  `Name` varchar(25) NOT NULL default '',
  `Status` tinyint(3) NOT NULL default '0',
  `CatchMail` varchar(150) NOT NULL default '',
  `Icon` varchar(250)  NOT NULL default '',
  PRIMARY KEY  (`IDdir`),
  KEY `IDsubdir` (`IDsubdir`)
) ENGINE=MyISAM";

// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_list` (
  `IDlist` int(11) NOT NULL auto_increment,
  `Email` varchar(255) NOT NULL default '',
  `Type` char(2) NOT NULL default 'B',
  PRIMARY KEY  (`IDlist`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM";


// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_log` (
  `IDlog` int(11) NOT NULL auto_increment,
  `IDemail` int(11) NOT NULL default '0',
  `Email` varchar(150) NOT NULL default '',
  `Info` varchar(255)  NOT NULL default '',
  `FSize` int(11) NOT NULL default '0',
  `Date_start` datetime NOT NULL default '0000-00-00 00:00:00',
  `Date_finish` datetime NOT NULL default '0000-00-00 00:00:00',
  `Status` int(3) NOT NULL default '0',
  `Dif` int(11) NOT NULL default '0',
  PRIMARY KEY  (`IDlog`)
) ENGINE=MyISAM";

// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_words` (
  `IDw` int(11) NOT NULL auto_increment,
  `Word` varchar(100)  NOT NULL default '',
  PRIMARY KEY  (`IDw`),
  KEY `Word` (`Word`)
) ENGINE=MyISAM";

// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;

mysql_select_db("$MY_DB", $con);

$sql = "CREATE TABLE `emailtodb_attach` (
  `ID` int(11) NOT NULL auto_increment,
  `IDEmail` int(11) NOT NULL default '0',
  `FileNameOrg` varchar(255) NOT NULL default '',
  `Filename` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `IDEmail` (`IDEmail`)
) ENGINE=MyISAM";
    
// Execute query
echo "<br>Creating email = ";
$doit = mysql_query($sql,$con);
echo $doit;


//*******************************************
// 				LOAD DATA
//*******************************************





echo "<br><br>Importing data <br><br> ";
include 'data.php';




}


?>