<?php


$databasehost = "localhost";
$databasecode = "PPG_CRM";
$databasetable = "states";
$databaseusercode ="the_duke";
$databasepassword = "oudonotknow";
$fieldseparator = ",";
$lineseparator = "\n";
$csvfile = "states.txt";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 0;
$outputfile = "output.sql";
/********************************/


if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}

$csvcontent = fread($file,$size);

fclose($file);

$con = @mysql_connect($databasehost,$databaseusercode,$databasepassword) or die(mysql_error());
@mysql_select_db($databasecode) or die(mysql_error());

$lines = 0;
$queries = "";
$linearray = array();
$first_run = 'complete';
foreach(split($lineseparator,$csvcontent) as $line) {

	$lines++;

	$line = trim($line," \t");
	
	$line = str_replace("\r","",$line);
	
	/**********************************************
	This line escapes the special character. remove it if entries are already escaped in the csv file
	************************************/
	$line = str_replace("'","\'",$line);
	/*************************************/
	
	$linearray = explode($fieldseparator,$line);
	
	$linemysql = implode("','",$linearray);
	
	if ($first_run != 'complete'){
	if($addauto)
		$query = "insert into $databasetable (name) values('','$linemysql');";
	else
		$query = "insert into $databasetable (name) values('$linemysql');";
	
	$queries .= $query . "\n";

	@mysql_query($query); 
	}
	$first_run = 'start';
}





if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}

echo "Found a total of $lines records in this csv file.<br><br>";

echo "creating all the unique IDs \n";

	$result = mysql_query("SELECT * FROM client");

	while($row = mysql_fetch_array($result))
	{
		$random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',12)),0,12);
		$random2 = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',6)),0,6);
		
		if ($row['id'] == '')
		{
			$id = $row['id']; 
			$pkey =  $row['pkey']; 
			$doit = mysql_query("UPDATE client SET id = '$random' WHERE pkey = '$pkey'");
			echo "<br>inserting $random2";
			$doit2 = mysql_query("UPDATE client SET password = '$random2' WHERE pkey = '$pkey'");
		}

	}





echo "<br><br>making updates <br><br>";

//$result = mysql_query("UPDATE client SET facebook_id = '100001876142482' WHERE name = 'Shannon Huff'");
//echo "<br>" . $result;
//$result = mysql_query("UPDATE client SET password = '123' WHERE name = 'Shannon Huff'");
$result = mysql_query("INSERT INTO client (client_name,client_id,client_username,client_password,client_enabled,client_phone,client_street,client_state,client_zip,client_notes) VALUES ('Shannon Huff','123dke9wma9q','shuff@twumc.org','123','yes','333-333-3333','10603 shadow wood','TX','77098','shannon is cool')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO client (client_name,client_id,client_username,client_password,client_enabled,client_phone,client_street,client_state,client_zip,client_notes) VALUES ('Shannon Huff2','2','shuff@twumc2.org','123','yes','333-333-3333','10603 shadow wood','TX','77098','shannon is cool')");
echo "<br>" . $result;


$result = mysql_query("INSERT INTO group_rep (client_id) VALUES ('123dke9wma9q')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO group_admin (client_id) VALUES ('123dke9wma9q')");
echo "<br>" . $result;
//$result = mysql_query("INSERT INTO orders (orders_id,company_id,payment_id,rep_id) VALUES ('1','1','1','1')");
//echo "<br>" . $result;

/*
$result = mysql_query("INSERT INTO orders (merchant_id,rep_id,amount_due_from_merchant,
amount_due_to_ppg,amount_due_rep,order_notes,
original_application,order_status,lead_source,processor,type,pricing_structure,equipment_setup,
terminal_type,pin_debit,monthly_service_fee,qual_discount_rate,
authorization_fee,setup_fee_one_time,annual_fee,date_submitted,
date_approved,date_activated) VALUES ('0','123dke9wma9q','0','0','0','order_notes','orgnial_application',
'order_status','lead_source','processor','type','pricing_structure','equipment_setup',
'terminal_type','pin_debit','0','0','0','0','0','date_submitted','date_approved','date_activated')");
echo "<br>" . $result;

$result = mysql_query("INSERT INTO orders (merchant_id,rep_id,amount_due_from_merchant,
amount_due_to_ppg,amount_due_rep,order_notes,
original_application,order_status,lead_source,processor,type,pricing_structure,equipment_setup,
terminal_type,pin_debit,monthly_service_fee,qual_discount_rate,
authorization_fee,setup_fee_one_time,annual_fee,date_submitted,
date_approved,date_activated) VALUES ('2','123dke9wma9q','2','2','2','order_notes','orgnial_application',
'order_status','lead_source','processor','type','pricing_structure','equipment_setup',
'terminal_type','pin_debit','0','0','0','0','0','date_submitted','date_approved','date_activated')");
echo "<br>" . $result;
*/

$result = mysql_query("INSERT INTO orders (pkey,merchant_id,rep_id) VALUES ('0','0','0')");
echo "<br>" . $result;
/*
$result = mysql_query("INSERT INTO payment (pkey,merchant_id,rep_id) VALUES ('0','0','0')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO company (pkey,merchant_id) VALUES ('0','0')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO contact (pkey,merchant_id) VALUES ('0','0')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO client (pkey,merchant_id) VALUES ('0','0')");
echo "<br>" . $result;
*/
$result = mysql_query("INSERT INTO lead_list (name) VALUES ('Casey')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO lead_list (name) VALUES ('PPG Rep')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO group_rep (client_id) VALUES ('0')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO shipping  (pkey,merchant_id) VALUES ('0','0')");

$result = mysql_query("INSERT INTO payment_status_list (payment_code) VALUES ('paid')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO payment_status_list (payment_code) VALUES ('unpaid')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO payment_status_list (payment_code) VALUES ('payable')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Submitted')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Pending')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Fraud')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Withdrawn')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Declined')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Approved')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Activation')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Activated')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO order_status_list (order_code) VALUES ('Shipped')");
echo "<br>" . $result;

/*
$result = mysql_query("INSERT INTO payment (orders_id,payment_id) VALUES ('2','2')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO payment (orders_id,payment_id) VALUES ('2','2')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO company (company_name,company_id,company_email,company_phone,company_street,company_state,company_zip,company_notes) VALUES ('company_name','company_id','company_email','company_phone','company_street','company_state','company_zip','company_notes')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO company (company_name,company_id,company_email,company_phone,company_street,company_state,company_zip,company_notes) VALUES ('company_name2','2','company_email','company_phone','company_street','company_state','company_zip','company_notes')");
echo "<br>" . $result;
$result = mysql_query("INSERT INTO company (company_name,company_id,company_email,company_phone,company_street,company_state,company_zip,company_notes) VALUES ('company_name1','1','company_email','company_phone','company_street','company_state','company_zip','company_notes')");
echo "<br>" . $result;
*/
$result = mysql_query("INSERT INTO rep (rep_id,rep_name,rep_email,rep_phone) VALUES ('1','shannon huff','shuff@tnt.net','713.468.5749')");
$result = mysql_query("INSERT INTO rep (rep_id) VALUES ('0')");
echo "<br>" . $result;
//echo "<br><br>";

//echo "<br><br>";
//include 'data.collateral_items.php';

//echo "<br>importing data2.php<br>";
//include 'data2.php';

?>
