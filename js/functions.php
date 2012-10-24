<?php
//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************
include_once 'function.backgroundcheck.php';
//******************************************************************************


//******************************************************************************
//						SET CLASSES
//******************************************************************************

$action = new action;
$doit_str = '';
$key = '';
$value = '';
$name = '';

//******************************************************************************

//******************************************************************************
//						INCOMMING REQUESTS
//******************************************************************************

if (isset($_REQUEST['name'])){
$send_array = array();
	foreach ($_REQUEST as $key => $value)  
	{
		$name = mysql_real_escape_string($_REQUEST['name']); 
		if ($key != 'name')
		{
			$value = mysql_real_escape_string($value);  
			$send_array[$key] = $value;
		}
	}
	$doit = $action->$name($send_array);
	die($doit);
}


//******************************************************************************
class action
{
		
public function show_files_list($input)
{
	
	$orders_id=$input['orders_id'];
	
	$doit = '';
	$dir = 'uploads/attachments/' .  $orders_id;
	$full_dir = '/home/shuff/www/ppg/uploads/attachments/' .  $orders_id;
	if (!file_exists($full_dir)) {mkdir($full_dir, 0777); exec('chmod 777 '.$full_dir);}
	$files_array = scandir($full_dir);
	$i = 0;

	foreach ($files_array as $value)
	{
		if ($value != '.' && $value != '..')
		{
			$i = $i + 1;
			$del_file = $dir . '/' . $value;
			$link_value = str_replace(' ', '%20', $value);

			$doit = $doit."<br><div class=\"file_attach_row\"><a>
			<img orders_id=\"$orders_id\" del_file=\"$del_file\" class=\"img_x\" src=\"img/btn-cancel.png\" alt=\"delete\" /></a><a href=\"$dir/$link_value \"> $i.  $value</a></div>";
		}

	}

	return $doit;
}
	
	public function hello($my_name)
	{
		return 'hello '.$my_name;
	}
	public function get_files()
	{
		include('Net/SFTP.php');
 
     $sftp = new Net_SFTP('moveit.nabancard.com');
     if (!$sftp->login('ppg', 'patriot3')) {
         exit('Login Failed');
     }
	 echo $sftp->pwd() . "\r\n";
	//	$sftp->chdir('folder1/folder2/'); /// where are DAT files I must upload = OK
	
	
	
$files = $sftp->nlist();
foreach ($files as $file)
{
   if (preg_match('#\.csv$#', $file)) {
      continue;
   }
   echo $file."\n";
   $erg = $sftp->lstat($file);
   print_r( $erg );
   $erg = $sftp->get($file, $file);
   printf( "[%s]\n",$erg);
}
exit();
		
	}
	
	
	
	public function update_field_by_id($input)
	
	{
		
		$table=$input['table'];
		$field=$input['field'];
		$myvalue=$input['myvalue'];
		$pkey=$input['pkey'];
		$pkey_field=$input['pkey_field'];
		
		require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';

		$result = mysql_query("UPDATE $table SET $field='$myvalue' WHERE $pkey_field='$pkey'");
		
		return $result;
	}
		
	public function add_client($input)
	{

		$client_name=$input['client_name'];
		$client_phone=$input['client_phone'];
		$client_username=$input['client_username'];
		$client_password=$input['client_password'];
		$client_street=$input['client_street'];
		$client_city=$input['client_city'];
		$client_state=$input['client_state'];
		$client_zip=$input['client_zip'];
		$client_notes=$input['client_notes'];
		$client_group=$input['client_group'];
		$client_enabled=$input['client_enabled'];
		$client_email=$input['client_email'];
		$pkey=$input['pkey'];



		$result=mysql_query("UPDATE client SET client_name='$client_name',client_phone='$client_phone',
		client_enabled='$client_enabled',client_email='$client_email',client_username='$client_username',
		client_password='$client_password',client_street='$client_street',
		client_city='$client_city',client_state='$client_state',client_zip='$client_zip',client_notes='$client_notes' WHERE pkey='$pkey'");
//return $result.mysql_error();
		if ($result !=1){
			$random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',12)),0,12);
			$result = mysql_query("INSERT INTO client (pkey,client_id,client_name,client_phone,
		client_username,client_password,client_street,client_city,client_state,client_zip,client_notes,client_enabled,client_email)
		values(NULL,'$random','$client_name','$client_phone','$client_username','$client_password','$client_street','$client_city','$client_state','$client_zip','$client_notes','$client_enabled','$client_email')");
			$pkey = mysql_insert_id();	
			//$result = mysql_query("UPDATE client SET id='$random' WHERE pkey='$pkey'");
			$pkey = (string)$pkey;
			//return $result;	
			
			if ($client_group == 'admin'){
				$result = mysql_query("INSERT INTO group_admin (client_id)values('$random')");	
			}
			if ($client_group == 'rep'){
				$result = mysql_query("INSERT INTO group_rep (client_id)values('$random')");	
			}
		}
			return $result;
	}
	public function add_order($input)
	{

		$merchant_id=$input['merchant_id'];
		$rep_id=$input['rep_id'];
		$amount_due_ppg=$input['amount_due_ppg'];
		$amount_due_rep=$input['amount_due_rep'];
		$order_notes=$input['order_notes'];
		$order_status=$input['order_status'];
		$lead_source=$input['lead_source'];
		$processor=$input['processor'];
		$type=$input['type'];
		$pricing_structure=$input['pricing_structure'];
		$equipment_setup=$input['equipment_setup'];
		$terminal_type=$input['terminal_type'];
		$pin_debit=$input['pin_debit'];
		$monthly_service_fee=$input['monthly_service_fee'];
		$qual_discount_rate=$input['qual_discount_rate'];
		$authorization_fee=$input['authorization_fee'];
		$contact_name=$input['contact_name'];
		$setup_fee_one_time=$input['setup_fee_one_time'];
		$annual_fee=$input['annual_fee'];
		$date_submitted=$input['date_submitted'];
		$date_approved=$input['date_approved'];
		$date_activated=$input['date_activated'];
		$payment_status=$input['payment_status'];
		$commission_total=$input['commission_total'];	
		$commission_amount_paid=$input['commission_amount_paid'];
		$commission_paid_date=$input['commission_paid_date'];
		$payment_received_date=$input['payment_received_date'];
		$payment_due_date=$input['payment_due_date'];
		$ppg_payment_total=$input['ppg_payment_total'];
		$ballance_due=$input['ballance_due'];
		$company_name=$input['company_name'];
		$company_email=$input['company_email'];		
		$company_phone=$input['company_phone'];
		$company_street=$input['company_street'];
		$company_city=$input['company_city'];
		$company_state=$input['company_state'];
		$company_zip=$input['company_zip'];
		$company_notes=$input['company_note'];
		$payment_amount_received=$input['payment_amount_received'];
		$contact_name=$input['contact_name'];
		$contact_phone=$input['contact_phone'];
		$contact_email=$input['contact_email'];
		$tracking=$input['tracking'];
		$carrier=$input['carrier'];
		$shipping_status=$input['shipping_status'];

		//return "$merchant_id,$rep_id,$amount_due_from_merchant,$amount_due_ppg,$amount_due_rep,$order_notes,$order_status,$lead_source,$processor,$type,$pricing_structure,$equipment_setup,$terminal_type,$pin_debit,$monthly_service_fee,$qual_discount_rate,$authorization_fee,$setup_fee_one_time,$annual_fee,$date_submitted,$date_approved,$date_activated,$payment_status,$commission_total,$commission_amount_paid,$commission_paid_date,$payment_received_date,$payment_due_date,$ppg_payment_total,$ballance_due,$company_name,$company_email,$company_phone,$company_street,$company_city,$company_state,$company_zip,$company_notes";
		
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$pkey = 'failed';
		
		
		// ORDERS TABLE
		$result = mysql_query("INSERT INTO orders (pkey,merchant_id,rep_id,
		processor,type,pricing_structure,equipment_setup,terminal_type,pin_debit,
		monthly_service_fee,qual_discount_rate,authorization_fee,setup_fee_one_time,
		annual_fee,date_submitted,date_approved,date_activated,order_status,lead_source)
		values(NULL,'$merchant_id','$rep_id','$processor','$type','$pricing_structure','$equipment_setup','$terminal_type','$pin_debit','$monthly_service_fee','$qual_discount_rate','$authorization_fee','$setup_fee_one_time','$annual_fee','$date_submitted','$date_approved','$date_activated','$order_status','$lead_source')");
		$merchant_id = mysql_insert_id();	
		$result = mysql_query("UPDATE orders SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		$merchant_id = (string)$merchant_id;
		
		//PAYMENT TABLE	
		$result = mysql_query("INSERT INTO payment(pkey,rep_id,merchant_id,payment_status,commission_total,commission_amount_paid,commission_paid_date,payment_received_date,payment_due_date,ppg_payment_total,payment_amount_received,ballance_due,amount_due_rep,amount_due_ppg)values(NULL,'$rep_id','$merchant_id','$payment_status','$commission_total','$commission_amount_paid','$commission_paid_date','$payment_received_date','$payment_due_date','$ppg_payment_total','$payment_amount_received','$ballance_due','$amount_due_rep','$amount_due_ppg')");	
		$merchant_id = mysql_insert_id();
		$result = mysql_query("UPDATE payment SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		$result = mysql_query("UPDATE orders SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		
		//COMPANY TABLE
		$result = mysql_query("INSERT INTO company (pkey,company_name,company_email,company_phone,company_street,company_city,company_state,company_zip,company_notes)
		values(NULL,'$company_name','$company_email','$company_phone','$company_street','$company_city','$company_state','$company_zip','$company_notes')");
		$merchant_id = mysql_insert_id();	
		$result = mysql_query("UPDATE company SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		$result = mysql_query("UPDATE orders SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		$merchant_id = (string)$merchant_id;
		
		//CONTACT TABLE
		$result = mysql_query("INSERT INTO contact (pkey,merchant_id,contact_name,contact_email,contact_phone)
		values(NULL,'$merchant_id','$contact_name','$contact_email','$contact_phone')");
		$merchant_id = mysql_insert_id();	
		$result = mysql_query("UPDATE contact SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");
		
		//SHIPPING TABLE
		$result = mysql_query("INSERT INTO shipping (pkey,tracking,carrier,merchant_id,shipping_status)
		values(NULL,'$tracking','$carrier','$merchant_id','$shipping_status')");
		$merchant_id = mysql_insert_id();	
		$result = mysql_query("UPDATE shipping SET merchant_id='$merchant_id' WHERE pkey='$merchant_id'");

		return $result;
	}
	
	public function add_contact($input)
	{
		
		$contact_name=$input['contact_name'];
		$contact_phone=$input['contact_phone'];
		$contact_street=$input['contact_street'];
		$contact_city=$input['contact_city'];
		$contact_state=$input['contact_state'];
		$contact_zip=$input['contact_zip'];
		$merchant_id=$input['merchant_id'];
		$contact_email=$input['contact_email'];
		
		require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("INSERT INTO contact (pkey,contact_name,contact_phone,contact_street,contact_city,
	contact_state,contact_zip,merchant_id,contact_email)values(NULL,'$contact_name','$contact_phone','$contact_street','$contact_city',
	'$contact_state','$contact_zip','$merchant_id','$contact_email')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE contact SET merchant_id='$pkey' WHERE pkey='$pkey'");
		$pkey = (string)$pkey;

			return $pkey;
	}
		public function update_flagged($input)
	{
			
		
		$merchant_id=trim($input['merchant_id']);
		$client_id=trim($input['client_id']);
		
		require_once 'ppg.f.database.php';$action = new action;
	
		$result = mysql_query("SELECT * FROM flagged WHERE merchant_id = '$merchant_id' AND client_id = '$client_id'");

		if (mysql_num_rows($result) >= 1){
			$result = mysql_query("DELETE FROM flagged WHERE client_id = '$client_id' AND merchant_id LIKE '%$merchant_id%'");
		}
		else {
			$result = mysql_query("INSERT INTO flagged (merchant_id,client_id)values('$merchant_id','$client_id')");
		}
	
		return $result ;
	}
	
	public function add_rep($input)
	{
		
		$rep_name=$input['rep_name'];
		$rep_phone=$input['rep_phone'];
		$rep_email=$input['rep_email'];		
		$rep_street=$input['rep_street'];
		$rep_city=$input['rep_city'];
		$rep_state=$input['rep_state'];
		$rep_zipcode=$input['rep_zipcode'];
		$pkey=$input['pkey'];
//return "mysql_query(UPDATE rep SET rep_name='$rep_name',rep_phone='$rep_phone',rep_email='$rep_email',rep_street='$rep_street',rep_city='$rep_city',rep_state='$rep_state',rep_zipcode='$rep_zipcode' WHERE pkey='$pkey')";
		require_once 'ppg.f.database.php';$action = new action;

		$result = mysql_query("UPDATE rep SET rep_name='$rep_name',rep_phone='$rep_phone',rep_email='$rep_email',rep_street='$rep_street',rep_city='$rep_city',
		rep_state='$rep_state',rep_zipcode='$rep_zipcode' WHERE pkey='$pkey'");
	
		if ($result != 1){
			$result = mysql_query("INSERT INTO rep (pkey,rep_name,rep_phone,rep_email,rep_street,rep_city,rep_state,rep_zipcode)values
			(NULL,'$rep_name','$rep_phone','$rep_email','$rep_street','$rep_city','$rep_state','$rep_zipcode')");
			$pkey = mysql_insert_id();	
			$result = mysql_query("UPDATE rep SET rep_id='$pkey' WHERE pkey='$pkey'");
		}
			return $result;
	}
	
	public function add_shipping($input)
	{
		
		
		$tracking=$input['tracking'];
		$carrier=$input['carrier'];
		$merchant_id=$input['merchant_id'];
		$status=$input['status'];
		$notes=$input['notes'];
		
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("INSERT INTO shipping (pkey,tracking,carrier,merchant_id,staus,notes)values(NULL,'$tracking','$carrier','$merchant_id','$staus','$notes')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE shipping SET merchant_id='$pkey' WHERE pkey='$pkey'");
		$pkey = (string)$pkey;

			return $pkey;
	}
		public function update_admin($input)
	{
		
	
		$client_id=$input['client_id'];
		$status=$input['status'];
		
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		If ($status == 'yes' || $status == 'true'){
			$output = array();
			$output['table']='group_admin';
			$output['field']='client_id';
			$output['value']=$client_id;			
			if ($action->exists($output) == false){
				$result = mysql_query("INSERT INTO group_admin (client_id)values('$client_id')");
			}
			else 
			{
				return '1';
			}
		}
		
		else{
			$result = mysql_query("DELETE FROM group_admin WHERE client_id = '$client_id'");
		}
		
		return $result;
		
	}
	

public function grid_payments_due()
	{
		require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '<table class="tb" style="">';
		$body = '';
		$col_code = '';
		$col_family = '';
		$col_name = '';
		$col_collector = '';
		$col_edit = '';
		$old_rep_id = '';
		$display_total = '';
		$display_new_name = '';
		$num_rows = 0;
		$result = mysql_query("SELECT * FROM orders 
		WHERE LCASE(payment_status) <> 'paid' AND rep_id <> '0'
		AND payment_status = 'Payable' ORDER BY rep_id");
		
		$num_rows = mysql_num_rows($result);
	
		if ($num_rows <= 0){return 0;}
	
			$head_id = '<td id="tb_col_a" class="tb_col" style="width:10%;">
						<div class="tb_col_header">ID</div></td>';
							
			$head_organization = '<tr class="tb_rec"><td id="tb_col_b" class="tb_col"> 
								<div class="tb_col_header">Organization</div></td>';
							
			$head_rep_name = '<td id="tb_col_c" class="tb_col"> 
							<div class="tb_col_header">Sales Agent</div></td>';
			
			$head_due_rep = '<td id="tb_col_c" class="tb_col"> 
							<div class="tb_col_header">Due Agent</div></td>';
			
			$report = '<td id="tb_col_e" class="tb_col"> 
						<div class="tb_col_header" style="text-align:right;left:-30px;position:relative;">Report</div></td>';
								
							
			$head_edit = '<td id="tb_col_e" class="tb_col"> 
							<div class="tb_col_header" style="text-align:right;">Update CRM</div></td></tr>';
							
			$head = $head_organization.$head_rep_name.$head_due_rep.$report.$head_edit;
			

			while($row = mysql_fetch_array($result))
		{		
				$my_id = $row['rep_id'];
				
			$result_sum = mysql_query("SELECT SUM(commission_total) as commission_total FROM orders 
			WHERE payment_status <> 'paid' AND rep_id = '$my_id'");
			
			while($row2 = mysql_fetch_array($result_sum))
			{
				$total = $row2['commission_total'];
			
			}
	
	$pkey = $row['merchant_id'];	
	
	$merchant_id= $row['merchant_id'];	
	$order_status = $row['order_status'];		
	$merchant_id = $row['merchant_id'];
	$order_notes = $row['order_notes'];

	$payment_status = $row['payment_status'];
	$commission_total = $row['commission_total'];
	$commission_amount_paid = $row['commission_amount_paid'];
	$commission_paid_date = $row['commission_paid_date'];
	
	$amount_due_rep = $row['commission_total'];
	$organization = $row['company_name'];
	$rep_id = $row['rep_id'];

	$output = array();
	$output['table']='rep';
	$output['field']='rep_name';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;			
	$rep_name= $action->get_field_value($output);
	
	$output = array();
	$output['table']='rep';
	$output['field']='rep_email';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;
	$rep_email= $action->get_field_value($output);
	
	$output = array();
	$output['table']='rep';
	$output['field']='rep_phone';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;
	$rep_phone= $action->get_field_value($output);

	if ($rep_id != $old_rep_id){
		$display_new_name = '</table><div class="tb_col_new_name" style="">'.$action->pcase($rep_name).'</div>';
		$display_total = '<div class="tb_col_total" style="text-align:left;">Total due rep: $'.$total.'</div><table class="tb" style="">'.$head;	
	}
	else {
		$display_total= '';
		$display_new_name = '';
	}
	$old_rep_id = $rep_id;
	$rec = $display_new_name.$display_total.'<tr id="rec--orders--'.$pkey.'" class="tb_rec" style="">';
	$col_organization  = '<td id="tb_col_b" class="tb_col" style="width:30%;"> <div class="tb_row">'.$organization.'</div></td>';
	//$col_id = '<td id="tb_col_a" class="tb_col" style="width:5%;"> <div class="tb_row">'.$merchant_id.'</div></td>';
	$col_rep_id = '<td id="tb_col_d" class="tb_col" style="width:30%;"> <div class="tb_row">('.$rep_id.') '.$rep_name.'</div></td>';
	$col_amount_due_rep = '<td id="tb_col_c" class="tb_col" style="width:20%;">  <div class="tb_row">$'.$commission_total.'</div></td>';
	$col_edit = '<td id="tb_col_e" class="tb_col" style="width:20%;float:right;left:10px;position:relative;">
	<div class="tb_row"><div id="edit--'.$pkey.'"class="tb_mark_paid" style="float:right;margin-top:5px;position:relative;top:12px;"><input type="tiny_button" style="width:70px;margin-bottom:5px;" id="merchant_id--'.$merchant_id.'" value="Mark Paid"/></div></td>';
	$report = '<td id="tb_col_e" class="tb_col" style="width:20%;text-align:left;"> <div class="tb_row"><div id="report--'.$pkey.'" 
	class="tb_view_paid" style="float:right;margin-top:5px;position:relative;top:12px;">
	<input type="tiny_button" style="width:85px;margin-bottom:5px;padding-right:7px;" id="merchant_id--'.$merchant_id.'" value="View Report"  /></div></td>';
	
	$new_rec = $rec.$col_organization.$col_rep_id.$col_amount_due_rep.$report.$col_edit.'</tr>';	

			$body = $body.$new_rec;

	}			
	return $message.$body.'</table>';		
	}
public function build_payment_export()
{
					require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '';
		$body = '';
		$col_code = '';
		$col_family = '';
		$col_name = '';
		$col_collector = '';
		$col_edit = '';
		$old_rep_id = '';
		$display_total = '';
		$display_new_name = '';
		$num_rows = 0;
		$result = mysql_query("SELECT * FROM orders 
		WHERE payment_status <> 'Paid' AND payment_status <> 'paid' AND rep_id <> '0'
		AND payment_status = 'Payable' ORDER BY rep_id");
		
		$num_rows = mysql_num_rows($result);
	
		if ($num_rows <= 0){return 0;}
	
		
			

			while($row = mysql_fetch_array($result))
		{		
				$my_id = $row['rep_id'];
				
			$result_sum = mysql_query("SELECT SUM(commission_total) FROM orders 
			WHERE payment_status = 'unpaid' AND rep_id = '$my_id'");
			
			while($row2 = mysql_fetch_array($result_sum))
			{
				$total = $row2['SUM(commission_total)'];
			
			}
	
	$pkey = $row['merchant_id'];	
	
	$merchant_id= $row['merchant_id'];	
	$order_status = $row['order_status'];		
	$merchant_id = $row['merchant_id'];
	$order_notes = $row['order_notes'];

	$payment_status = $row['payment_status'];
	$commission_total = $row['commission_total'];
	$commission_amount_paid = $row['commission_amount_paid'];
	$commission_paid_date = $row['commission_paid_date'];
	
	$amount_due_rep = $row['amount_due_rep'];
	$organization = $row['company_name'];

	$rep_id = $row['rep_id'];
	
	$output = array();
	$output['table']='rep';
	$output['field']='rep_name';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;
	$rep_name= $action->get_field_value($output);
	
	$output = array();
	$output['table']='rep';
	$output['field']='rep_email';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;
	$rep_email= $action->get_field_value($output);
	
	$output = array();
	$output['table']='rep';
	$output['field']='rep_phone';
	$output['pkey_field']='rep_id';
	$output['pkey_value']=$rep_id;
	$rep_phone= $action->get_field_value($output);


	str_replace($organization,',','","');
	str_replace($rep_name,',','","');

$message = $message.$merchant_id.','.$organization.','.$rep_name.','.$commission_total.','.$total."\r\n";
		}
	$header = 'merchant_id,company_name,rep_name,commission_amount,total_commissions_due'."\r\n";	
			$myFile = "../export/payments.txt";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $header.$message);
			fclose($fh);
			
	

			$filename = 'payments.txt';
			$myheader = '<?php header(\'Content-Disposition: attachment; filename="' . $filename . '"\'); 
			readfile("payments.txt");
			?>';
			$myFile = "../export/export.php";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $myheader);
			fclose($fh);
			
			return '<a href="../export/export.php">Download List</a>';
}


public function data_display_email($input)
	{
	
		
		$deal=$input['deal'];
		$client_id=$input['client_id'];

		
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '';
		$subject = '';
		$attachment = '';
		$list_item = '';
		$wrapper = '<div id="mail_item">';
	
			//$result = mysql_query("DELETE FROM email_index");
			//$result = mysql_query("DELETE FROM emailtodb_attach");
			//$result = mysql_query("DELETE FROM emailtodb_email");
		
	
		$result = mysql_query("SELECT * FROM email_index 
		WHERE merchant_id = '$deal' ORDER BY ID DESC" );
		

	
		while($row = mysql_fetch_array($result))
		{
				
				$subject = $row['subject'];
				$ID = $row['ID'];
				$insert_date = $row['insert_date'];
				$list_item = "<div id=\"$ID\" class=\"email_item\"><b>$insert_date</b> $subject</div>";
				//return $ID;
				$attachment = '';
				$attachment_id = '';
				$attachment_name = '';	
				$result2 = mysql_query("SELECT * FROM emailtodb_attach WHERE IDEmail = '$ID'");	
				while($row2 = mysql_fetch_array($result2))
				{	
					$attachment_name = strtolower($row2['FileNameOrg']);
					$attachment_path = $row2['Filename'];
					$attachment_id = $row2['IDEmail'];
					$attachment = $attachment.'<a><div class="attachment_item"><div id="'.$attachment_id.'" class="attachment"></div><div id="'.$attachment_id.'" class="attachment_text">'.$attachment_name.'</div></div></a>';	
				}
				
			$attachment = '<div class="attachment_wrapper">'.$attachment.'</div>';
			$email_row = $list_item.$attachment;
			$message = $message.$email_row;
	
		}

		
		return "<div id=\"email_list\">$message</div>";
}	
					
public function data_display($input)
	{
		
		$deal=$input['deal'];
		$client_id=$input['client_id'];
		require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '';
	
		$result = mysql_query("SELECT * FROM orders 
		WHERE merchant_id = $deal");
		
		while($row = mysql_fetch_array($result))
		{			

			$pkey = $row['pkey'];	
			
			$merchant_id= $row['merchant_id'];
			$pkey = $merchant_id;
			$amount_due_ppg= $row['amount_due_ppg'];
			$amount_due_rep= $row['amount_due_rep'];
			$order_status = $row['order_status'];		
			$lead_source = $row['lead_source'];
			$processor = $row['processor'];
			$type = $row['type'];
			$pricing_structure = $row['pricing_structure'];
			$equipment_setup = $row['equipment_setup'];
			$terminal_type = $row['terminal_type'];			
			$pin_debit = $row['pin_debit'];
			$qual_discount_rate = $row['qual_discount_rate'];
			$authorization_fee = $row['authorization_fee'];
			$setup_fee_one_time = $row['setup_fee_one_time'];
			$annual_fee = $row['annual_fee'];
			$date_submitted = $row['date_submitted'];		
			$date_approved = $row['date_approved'];
			$date_activated = $row['date_activated'];
			$order_notes = $row['order_notes'];
			$monthly_service_fee = $row['monthly_service_fee'];
			
			$amount_processed  = $row['amount_processed'];
			
			$payment_status = $row['payment_status'];
			$commission_total = $row['commission_total'];
			$commission_amount_paid = $row['commission_amount_paid'];
			$commission_paid_date = $row['commission_paid_date'];
			$payment_received_date = $row['payment_received_date'];
			$payment_due_date = $row['payment_due_date'];
			$amount_due_rep = $row['amount_due_rep'];
			$ppg_payment_total = $row['ppg_payment_total'];	
			$payment_amount_received = $row['payment_amount_received'];
			$ballance_due = $row['ballance_due'];
			
			$tracking = $row['tracking'];
			$carrier = $row['carrier'];
			$shipping_status = $row['shipping_status'];
			$shipping_notes = $row['shipping_notes'];
		
			$merchant_id = $row['merchant_id'];
			$contact_name = $row['contact_name'];
			$contact_phone = $row['contact_phone'];
			$contact_email = $row['contact_email'];
			
			$rep_id = $row['rep_id'];
			
			$company_name = $row['company_name'];
			$company_email = $row['company_email'];
			$company_phone = $row['company_phone'];
			$company_street = $row['company_street'];
			$company_city = $row['company_city'];
			$company_state = $row['company_state'];	
			$company_zip = $row['company_zip'];
			$company_notes = $row['company_notes'];
			$company_status_code = $row['company_status_code'];
			$amounts_since = $row['amounts_since'];
			$amount_processed = $row['amount_processed'];
			$number_processed = $row['number_processed'];
			$unknown_field = $row['unknown_field'];
		//date_default_timezone_set('America/Chicago');	
		//$formated_date = strtotime($amounts_since);
		//$amounts_since = date('d/m/y',$amounts_since);
		
			$output = array();
			$output['table']='client';
			$output['field']='client_name';
			$output['pkey_field']='client_id';
			$output['pkey_value']=$client_id;
			$client_name = $action->get_field_value($output);
			
			$output = array();
			$output['merchant_id']=$merchant_id;
			$output['client_id']=$client_id;
			$flag_status = $action->is_flagged($output);
			if ($flag_status == 'yes'){$btn_img = 'img/btn-checked.png';$status='yes';}
			else{$status='no';$btn_img = 'img/btn-unchecked.png';}
			
			$output = array();
			$output['table']='rep';
			$output['field']='rep_name';
			$output['pkey_field']='rep_id';
			$output['pkey_value']=$rep_id;	
			$this_rep_id = $action->get_field_value($output);
			
			$output = array();
			$output['merchant_id']=$merchant_id;
			
			$amounts_processed = $action->transaction_history_30day($output);
			$amount_30days = $amounts_processed['amount_processed'];
			$number_30days = $amounts_processed['number_processed'];
		
			$message = '
		<div id="email_view" class="jquery-shadow jquery-shadow-raised email_view"></div>
		<div class="dd_title">'.$company_name.'</div>
		<div id="col_a">
	
	
	<h3 class="h3 deal_header">Company Details</h3><br>
	
	<!-- COMPANY --> 
	
			<div id="orders--merchant_id--'.$merchant_id.'" class="ornament_field_readonly ck_readonly">
			<div id="orders--merchant_id--'.$merchant_id.'" class="field_label_readonly">Merchant ID:</div>
			<div id="orders--merchant_id--'.$merchant_id.'" class="field_value_readonly orders--merchant_id--'.$merchant_id.'">'.$merchant_id.'
			</div></div>
			
			<div id="orders--company_name--'.$merchant_id.'" class="ornament_field_readonly ck_readonly">
			<div id="orders--company_name--'.$merchant_id.'" class="field_label_readonly">Company Name:</div>
			<div id="orders--company_name--'.$merchant_id.'" class="field_value_readonly orders--company_name--'.$merchant_id.'">'.$company_name.'
			</div></div>
			
			<div id="orders--company_street--'.$merchant_id.'"class="ornament_field">
			<a><div id="orders--company_street--'.$merchant_id.'"	class="field_label">Street:</div></a>
			<div id="orders--company_street--'.$merchant_id.'"class="field_value orders--company_street--'.$merchant_id.'">'
			.$company_street.
			'</div></div>
				
		<div id="orders--company_city--'.$merchant_id.'"class="ornament_field">
			<a><div id="orders--company_city--'.$merchant_id.'"class="field_label">City:</div></a>
			<div id="orders--company_city--'.$merchant_id.'"class="field_value orders--company_city--'.$merchant_id.'">'
		.$company_city.
		'</div></div>
				
		<div id="orders--company_state--'.$merchant_id.'"  
		class="ornament_field ck_required"><a><div id="orders--company_state--'.$merchant_id.'" 
		class="field_label">State:</div></a><div id="orders--company_state--'.$merchant_id.'" 
		class="field_value orders--company_state--'.$merchant_id.'">'.$company_state.'</div></div>
				
		<div id="orders--company_zip--'.$merchant_id.'"  
		class="ornament_field ck_required"><a><div id="orders--company_zip--'.$merchant_id.'" 
		class="field_label">Zipcode:</div></a><div id="orders--company_street--'.$merchant_id.'" 
		class="field_value orders--company_zip--'.$merchant_id.'">'.$company_zip.'</div></div>
			
			
			<div id="orders--company_phone--'.$merchant_id.'" class="ornament_field">
			<a><div id="orders--company_phone--'.$merchant_id.'" class="field_label">Company Main Phone:</div></a>
			<div id="orders--company_phone--'.$merchant_id.'" class="field_value orders--company_phone--'.$merchant_id.'">'.$company_phone.'</div>
		</div>
		
		<div id="orders--company_email--'.$merchant_id.'" class="ornament_field">
			<a><div id="orders--company_email--'.$merchant_id.'" class="field_label">Email:</div></a>
			<div id="orders--company_email--'.$merchant_id.'" class="field_value orders--company_email--'.$merchant_id.'">'.$company_email.'</div>
		</div>
			
		<br>
		
		<div id="orders--contact_name--'.$merchant_id.'" class="ornament_field">
			<a><div id="orders--contact_name--'.$merchant_id.'" class="field_label">Owners Name:</div></a>
			<div id="orders--contact_name--'.$merchant_id.'" class="field_value orders--contact_name--'.$merchant_id.'">'.$contact_name.'</div>
		</div>
			
			<div id="orders--contact_phone--'.$merchant_id.'"class="ornament_field">
			<a><div id="orders--contact_phone--'.$merchant_id.'" class="field_label">Cell Phone of Owner:</div></a>
			<div id="orders--contact_phone--'.$merchant_id.'" class="field_value orders--contact_phone--'.$merchant_id.'">'
			.$contact_phone.'</div></div>
					
		<div id="orders--contact_email--'.$merchant_id.'" class="ornament_field">
			<a><div id="orders--contact_email--'.$merchant_id.'" class="field_label">E-mail of Owner:</div></a>
			<div id="orders--contact_email--'.$merchant_id.'" class="field_value orders--contact_email--'.$merchant_id.'">'.$contact_email.'</div>
		</div>
		
		<br>
		
		<h3 class="h3 deal_header">Transactions</h3><br>
		
		<div id="orders--amounts_since--'.$merchant_id.'"  
		class="ornament_field_readonly ck_readonly"><div id="orders--amounts_since--'.$merchant_id.'" 
		class="field_label_readonly">Start Date:</div><div id="orders--amounts_since--'.$merchant_id.'" 
		class="field_value_readonly orders--amounts_since--'.$merchant_id.'">'.$amounts_since.'</div></div>
		
			
		<div id="orders--amount_processed--'.$merchant_id.'"  
		class="ornament_field_readonly"><div id="orders--amount_processed--'.$merchant_id.'" 
		class="field_label_readonly">Total Amount:</div><div id="orders--amount_processed--'.$merchant_id.'" 
		class="field_value_readonly orders--amount_processed--'.$merchant_id.'">'.$amount_processed.'</div></div>
			
		
		<div id="orders--amount_processed_30days--'.$merchant_id.'"  
		class="ornament_field_readonly"><div id="orders--amount_processed_30days--'.$merchant_id.'" 
		class="field_label_readonly">Last 30 days:</div><div id="orders--amount_processed_30days--'.$merchant_id.'" 
		class="field_value_readonly orders--amount_processed_30days--'.$merchant_id.'">'.$amount_30days.'</div></div>
			
		<div id="orders--number_processed--'.$merchant_id.'"  
		class="ornament_field_readonly ck_readonly"><div id="orders--number_processed--'.$merchant_id.'" 
		class="field_label_readonly">Total Transactions:</div><div id="orders--number_processed--'.$merchant_id.'" 
		class="field_value_readonly orders--number_processed--'.$merchant_id.'">'.$number_processed.'</div></div>
			
		<div id="orders--number_processed--'.$merchant_id.'"  
		class="ornament_field_readonly"><div id="orders--number_processed_30days--'.$merchant_id.'" 
		class="field_label_readonly">Last 30 days:</div><div id="orders--number_processed_30days--'.$merchant_id.'" 
		class="field_value_readonly orders--number_processed_30days--'.$merchant_id.'">'.$number_30days.'</div></div>
		
		<div id="orders--unknown_field--'.$merchant_id.'"  
		class="ornament_field_readonly"><div id="orders--unknown_field--'.$merchant_id.'" 
		class="field_label_readonly">Agent ID:</div><div id="orders--unknown_field--'.$merchant_id.'" 
		class="field_value_readonly orders--unknown_field--'.$merchant_id.'">'.$unknown_field.'</div></div>
		<br>
		<h3 class="h3 deal_header">Deal Status</h3><br>
	
		<!-- Deal --> 	
		
		<div id="orders--order_status--'.$pkey.'"  class="ornament_field ck_required">
		<a><div id="orders--order_status--'.$pkey.'" class="field_label">Status:</div></a>
		<div id="orders--order_status--'.$pkey.'"  class="field_value orders--order_status--'.$pkey.'">'.$order_status.'</div></div>
		
		<div id="orders--rep_id--'.$pkey.'"  class="ornament_field">
		<a><div id="orders--rep_id--'.$pkey.'" class="field_label">Sales Agent:</div></a>
		<div id="orders--rep_id--'.$pkey.'" class="field_value orders--rep_id--'.$pkey.'">'.$this_rep_id.'</div></div>
			
		<div id="orders--payment_status--'.$merchant_id.'"  class="ornament_field ck_required">
		<a><div id="orders--payment_status--'.$merchant_id.'" class="field_label">Payment Status:</div></a>
		<div id="orders--payment_status--'.$merchant_id.'"  class="field_value orders--payment_status--'.$merchant_id.'">'.$payment_status.'</div></div>
					
		<div id="orders--commission_total--'.$merchant_id.'"  class="ornament_field ck_numeric">
		<a><div id="orders--commission_total--'.$merchant_id.'" class="field_label">Agent Commission Amount:</div></a>
		<div id="orders--commission_total--'.$merchant_id.'"  class="field_value orders--commission_total--'.$merchant_id.'">'.$commission_total.'</div></div>
		
		<div id="orders--commission_paid_date--'.$merchant_id.'"  class="ornament_field">
		<a><div id="orders--commission_paid_date--'.$merchant_id.'" class="field_label">Commission Paid Date:</div></a>
		<div id="orders--commission_paid_date--'.$merchant_id.'"  class="field_value orders--commission_paid_date--'.$merchant_id.'">'.$commission_paid_date.'</div></div>
		
		<br><h3 class="h3 deal_header">Shipping</h3><br>
	
		<!-- SHIPPING --> 	
		<div id="orders--tracking--'.$merchant_id.'"  class="ornament_field">
		<a><div id="orders--tracking--'.$merchant_id.'" class="field_label">Tracking:</div></a>
		<div id="orders--tracking--'.$merchant_id.'"  class="field_value orders--tracking--'.$merchant_id.'">'.$tracking.'</div></div>
		
		<div id="orders--carrier--'.$merchant_id.'"  class="ornament_field">
		<a><div id="orders--carrier--'.$merchant_id.'" class="field_label">Carrier:</div></a>
		<div id="orders--carrier--'.$merchant_id.'"  class="field_value orders--carrier--'.$merchant_id.'">'.$carrier.'</div></div>
						
		<div id="orders--shipping_status--'.$merchant_id.'"  class="ornament_field ck_required">
		<a><div id="orders--shipping_status--'.$merchant_id.'" class="field_label">Status:</div></a>
		<div id="orders--shipping_status--'.$merchant_id.'"  class="field_value orders--shipping_status--'.$merchant_id.'">'.$shipping_status.'</div></div>
	</div>
	
	
	</div>	
	
	
	
	<div id="col_b">
	
	
		<div id="flagged--merchant_id--'.$merchant_id.'"  merchant_id="'.$merchant_id.'" style="position:relative;left:20px;top:0px;" class="ornament_field_readonly flagged_ck">
		<img id="flagged" src="'.$btn_img.'" merchant_id="'.$merchant_id.'" style="position:relative;top:-10px;left:5px;" value="'.$status.'"/>
		<div merchant_id="'.$merchant_id.'"class="field_label_readonly">Flag this deal for follow-up: ('.$client_name.')</div>
		</div>
				
	
		
		<h3 class="h3 deal_header">Background</h3><br>
	
	
			<textarea style="width:100%;min-height:300px;left:-10px;height:auto;margin-bottom:30px;text-align:left;top:-15px;" id="orders--order_notes--'.$pkey.'"  class="field_value field_label orders--order_notes--'.$pkey.'">'.$order_notes.'</textarea>
		
		
	
	
		<h3 class="h3 deal_header">Documents</h3><br>
	
					<div id="orders--attachments--upload--'.$merchant_id.'" style="position:relative;left:40px;" orders_id="'.$merchant_id.'" class="file_upload_button files_list"></div>
			
	
			<div id="orders--attachments--container--'.$merchant_id.'" style="width:765px;margin-right:10px;padding-right:20px;" >	
				<div id="orders--attachments--list--'.$merchant_id.'" ></div>	
			</div>
			
				<br>
			<h3 class="h3 deal_header">Emails</h3><br>
	
	
			<div style="width:100%;height:300px;margin-bottom:30px;text-align:left;position:relative;margin-left:-2px;" id="orders--order_emails--'.$pkey.'"  
			class="fake_textarea field_value email_list orders--order_emails--'.$pkey.'"></div>
		
	
	</div>	

	
	
	';
		
	
}
		
	return $message;		
	

	}
public function deals_list($input)
	{

		$table=$input['table'];
		$field=$input['field'];
		$id=$input['id'];
	
	//	return "mysql_query(SELECT * FROM orders WHERE merchant_id <> '0' AND enabled <> 'no' AND $field LIKE '$id' ORDER BY pkey DESC)\n";
		require_once 'ppg.f.database.php';$action = new action;

		$result = '';
		$row = '';
		$message = '';
		$merchant_id = '';
		if ($table == '' || $field == '' || $id == ''){
				
			$result = mysql_query("SELECT * FROM orders WHERE merchant_id <> '0' AND enabled <> 'no' ORDER BY pkey DESC LIMIT 25");
		}
		if ($table != '' && $field != '' && $id != '')
		{
			$result = mysql_query("SELECT * FROM orders WHERE merchant_id <> '0' AND enabled <> 'no' AND $field LIKE '%$id%' ORDER BY pkey DESC");
		}
		if ($table == 'flagged')
		{	
					$result = mysql_query("SELECT * FROM flagged WHERE client_id = '$id'");
					while($row = mysql_fetch_array($result))
					{
						$merchant_id = trim($row['merchant_id']);
					
						$result2 = mysql_query("SELECT * FROM orders WHERE merchant_id LIKE '%$merchant_id%'");
						
						while($row2 = mysql_fetch_array($result2))
						{
			
							$pkey = $row2['pkey'];	
							$company_name = $row2['company_name'];
							$date_submitted = $row2['date_submitted'];
							$merchant_id = $row2['merchant_id'];
							$small_company_name = substr($company_name, 0,40);
							$message = $message . '<div class="deals_list_item" id="'.$merchant_id.'--'.$merchant_id.'" ><a>'.$small_company_name.'</a></div>';
						}
					}
					
					return $message;
		}
		while($row = mysql_fetch_array($result))
		{
			
			$pkey = $row['pkey'];		
			$company_name = $row['company_name'];
			$date_submitted = $row['date_submitted'];
			$merchant_id = $row['merchant_id'];
	
			$small_company_name = substr($company_name, 0,50);
			$message = $message . '<div class="deals_list_item" id="'.$merchant_id.'--'.$merchant_id.'" ><a>'.$small_company_name.'</a></div>';
		}
		
		return $message;		
	

	}
public function global_search($input)
	{
					
	
		$my_search = $input['my_search'];
	
			
		strtolower($my_search);
		
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '';

			$qColumnNames = mysql_query("SHOW COLUMNS FROM orders") or die("mysql error");
				$numColumns = mysql_num_rows($qColumnNames);
				$x = 0;

				while ($x < $numColumns)
				{
    				$colname = mysql_fetch_row($qColumnNames);
    				$col[$colname[0]] = $x;
	
						$field = $colname[0];
	
						if ($colname[0] != 'pkey' && $colname[0] != 'timestamp')
						{
			
							$result = mysql_query("SELECT * FROM orders WHERE LOWER($colname[0]) LIKE '%$my_search%'");
							while($row = mysql_fetch_array($result))
							{
								$pkey = $row['pkey'];		
								$company_name = $row['company_name'];
								$date_submitted = $row['date_submitted'];
								$merchant_id = $row['merchant_id'];
								$small_company_name = substr($company_name, 0,50);
								$message = $message . '<div class="deals_list_item" id="'.$merchant_id.'--'.$merchant_id.'" ><a>'.$small_company_name.'</a></div>';
							}
							
						}
				$x++;
				}
			if ($message != ''){$message = "$message . <div style=\"margin-bottom:30px;\">";}
			if ($message == ''){$message = '1';}
			return $message;		
	

	}
public function is_flagged($input)
	{
		
		$merchant_id = $input['merchant_id'];
		$client_id = $input['client_id'];

		require_once 'ppg.f.database.php';$action = new action;

		$row = '';
		$message = '';
		$foundit = 'no';
		$result = mysql_query("SELECT * FROM flagged WHERE merchant_id LIKE '%$merchant_id%' AND client_id LIKE '%$client_id%' LIMIT 1");

		if (mysql_num_rows($result) >= 1)
		{	
			$foundit = 'yes';
		}
		
	return $foundit;		
	

	}
public function transaction_history_30day($input)
	{
		$merchant_id = $input['merchant_id'];

		require_once 'ppg.f.database.php';$action = new action;

		$row = '';
		$message = '';
		$amount_processed = 0;
		$number_processed = 0;
		$last_amount_processed = 0;
		$last_number_processed = 0;
		$amount_processed_diff = 0;
		$number_processed_diff = 0;
		$amount_processed_total = 0;
		$number_processed_total = 0;
		

		$result = mysql_query("SELECT * FROM transaction_history WHERE merchant_id = '$merchant_id'");

		while($row = mysql_fetch_array($result))
		{
	
			$amount_processed = $row['amount_processed'];
			$amount_processed_diff = abs($amount_processed - $last_amount_processed);
			$amount_processed_total = $amount_processed_total + $amount_processed_diff;
			
			$number_processed = $row['number_processed'];
			$number_processed_diff = abs($number_processed - $last_number_processed);
			$number_processed_total = $number_processed_total + $number_processed_diff;
			
			$last_amount_processed = $amount_processed;
			$last_number_processed = $number_processed;
					
		}
		
	$output = array('amount_processed'=>$amount_processed_total,'number_processed'=>$number_processed_total);		
	
	return $output;
	
	}
public function current_date()
{
	date_default_timezone_set('America/Chicago');	
	$t=time();
	return date("D F d Y",$t);
}
public function mark_paid($input)
{		
	$merchant_id = $input['merchant_id'];
	require_once 'ppg.f.database.php';$action = new action;
	
	$timestamp = $action->current_date();
	$result = mysql_query("UPDATE orders SET payment_status='paid',commission_paid_date='$timestamp' WHERE merchant_id='$merchant_id'");
	return $result;		
}
public function load_reps_grid()
	{
			
		
		require_once 'ppg.f.database.php';$action = new action;
		
		$message = '<table class="tb" style="width:98%;left:0px;">';

	
		$head_name = '<tr id="header--organization" class="tb_rec">
						<td id="tb_col_a" class="tb_col" >
							<div class="tb_col_header">Name</div></td>';
							
		$head_street = '<td id="tb_col_d" class="tb_col style="text-align:center;"> 
				<div class="tb_col_header">Street</div></td>';				
	

		$head_city = '<td id="tb_col_d" class="tb_col" style="text-align:center;"> 
							<div class="tb_col_header">City</div></td>';
							
							
		$head_state = '<td id="tb_col_e" class="tb_col"> 
						<div class="tb_col_header">St</div></td>';
						
		$head_zip = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header">Zip</div></td>';
				
	
		$head_email = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header" style="text-align:center;">Email</div></td>';
				
		$head_phone = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header">Phone</div></td></tr>';
								
		$head = $head_name . $head_street . $head_city . $head_state . $head_zip . $head_email . $head_phone;

		$message = $message.$head;
		
		
		$result = mysql_query("SELECT * FROM rep WHERE rep_id <> '0' ORDER BY rep_name DESC");
		while($row = mysql_fetch_array($result))
		{
									
		$pkey = $row['pkey'];
		$name = $row['rep_name'];
		$email = $row['rep_email'];
		$street = $row['rep_street'];	
		$city = $row['rep_city'];
		$state = $row['rep_state'];	
		$zip = $row['rep_zipcode'];
		$phone = $row['rep_phone'];	

		$rec = '<tr id="rec--organization--'.$pkey.'" class="tb_rec" style="">';
		$col_name  = '<td id="tb_col_a" class="tb_col" style="width:15%;padding-top:20px;"> <div class="tb_row">'.$name.'</div></td>';
		$col_street  = '<td id="tb_col_b" class="tb_col" style="width:25%;padding-top:20px;text-align:left;"> <div class="tb_row">'.$street.'</div></td>';
		$col_city = '<td id="tb_col_c" class="tb_col"style="width:10%;padding-top:20px;text-align:left;"> <div class="tb_row">'.$city.'</div></td>';
		$col_state = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;"> <div class="tb_row">'.$state.'</div></td>';
		$col_zip = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;"> <div class="tb_row">'.$zip.'</div></td>';
		$col_email = '<td id="tb_col_c" class="tb_col"style="width:25%;padding-top:20px;text-align:center;"> <div class="tb_row">'.$email.'</div></td>';
		$col_phone = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;text-align:center;"> <div class="tb_row">'.$phone.'</div></td>';


		$col_del = '<td id="tb_col_c" class="tb_col" style="width:20%;float:left;left:20px;position:relative;top:3px;">
		<div class="tb_row"><div id="delete--'.$pkey.'"class="tb_delete_rep" style="float:left;left:10px;margin-top:5px;position:relative;top:8px;">
		<div style="width:60px;margin-bottom:5px;margin-top:-30px;display:none" id="spinner_pkey--'.$pkey.'" class="spinner"></div>
		<input type="tiny_button" style="width:60px;margin-bottom:5px;" id="pkey--'.$pkey.'" value="Delete"/></div></td>';
		
		$col_edit = '<td id="tb_col_e" class="tb_col" style="width:20%;left:20px;position:relative;top:0px;">
		<div class="tb_row"><div id="edit--'.$pkey.'"class="tb_edit_rep" style="float:right;position:relative;top:11px;">
		<div style="width:60px;margin-bottom:5px;margin-top:-30px;display:none" id="spinner_pkey--'.$pkey.'" class="spinner"></div>
		<input type="tiny_button" style="width:60px;margin-bottom:5px;" id="pkey--'.$pkey.'" value="Edit"/></div></td>';
		
		$body = $rec.$col_name.$col_street.$col_city.$col_state.$col_zip.$col_email.$col_phone.$col_del.$col_edit.'<div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div></tr>';	
	

		$message = $message. $body;
		}

		return $message;

	}	


public function load_accounts_grid($input)
	{
			
		
		require_once 'ppg.f.database.php';$action = new action;
		
		$message = '<table class="tb" style="width:98%;left:0px;">';

	
		$head_name = '<tr id="header--organization" class="tb_rec">
						<td id="tb_col_a" class="tb_col" >
							<div class="tb_col_header">Name</div></td>';
							
		$head_street = '<td id="tb_col_d" class="tb_col style="text-align:center;"> 
				<div class="tb_col_header">Street</div></td>';				
	

		$head_city = '<td id="tb_col_d" class="tb_col" style="text-align:center;"> 
							<div class="tb_col_header">City</div></td>';
							
							
		$head_state = '<td id="tb_col_e" class="tb_col"> 
						<div class="tb_col_header">St</div></td>';
						
		$head_zip = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header">Zip</div></td>';
				
	
		$head_email = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header" style="text-align:center;">Username</div></td>';
		
				
		$head_phone = '<td id="tb_col_e" class="tb_col"> 
				<div class="tb_col_header">Phone</div></td></tr>';
								
		$head = $head_name . $head_email;

		$message = $message.$head;
		
		
		$result = mysql_query("SELECT * FROM client WHERE client_id <> '0' ORDER BY client_name DESC");
		while($row = mysql_fetch_array($result))
		{
									
		$pkey = $row['pkey'];
		$name = $row['client_name'];
		$email = $row['client_email'];
		$street = $row['client_street'];	
		$city = $row['client_city'];
		$state = $row['client_state'];	
		$zip = $row['client_zip'];
		$phone = $row['client_phone'];		

		$rec = '<tr id="rec--organization--'.$pkey.'" class="tb_rec" style="">';
		$col_name  = '<td id="tb_col_a" class="tb_col" style="width:45%;padding-top:20px;"> <div class="tb_row">'.$name.'</div></td>';
		$col_street  = '<td id="tb_col_b" class="tb_col" style="width:25%;padding-top:20px;text-align:left;"> <div class="tb_row">'.$street.'</div></td>';
		$col_city = '<td id="tb_col_c" class="tb_col"style="width:10%;padding-top:20px;text-align:left;"> <div class="tb_row">'.$city.'</div></td>';
		$col_state = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;"> <div class="tb_row">'.$state.'</div></td>';
		$col_zip = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;"> <div class="tb_row">'.$zip.'</div></td>';
		$col_email = '<td id="tb_col_c" class="tb_col"style="width:45%;padding-top:20px;text-align:center;"> <div class="tb_row">'.$email.'</div></td>';
		$col_phone = '<td id="tb_col_c" class="tb_col"style="width:5%;padding-top:20px;text-align:center;"> <div class="tb_row">'.$phone.'</div></td>';


		$col_del = '<td id="tb_col_c" class="tb_col" style="width:20%;float:left;left:15px;position:relative;top:3px;">
		<div class="tb_row"><div id="delete--'.$pkey.'"class="tb_delete_client" style="float:left;left:10px;margin-top:5px;position:relative;top:8px;">
		<div style="width:60px;margin-bottom:5px;display:none;" id="spinner_pkey--'.$pkey.'" class="spinner"></div>
		<input type="tiny_button" style="width:60px;margin-bottom:5px;" id="pkey--'.$pkey.'" value="Delete"/></div></td>';
		
		$col_edit = '<td id="tb_col_e" class="tb_col" style="width:20%;left:30px;position:relative;top:0px;">
		<div id="edit--'.$pkey.'"class="tb_edit_client" style="float:right;position:relative;top:11px;">
		<div class="tb_row"><div style="width:60px;margin-bottom:5px;display:none;" id="spinner_edit--'.$pkey.'" class="spinner"></div>
		<input type="tiny_button" style="width:60px;margin-bottom:5px;" id="pkey--'.$pkey.'" value="Edit"/></div></td>';
		
		$body = $rec.$col_name.$col_email.$col_del.$col_edit.'<div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div></tr>';	
	

		$message = $message. $body;
		}

		return $message;

	}	

	public function list_states()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM states");		
		while($row = mysql_fetch_array($result))
		{
			$id = $row['pkey'];
			$name = $row['name'];
		$message = $message. '<option value="'.$name.'">'.$name.'</option>';

		}
		
		return $message;
	}

	public function search_by_sales_agent()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<div id="search_by_sales_agent">';
		
		$result = mysql_query("SELECT * FROM rep");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['pkey'];
			$rep_name = $row['rep_name'];
			$rep_id = $row['rep_id'];
		$message = $message. '<a><div class="crm_action" id="rep--rep_id--'.$rep_id.'">'.$rep_name.'</div></a>';

		}
		
		return $message.'</div>';
	}
	public function search_by_status_list()
	{
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '<div id="search_by_status_list">';
		
		$result = mysql_query("SELECT * FROM order_status_list");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['pkey'];
			$name = $row['order_code'];
		$message = $message. '<a><div class="crm_action" id="orders--order_status--'.$name.'">'.$name.'</div></a>';

		}
		
		return $message.'</div>';
	}


	public function load_status_list_order()
	{
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM order_status_list");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['pkey'];
			$name = $row['order_code'];
		$message = $message. '<option value="'.$name.'">'.$name.'</option>';

		}
		
		return $message;
	}
	public function load_status_list_payment()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM payment_status_list");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['pkey'];
			$name = $row['payment_code'];
		$message = $message. '<option value="'.$name.'">'.$name.'</option>';

		}
		
		return $message;
	}
	public function lead_list()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM lead_list");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['pkey'];
			$name = $row['name'];
		$message = $message. '<option value="'.$pkey.'">'.$name.'</option>';

		}
		
		return $message;
	}
	public function rep_list()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM rep WHERE rep_id <> '0' ");		
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['rep_id'];
			$name = $row['rep_name'];
		$message = $message. '<option value="'.$pkey.'">'.$name.'</option>';

		}
		
		return $message;
	}
public function list_db_fields()
	{
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		$message = $message. '<option value="All">all records</option>';
		$result = mysql_query("SELECT * FROM orders limit 1");
		while($row = mysql_fetch_array($result))
		{
			
			$i = 0;
			$myresult = '';
			while ($i < mysql_num_fields($result)) 
			{
				$meta = mysql_fetch_field($result, $i);
				
				 	$field = $meta->name;
					$sanatized_name = str_replace('_',' ',$field);
					$sanatized_name = strtolower($sanatized_name);
				$i++;
				
				if ($field != 'pkey' && $field != 'timestamp')
				{
					$message = $message. '<option value="'.$field.'">'.$sanatized_name.'</option>';
				}
			}
		}
		
				return $message;
	}
	public function load_list_status_order()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM order_status_codes");		
		while($row = mysql_fetch_array($result))
		{
			$code = $row['order_code'];
			$order_status_id = $row['order_status_id'];
		$message = $message. '<option value="'.$order_status_id.'">'.$code.'</option>';

		}
		
		return $message;
	}
	
	public function load_list_status_payment()
	{
				require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM payment_status_codes");		
		while($row = mysql_fetch_array($result))
		{
			$code = $row['payment_code'];
			$payment_status = $row['payment_status'];
		$message = $message. '<option value="'.$payment_status.'">'.$code.'</option>';

		}
		
		return $message;
	}
	public function load_list_rep()
	{
			
		require_once 'ppg.f.database.php';$action = new action;
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM rep_group INNER JOIN client ON client.client_id = rep_group.client_id");		
		while($row = mysql_fetch_array($result))
		{
			$client_name = $row['client_name'];
			$client_id = $row['client_id'];
		$message = $message. '<option value="'.$client_id.'">'.$client_name.'</option>';

		}
		
		return $message;
	}
	public function delete_record($input)
	{
		
		$pkey_field = $input['pkey_field'];
		$table = $input['table'];
		$pkey_value = $input['pkey_value'];
			
		require_once 'ppg.f.database.php';$action = new action;

		$result = mysql_query("DELETE FROM $table WHERE $pkey_field = '$pkey_value'");		
		return $result;
	}
	public function in_group($input)
	{
		
		$client_id = $input['client_id'];
		$table = $input['group'];
			
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';
		$foundit = 'false';
		
		$result = mysql_query("SELECT * FROM $table WHERE client_id = '$client_id'");		
		while($row = mysql_fetch_array($result))
		{
			$foundit = $row['pkey'];
		}
		
		if ($foundit != 'false'){return 'true';}else{return 'false';}
	}
	
	public function get_field_value($input)
	{
		
		$table = $input['table'];
		$field = $input['field'];
		$pkey_field = $input['pkey_field'];
		$pkey_value = $input['pkey_value'];	
		//return "$table $field $pkey_field $pkey_value";
				require_once 'ppg.f.database.php';$action = new action;
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
	public function update_field_by_pkey($input)
	{		
		
		$table = $input['table'];
		$field = $input['field'];
		$myvalue = $input['value'];
		$pkey = $input['pkey'];			
			
				require_once 'ppg.f.database.php';$action = new action;
		$result = '';
		$row = '';

		$result = mysql_query("UPDATE $table SET $field='$myvalue' WHERE pkey='$pkey'");
		
		return $result;
	}
	public function exists($input)
	{
						
	
		$table = $input['table'];
		$field = $input['field'];
		$value = $input['value'];			
							
				require_once 'ppg.f.database.php';$action = new action;
			$result = '';
			$row = '';
			$foundit = 'false';
			$result = mysql_query("SELECT * FROM $table WHERE $field = '$value'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($value = $row[$field])
				{
					$foundit = 'true';
				}
			}
			
			return $foundit;
		}
	
	
	public function pcase($string)
	{
	$string = strtolower($string);
	$string = substr_replace($string, strtoupper(substr($string, 0, 1)), 0, 1);
	return $string;
	}
	
	public function ucase($string)
	{

	return strtoupper($string);
	}
	
		public function has_files($orders_id)
	{
		$dir = 'uploads/attachments/' .  $orders_id;
		
		if (!is_dir($dir)){return trim('no');}
		
		$files_array = scandir($dir);
		$i = 0;
	
		foreach ($files_array as $value)
		{
			if ($value != '.' && $value != '..'){
				$i = $i + 1;
			}
		}
	
		if ($i >= 1)
		{
			return trim('yes');
		}
		else
		{
			return trim('no');
		}
	
	}

public function send_client_email($input)
	{

	
		$username = $input['username'];
		$password = $input['password'];
		$name = $input['client'];


	$action = new action;
	 $subject = "Welcome PPG CRM Client ";
		

		$USERNAME = "USERNAME: $username <br>";
		$PASSWORD = "PASSWORD: $password <br>";
		$LINK = "URL: <a href=\"http://www.patriotpaymentgroup.com\">www.patriotpaymentgroup.com</a> <br>";
		
		
		 $WELCOME = "<br><b>Hello $name!</b><br>
							We have created you an account for the internal business management system. 
							Login using the username and password stated below.
							<br><br>$USERNAME $PASSWORD $LINK";

		
			$message = "<html><head><style>*{font-size:10pt;}</style></head>
				$WELCOME 
			";
		
		return $message;
		$doit = $action->send_email($username,$subject,$message);
		
		return $doit;
	}	
	
public function send_payment_summery($input)
{

	require_once 'ppg.f.database.php';$action = new action;
	
	$merchant_id = $input['merchant_id'];
	$report = $input['summery_report'];
	
	$result = mysql_query("SELECT * from orders 
	INNER JOIN rep ON rep.rep_id = orders.rep_id 
	WHERE orders.merchant_id = '$merchant_id'");
	
	while($row = mysql_fetch_array($result))
	{
		
		$rep_id = $row['rep_id'];
		$rep_name = $row['rep_name'];
		$email = $row['rep_email'];
		$rep_street = $row['rep_street'];	
		$rep_city = $row['rep_city'];
		$rep_state = $row['rep_state'];	
		$rep_zip = $row['rep_zipcode'];
		$rep_phone = $row['rep_phone'];
		
		$commission_total = $row['commission_total'];
		$company_name = $row['company_name'];	
		$date_approved = $row['date_approved'];
		$commission_paid_date = $row['commission_paid_date'];		 
	}
	
	if ($rep_city != ''){$rep_city=$rep_city.',';}
	
	$subject = 'Commission payment for '.$company_name;
	
	$message = "<html><head><style>*{font-size:16pt;}</style></head>
	<div style=\"font-size:18pt;width:100#;font-weight:bold;\">Representative</div>
	Name: $rep_name<br>
	Rep ID: $rep_id<br>
	Email: $email<br>
	Phone: $rep_phone<br>	
	$rep_street<br>
	$rep_city $rep_state $rep_zip<br><br>
	
	<div style=\"font-size:18pt;width:100#;font-weight:bold;\">Commission</div>
	Company: $company_name<br>
	MID: $merchant_id<br>
	Pay Date: $commission_paid_date<br>
	Commission Amount: <b>$$commission_total</b>
	";
	
	$output = array();
	$output['to'] = $email;
	$output['message'] = $message;
	$output['subject'] = $subject;
	
	if ($report != 'true'){
		$doit = $action->send_email($output);
	}	
	
	return $message;
}
public function send_email($input)
{

$to = $input['to'];
$subject = $input['subject'];
$message = $input['message'];

	$headers = "From: info@patriotpaymentgroup.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$from = "rtmshannon@gmail.com";


	$ok = @mail($to,$subject,$message,$headers);
	$ok = @mail('rtmshannon@gmail.com',$subject,$message,$headers);

	if($ok) {
		$send_status = true;
		return $send_status;
	}
	else
	{
		$send_status = false;
		return $send_status;
	}

} 	
	
	
	
	
	
}


//******************************************************************************


?>