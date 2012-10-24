<?php
require_once 'ppg.f.database.php';
$result = '';
$row = '';  
$foundit = 0;
//$result = mysql_query("UPDATE orders SET shipping_status = ''");
//$result = mysql_query("UPDATE emailtodb_email SET order_status = 'Approved' WHERE order_status='Activated'");
//$result = mysql_query("DELETE FROM email_index");
//$result = mysql_query("DELETE FROM emailtodb_email");
echo "CHECKING ACTIVATED \n";
$result = mysql_query("SELECT * FROM orders WHERE merchant_id <> '0' AND order_status <> 'Activated'");
echo "$result \n";
while ($row = mysql_fetch_array($result))
{
	//echo mysql_num_rows($result2)."\n";
	$merchant_id = $row['merchant_id'];
	$number_processed = $row['number_processed'];
	$order_status = $row['order_status'];
	if ($number_processed >= 1 && $order_status != 'Activated'){
		$doit = mysql_query("UPDATE orders SET order_status='Activated' WHERE merchant_id='$merchant_id'");
		echo "$doit = mysql_query(UPDATE orders SET order_status = 'Activated' WHERE merchant_id = '$merchant_id')\n";
	}
}



	$result = mysql_query("SELECT * FROM emailtodb_email WHERE Subject = 'PayProTec Shipping Confirmation' AND Munged <> 'true' ");
	while ($row = mysql_fetch_array($result))
	{
		$tracking = '';
$shipping_date = '';
$formated_body ='';
$new_body ='';
	$ID = trim($row['ID']);
	$subject = $row['Subject'];
	$body = $row['Message'];
	$insert_date = $row['DateE'];
	$munged = $row['Munged'];
	$new_body= explode('utf-8',$body);
	$formated_body = $new_body[1];
	$formated_body = explode('=',$formated_body);
	$formated_body = base64_decode($formated_body[0]);
	
	$tracking = explode('<td>UPS</td>',$formated_body);
	$tracking = explode('<td>',$tracking[1]);
	$tracking = explode('</td>',$tracking[1]);
	$tracking = trim($tracking[0]);
	print $tracking;
	$shipped_date = explode('<td>Shipped</td>',$formated_body);
	$shipped_date = explode('</td>',$shipped_date[1]);
	$shipped_date = str_replace('<td>', '', $shipped_date[0]) ;
	$shipped_date = trim($shipped_date);

	
	$formated_body = explode('MID # </strong></span><strong>',$formated_body);
	$formated_body = explode('</strong>',$formated_body[1]);
	$formated_body = trim($formated_body[0]);
	//print $formated_body[0];
		
		$result_shipping_update= mysql_query("UPDATE orders SET order_status='Shipped',shipping_status='Shipped',tracking='$tracking',shipped_date='$shipped_date' WHERE merchant_id LIKE '%$formated_body%'");
		if ($result_shipping_update == 1){
			$result_munged_update= mysql_query("UPDATE emailtodb_email SET Munged='true' WHERE ID='$ID'");
			echo " $formated_body updated \n ";
		}
	}
 

$result_orders = mysql_query("SELECT * FROM orders WHERE merchant_id <> '0'");
while ($row_orders = mysql_fetch_array($result_orders))
{
	$merchant_id = $row_orders['merchant_id'];
	$result = mysql_query("SELECT * FROM emailtodb_email WHERE Munged <> 'true' AND (Subject LIKE '%$merchant_id%' OR Message LIKE '%$merchant_id%')");
	while ($row = mysql_fetch_array($result))
	{
		echo "$merchant_id \n";
		$ID = trim($row['ID']);
		$subject = $row['Subject'];
		$body = $row['Message'];
		$body_html = $row['Message_html'];
		$insert_date = $row['DateE'];
		$munged = $row['Munged'];
	
		if(strtolower($subject) == 'payprotec shipping'){
			$doit = mysql_query("UPDATE orders SET order_status = 'Shipped' WHERE merchant_id LIKE '%$merchant_id%' AND order_status <> 'Activated'");
			echo "$doit = mysql_query(UPDATE orders SET order_status = 'Shipped' WHERE merchant_id LIKE '%$merchant_id%' AND order_status <> 'Activated') \n";
		}
			
		$result_email_index = mysql_query("SELECT pkey FROM email_index WHERE ID ='$ID'");
		$foundit = mysql_num_rows($result_email_index);
			echo "$foundit \n";
		if ($foundit <= 0){
			echo "mysql_query(\"INSERT INTO email_index (merchant_id,ID,subject,insert_date)values('$merchant_id','$ID','$subject','$insert_date')\") \n";
			$doit = mysql_query("INSERT INTO email_index (merchant_id,ID,subject,insert_date)values('$merchant_id','$ID','$subject','$insert_date')");	
			echo mysql_error()."\n";
		}
		
		echo "$doit = mysql_query(UPDATE emailtodb_email SET Munged = 'true' WHERE ID = '$ID') \n";	
		$doit = mysql_query("UPDATE emailtodb_email SET Munged = 'true' WHERE ID = '$ID'");	
	}
		
}
echo mysql_error();	
	
			
	

function instr($needle,$haystack){
	if (strripos($haystack,$needle) !== '' && strripos($haystack,$needle) !== false)
	{
		return true;
	}
	else
	{
		return false;
	}
}
  
?>