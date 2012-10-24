<?php

function my_field_value($table,$field,$pkey_field,$pkey_value)
	{
		//return "$table,$field,$pkey_field,$pkey_value";
		require_once 'ppg.f.database.php';
		$result = '';
		$row = '';
		$foundit = '';
		$result = mysql_query("SELECT * FROM $table WHERE $pkey_field = '$pkey_value'");
			
		while($row = mysql_fetch_array($result))
		{
			$foundit = $row[$field];
		}
			
			return $foundit;
	}
		include('Net/SFTP.php');
 
     $sftp = new Net_SFTP('moveit.nabancard.com');
     if (!$sftp->login('ppg', 'patriot3')) {
         exit('Login Failed');
     }
	 echo $sftp->pwd() . "\r\n";
		//$sftp->lcd('uploads/'); 
	
	//$mystr = '33333,333,666,7777,777,111';
	//$mystr = explode(',',$mystr);
	//echo $mystr[0] ;
	//exit();
	
$files = $sftp->nlist();
foreach ($files as $file)
{
   if (substr($file, -4) == '.csv')
   {// != false) //{
		echo $file."\n";
		$erg = $sftp->lstat($file);
		print_r( $erg );
		$erg = $sftp->get($file, '/home/shuff/ppg/uploads/'.$file);
		printf( "[%s]\n",$erg);
		$row = 1;
	if (($handle = fopen("/home/shuff/ppg/uploads/".$file, "r")) !== FALSE)
	{
	
		require_once 'ppg.f.database.php';
		$result = '';
		date_default_timezone_set('America/Chicago');
	$timestamp = date("m/d/Y h:i:s a", time());

    	while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
        	$num = count($data);
        	echo "<p> $num fields in line $row: <br /></p>\n";
        	$row++;
	        $merchant_id = $data[0];
			$company_name = $data[1];
			$company_status_code = $data[2];
			$amounts_since = $data[3];
			$amount_processed = $data[4];
			$number_processed = $data[5];
			$unknown_field = $data[6];
			
			$company_status_code = $data[2];
			If ($company_status_code == 'A'){$company_status_code = 'Approved';}
			If ($company_status_code == 'PX'){$company_status_code = 'Submitted';}
			If ($company_status_code == 'AX'){$company_status_code = 'Submitted';}
			If ($company_status_code == 'AC'){$company_status_code = 'Submitted';}
			If ($company_status_code == 'C'){$company_status_code = 'Submitted';}
			If ($company_status_code == 'CR'){$company_status_code = 'Submitted';}
			If ($company_status_code == 'P'){$company_status_code = 'Pending';}
			If ($company_status_code == 'D'){$company_status_code = 'Declined';}
			If ($company_status_code == 'F'){$company_status_code = 'Fraud';}
			If ($company_status_code == 'W'){$company_status_code = 'Withdrawn';}

			if (exists('orders','merchant_id',$merchant_id) == FALSE){
				
				//Company
				$result = mysql_query("INSERT INTO orders (pkey,merchant_id,company_name,order_status,amounts_since,amount_processed,number_processed,unknown_field,date_submitted,rep_id,payment_status,shipping_status,date_last_updated)VALUES 
				(NULL,'$merchant_id','$company_name','$company_status_code','$amounts_since','$amount_processed','$number_processed','$unknown_field','$timestamp','0','unpaid','not shipped','$timestamp')");
	//return $result;
				/*
				//Orders			
				$result = mysql_query("INSERT INTO orders (pkey,merchant_id,order_status,date_submitted,rep_id)VALUES 
				(NULL,'$merchant_id','new','$timestamp','0')");


				//Payment
				$result = mysql_query("INSERT INTO payment (pkey,merchant_id,payment_status,rep_id)VALUES(NULL,'$merchant_id','unpaid','0')");
	
				
				//Shipping
				$result = mysql_query("INSERT INTO shipping (pkey,merchant_id,shipping_status)VALUES(NULL,'$merchant_id','not shipped')");

				//Contact
				$result = mysql_query("INSERT INTO contact (merchant_id)VALUES('$merchant_id')");
				

				
			//	//Payment
			//	$result = mysql_query("UPDATE payment SET payment_id='$payment_id' WHERE orders_id = '$orders_id'");
*/
			}
			else
			{	
				//Company
				$result = mysql_query("UPDATE orders SET company_name='$company_name',amounts_since='$amounts_since',amount_processed='$amount_processed',number_processed='$number_processed',unknown_field='$unknown_field', 
				date_last_updated='$timestamp' WHERE merchant_id='$merchant_id'");	
				
				
				
				$status = my_field_value('orders','order_status','merchant_id',$merchant_id);
				
				If ($status == 'Submitted' || $status == 'Declined' || $status == 'Failed' || $status == 'Pending' || $status == 'Fraud' || $status == 'Withdrawn'){
					$result = mysql_query("UPDATE orders SET order_status='$company_status_code', 
					date_last_updated='$timestamp' WHERE merchant_id='$merchant_id'");	
				
				}
			}
			if ($number_processed >= 1 && (get_field_value('orders', 'payment_status', 'merchant_id',$merchant_id) == 'Unpaid' || get_field_value('orders', 'payment_status', 'merchant_id',$merchant_id) == 'unpaid')) {
				$result = mysql_query("UPDATE orders SET payment_status='Payable'");
			}

    	}
    	fclose($handle);
	}
$file_to_move = '/home/shuff/ppg/uploads/'.$file.' /home/shuff/ppg/uploads/processed/';
exec("mv $file_to_move");
if (file_exists('/home/shuff/ppg/uploads/processed/'.$file) == true){
	exec("rm -rf /home/shuff/ppg/uploads/processed/'.$file.'");}
	$sftp->delete($file);

}

}
exit();

function exists($table,$field,$value)
	{
		require_once 'ppg.f.database.php';
			$result = '';
			$row = '';
			$foundit = FALSE;
			$result = mysql_query("SELECT * FROM $table WHERE $field = '$value'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($value = $row[$field])
				{
					$foundit = TRUE;
				}
			}
			
			return $foundit;
		}

function csv_file_to_mysql_table($source_file, $target_table, $max_line_length=10000) {
    if (($handle = fopen("$source_file", "r")) !== FALSE) {
        $columns = fgetcsv($handle, $max_line_length, ",");
        foreach ($columns as &$column) {
            $column = str_replace(".","",$column);
        }
        $insert_query_prefix = "INSERT INTO $target_table (".join(",",$columns).")\nVALUES";
        while (($data = fgetcsv($handle, $max_line_length, ",")) !== FALSE) {
            while (count($data)<count($columns))
                array_push($data, NULL);
            $query = "$insert_query_prefix (".join(",",quote_all_array($data)).");";
            mysql_query($query);
        }
        fclose($handle);
    }
}

function quote_all_array($values) {
    foreach ($values as $key=>$value)
        if (is_array($value))
            $values[$key] = quote_all_array($value);
        else
            $values[$key] = quote_all($value);
    return $values;
}

function quote_all($value) {
    if (is_null($value))
        return "NULL";

    $value = "'" . mysql_real_escape_string($value) . "'";
    return $value;
} 
function get_field_value($table,$field,$pkey_field,$pkey_value)
	{
		//return "$table,$field,$pkey_field,$pkey_value";
		require_once 'ppg.f.database.php';
		$result = '';
		$row = '';
		$foundit = '';
		$result = mysql_query("SELECT * FROM $table WHERE $pkey_field = '$pkey_value'");
			
		while($row = mysql_fetch_array($result))
		{
			$foundit = $row[$field];
		}
			
			return $foundit;
	}		
?>