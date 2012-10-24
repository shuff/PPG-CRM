<?php

//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************
require_once 'function.backgroundcheck.php';
//******************************************************************************
//						SET CLASSES
//******************************************************************************

$action = new action;

//******************************************************************************

//******************************************************************************
//						INCOMMING REQUESTS
//******************************************************************************


if (isset($_REQUEST['update_family_count'])){
	$id = mysql_real_escape_string($_REQUEST['update_family_count']);
	$doit = $action->update_family_count($id);
	die($doit);
}
if (isset($_REQUEST['get_sponsor'])){
	$formatted_recipient_id = mysql_real_escape_string($_REQUEST['formatted_recipient_id']);
	$doit = $action->get_sponsor($formatted_recipient_id);
	die($doit);
}
if (isset($_REQUEST['del_ornament'])){
	$table = mysql_real_escape_string($_REQUEST['table']);
	$id = mysql_real_escape_string($_REQUEST['id']);
	$doit = $action->del_ornament($table,$id);
	die($doit);
}
if (isset($_REQUEST['good_recipient'])){
	$id = mysql_real_escape_string($_REQUEST['id']);
	//die('dfsaf');
	$doit = $action->good_recipient($id);
	die($doit);
}
if (isset($_REQUEST['export_recipients'])){
	$limit = mysql_real_escape_string($_REQUEST['limit']);
	$doit = $action->export_recipients($limit);
	die($doit);
}
if (isset($_REQUEST['exists'])){
	$table = mysql_real_escape_string($_REQUEST['table']);
	$field = mysql_real_escape_string($_REQUEST['field']);
	$field_val = mysql_real_escape_string($_REQUEST['field_value']);
	$doit = $action->exists($table,$field,$field_val);
	die($doit);
}
if (isset($_REQUEST['in_group'])){
	$client_id = mysql_real_escape_string($_REQUEST['in_group']);
	$table = mysql_real_escape_string($_REQUEST['table']);
	$doit = $action->in_group($client_id,$table);
	die($doit);
}
if (isset($_REQUEST['get_field_value'])){
	$table = mysql_real_escape_string($_REQUEST['table']);
	$field = mysql_real_escape_string($_REQUEST['field']);
	$pkey_field = mysql_real_escape_string($_REQUEST['pkey_field']);
	$pkey_value = mysql_real_escape_string($_REQUEST['pkey_value']);
	$doit = $action->get_field_value($table,$field,$pkey_field,$pkey_value);
	die($doit);
}
if (isset($_REQUEST['load_collector_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_collector_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['load_family_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_family_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['get_last_recipient'])){
		$doit = $action->get_last_recipient();
	die($doit);
}
if (isset($_REQUEST['load_recipient_grid'])){
	$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_recipient_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['load_counselor_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_counselor_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['load_account_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_account_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['load_sponsor_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$sponsor_id = mysql_real_escape_string($_REQUEST['sponsor_id']);
		$doit = $action->load_sponsor_grid($del_option,$sponsor_id);
	die($doit);
}
if (isset($_REQUEST['load_organization_grid'])){
		$del_option = mysql_real_escape_string($_REQUEST['del_option']);
		$doit = $action->load_organization_grid($del_option);
	die($doit);
}
if (isset($_REQUEST['need_list'])){
	$doit = $action->need_list();
	die($doit);
}
if (isset($_REQUEST['load_recipient_list'])){
	$doit = $action->load_recipient_list();
	die($doit);
}
if (isset($_REQUEST['add_to_group'])){
	$table = mysql_real_escape_string($_REQUEST['table']);
	$id = mysql_real_escape_string($_REQUEST['id']);
	$doit = $action->add_to_group($table,$id);
	die($doit);
}
if (isset($_REQUEST['remove_from_group'])){
	$table = mysql_real_escape_string($_REQUEST['table']);
	$id = mysql_real_escape_string($_REQUEST['id']);
	$doit = $action->remove_from_group($table,$id);
	die($doit);
}
if (isset($_REQUEST['update_field_by_id'])){
	$pkey = mysql_real_escape_string($_REQUEST['pkey']);
	$table = mysql_real_escape_string($_REQUEST['table']);
	$field = mysql_real_escape_string($_REQUEST['field']);
	$myvalue = mysql_real_escape_string($_REQUEST['myvalue']);
	$pkey_field = mysql_real_escape_string($_REQUEST['pkey_field']);
	$doit = $action->update_field_by_id($table,$field,$myvalue,$pkey,$pkey_field);
	die($doit);
}
if (isset($_REQUEST['update_field_by_pkey'])){
	$pkey = mysql_real_escape_string($_REQUEST['pkey']);
	$table = mysql_real_escape_string($_REQUEST['table']);
	$field = mysql_real_escape_string($_REQUEST['field']);
	$myvalue = mysql_real_escape_string($_REQUEST['myvalue']);
	$doit = $action->update_field_by_pkey($table,$field,$myvalue,$pkey);
	die($doit);
}
if (isset($_REQUEST['ornament_flip'])){
	$pkey = mysql_real_escape_string($_REQUEST['pkey']);
	$side = mysql_real_escape_string($_REQUEST['side']);
	$doit = $action->ornament_flip($side,$pkey);
	die($doit);
}
if (isset($_REQUEST['next_family_member_count'])){
	$family_id = mysql_real_escape_string($_REQUEST['next_family_member_count']);
	$doit = $action->next_family_member_count($family_id);
	die($doit);
}
if (isset($_REQUEST['load_family_list'])){
	$doit = $action->load_family_list();
	die($doit);
}
if (isset($_REQUEST['load_organization_list'])){
	$doit = $action->load_organization_list();
	die($doit);
}
if (isset($_REQUEST['load_collector_list'])){
	$doit = $action->load_collector_list();
	die($doit);
}
if (isset($_REQUEST['load_blank_recipient'])){
	$ornament_width = mysql_real_escape_string($_REQUEST['ornament_width']);
	$ornament_height = mysql_real_escape_string($_REQUEST['ornament_height']);
	$ornament_body_height = mysql_real_escape_string($_REQUEST['ornament_body_height']);
	$doit = $action->load_blank_recipient($ornament_height,$ornament_body_height,$ornament_width);
	die($doit);
}
if (isset($_REQUEST['add_recipient'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$sock_size = mysql_real_escape_string($_REQUEST['sock_size']);
	$underware_size = mysql_real_escape_string($_REQUEST['underware_size']);
	$clothing_other = mysql_real_escape_string($_REQUEST['clothing_other']);
	$clothing_size = mysql_real_escape_string($_REQUEST['clothing_size']);
	$clothing_color = mysql_real_escape_string($_REQUEST['clothing_color']);
	$family_id = mysql_real_escape_string($_REQUEST['family_id']);
	$age = mysql_real_escape_string($_REQUEST['age']);
	$gift = mysql_real_escape_string($_REQUEST['gift']);
	$doit = $action->add_recipient($action->pcase($name),$sock_size,$underware_size,$clothing_other,$clothing_size,$clothing_color,$family_id,$age,$gift);
	die($doit);
}
if (isset($_REQUEST['add_sponsor'])){
	
	$sponsor_name = mysql_real_escape_string($_REQUEST['name']);
	$sponsor_phone = mysql_real_escape_string($_REQUEST['phone']);
	$sponsor_email = mysql_real_escape_string($_REQUEST['email']);
	$recipient_id = mysql_real_escape_string($_REQUEST['recipient_id']);
	$doit = $action->add_sponsor($action->pcase($sponsor_name),$sponsor_email,$sponsor_phone,$recipient_id);
	die($doit);
}
if (isset($_REQUEST['add_family'])){
	
	$name = mysql_real_escape_string($_REQUEST['name']);
	$name_dad = mysql_real_escape_string($_REQUEST['name_dad']);
	$name_mom = mysql_real_escape_string($_REQUEST['name_mom']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$organization = mysql_real_escape_string($_REQUEST['organization']);
	$collector = mysql_real_escape_string($_REQUEST['collector']);
	$bagged_food = mysql_real_escape_string($_REQUEST['bagged_food']);

	$doit = $action->add_family($action->pcase($name),$action->pcase($name_dad),$action->pcase($name_mom),$phone,$organization,$collector,$bagged_food);
	die($doit);
}
if (isset($_REQUEST['add_organization'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$username = mysql_real_escape_string($_REQUEST['email']);
	$contact = mysql_real_escape_string($_REQUEST['contact']);
	$street = mysql_real_escape_string($_REQUEST['street']);
	$state = mysql_real_escape_string($_REQUEST['state']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$zip = mysql_real_escape_string($_REQUEST['zip']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$date_due = mysql_real_escape_string($_REQUEST['date_due']);
	$id = mysql_real_escape_string($_REQUEST['id']);

	$doit = $action->add_organization($action->ucase($id),$phone,$action->pcase($name),$username,$street,$city,$action->ucase($state),$zip,$date_due,$contact);
	die($doit);
}
if (isset($_REQUEST['add_collector'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$username = mysql_real_escape_string($_REQUEST['email']);
	$password = mysql_real_escape_string($_REQUEST['password']);
	$street = mysql_real_escape_string($_REQUEST['street']);
	$state = mysql_real_escape_string($_REQUEST['state']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$zip = mysql_real_escape_string($_REQUEST['zip']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$description = mysql_real_escape_string($_REQUEST['description']);

	$doit = $action->add_collector($phone,$action->pcase($name),$username,$password,$street,$city,$action->ucase($state),$zip,$description);
	die($doit);
}
if (isset($_REQUEST['add_counselor'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$username = mysql_real_escape_string($_REQUEST['email']);
	$password = mysql_real_escape_string($_REQUEST['password']);
	$client_phone = mysql_real_escape_string($_REQUEST['client_phone']);
	$organization_id = mysql_real_escape_string($_REQUEST['organization_id']);
	$doit = $action->add_counselor($action->pcase($name),$username,$password,$organization_id,$client_phone);
	die($doit);
}
if (isset($_REQUEST['add_admin'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$username = mysql_real_escape_string($_REQUEST['username']);
	$password = mysql_real_escape_string($_REQUEST['password']);
	$doit = $action->add_admin($action->pcase($name),$username,$password);
	die($doit);
}

if (isset($_REQUEST['send_welcome_email'])){
	$name = mysql_real_escape_string($_REQUEST['name']);
	$username = mysql_real_escape_string($_REQUEST['username']);
	$password = mysql_real_escape_string($_REQUEST['password']);
	$role = mysql_real_escape_string($_REQUEST['role']);
	$doit = $action->send_welcome_email($action->pcase($name),$username,$password,$action->pcase($role));
	die($doit);
}
//******************************************************************************
class action
{
		public function update_field_by_id($table,$field,$myvalue,$pkey,$pkey_field)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';

		$result = mysql_query("UPDATE $table SET $field='$myvalue' WHERE $pkey_field='$pkey'");
		
		return $result;
	}
	
	public function update_family_count($id)
	{

		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$i = 0;
		$result = mysql_query("SELECT * FROM recipient WHERE family_id = '$id'");
		while($row = mysql_fetch_array($result))
		{
			
		$i = $i + 1;
		}
		if ($i >= 2)
		{
			$result2 = mysql_query("UPDATE family SET food_dinner='yes' WHERE family_id='$id'");
		}
		else 
		{
			$result2 = mysql_query("UPDATE family SET food_dinner='no' WHERE family_id='$id'");
		}
		
			
			return $result2;
	}
	
	public function add_counselor($name,$username,$password,$organization_id,$client_phone)
	{

		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',12)),0,12);
		$result = mysql_query("INSERT INTO client (pkey,client_name,username,password,client_phone)values(NULL,'$name','$username','$password','$client_phone')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE client SET client_id='$random' WHERE pkey='$pkey'");

		$result = mysql_query("INSERT INTO counselor (client_id,organization_id)values('$random','$organization_id')");	
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE client SET counselor_id='$pkey' WHERE pkey='$pkey'");	
		$pkey = (string)$pkey;
			
		return $pkey;
	}
	public function add_admin($name,$username,$password)
	{

		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$random = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',12)),0,12);
		$result = mysql_query("INSERT INTO client (pkey,client_name,username,password)values(NULL,'$name','$username','$password')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE client SET client_id='$random' WHERE pkey='$pkey'");
		$pkey = (string)$pkey;
		//return $result;	
		$result = mysql_query("INSERT INTO group_admin (client_id)values('$random')");	
			return $pkey;
	}
	public function add_to_group($table,$id)
	{
		$table = 'group_admin';
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = 'failed';
		$result = mysql_query("INSERT INTO $table(pkey,client_id) values(NULL,'$id')");		
		return $result;
	}
	public function del_ornament($table,$id)
	{
		$action = new action;
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		if ($table == 'recipient')
		{
			$result = mysql_query("DELETE FROM recipient WHERE recipient_id = '$id'");
			$result = mysql_query("DELETE FROM sponsor WHERE recipient_id = '$id'");
		}
		if ($table == 'collector')
		{
				
			if ($action->exists('family','collector_id',$id) == 'true')
			{
				return "There are Families still associated with this Collector. Remove or reassign these Families.";
			}
			else	
			{
				$result = mysql_query("DELETE FROM collector WHERE collector_id = '$id'");
			}
		}
		if ($table == 'sponsor')
		{
			$result = mysql_query("DELETE FROM sponsor WHERE sponsor_id = '$id'");
		}
		if ($table == 'client')
		{
			$result = mysql_query("DELETE FROM client WHERE client_id = '$id'");
			$result = mysql_query("DELETE FROM group_admin WHERE client_id = '$id'");
			$result = mysql_query("DELETE FROM collector WHERE client_id = '$id'");
			$result = mysql_query("DELETE FROM counselor WHERE client_id = '$id'");
		}
		if ($table == 'counselor')
		{
			$result = mysql_query("DELETE FROM counselor WHERE counselor_id = '$id'");
			
		}
		if ($table == 'organization')
		{
				
			if ($action->exists('counselor','organization_id',$id) == 'true' || $action->exists('family','organization_id',$id) == 'true')
			{
				return "There are Counselors and/or Families still associated with this Organization. Remove or reassign to a differnet Organization prior to deleting.";
			}
			else	
			{
				$result = mysql_query("DELETE FROM organization WHERE organization_id = '$id'");
			}
		}
		if ($table == 'family')
		{
			$result = mysql_query("DELETE FROM family WHERE family_id = '$id'");
			$result = mysql_query("DELETE FROM recipient WHERE family_id = '$id'");
		}
			
		return $result;
	}
	public function remove_from_group($table,$id)
	{
		$table = 'group_admin';
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("DELETE FROM $table WHERE client_id = '$id'");		
		return $result;
	}
	public function add_organization($id,$phone,$name,$username,$street,$city,$state,$zip,$date_due,$contact)
	{
	//return "$name,$username,$password,$street,$city,$state,$zip,$description";
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';

		$result = mysql_query("INSERT INTO organization (pkey,organization_id,phone,organization_name,street,city,state,zip,email,contact,date_due)values(NULL,'$id','$phone','$name','$street','$city','$state','$zip','$username','$contact','$date_due')");	
		$pkey = mysql_insert_id();	

		
		$pkey = (string)$pkey;	
		return $pkey;
		}
	public function add_sponsor($sponsor_name,$sponsor_email,$sponsor_phone,$recipient_id)
	{
//return "$sponsor_name,$sponsor_email,$sponsor_phone,$recipient_id";
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("INSERT INTO sponsor (pkey,sponsor_name,sponsor_email,sponsor_phone,recipient_id)values(NULL,'$sponsor_name','$sponsor_email','$sponsor_phone','$recipient_id')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE sponsor SET sponsor_id='$pkey' WHERE pkey='$pkey'");

		$pkey = (string)$pkey;	
		return $pkey;
		}
	public function add_collector($phone,$name,$username,$password,$street,$city,$state,$zip,$description)
	{
	//return "$name,$username,$password,$street,$city,$state,$zip,$description";
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("INSERT INTO client (pkey,client_name,username,password)values(NULL,'$name','$username','$password')");
	
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE client SET client_id='$pkey' WHERE pkey='$pkey'");

		$result = mysql_query("INSERT INTO collector (pkey,phone,collector_name,street,city,state,zip,instructions,email)values(NULL,'$phone','$name','$street','$city','$state','$zip','$description','$username')");	
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE collector SET collector_id='$pkey' WHERE pkey='$pkey'");	
		
		$pkey = (string)$pkey;	
		return $pkey;
		}
	public function add_recipient($name,$sock_size,$underware_size,$clothing_other,$clothing_size,$clothing_color,$family_id,$age,$gift)
	{
		//return 'fdsa';
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
	
		$action = new action;
		$family_count = $action->next_family_member_count($family_id);
	
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		
		$result = mysql_query("INSERT INTO recipient (pkey,recipient_name,family_id,age,family_count)values(NULL,'$name','$family_id','$age','$family_count')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE recipient SET recipient_id='$pkey' WHERE pkey='$pkey'");
		$pkey = (string)$pkey;
		//return $result;	
		$result = mysql_query("INSERT INTO need (recipient_id,clothing_sock_size,clothing_underware_size,clothing_other_size,clothing_other_color,gift,clothing_items)values('$pkey','$sock_size','$underware_size','$clothing_size','$clothing_color','$gift','$clothing_other')");	
			
			return $pkey;
	}
	public function add_family($name,$name_dad,$name_mom,$phone,$organization,$collector,$bagged_food)
	{
		//return "$name,$name_dad,$name_mom,$phone,$organization,$collector,$bagged_food";
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$pkey = 'failed';
		$result = mysql_query("INSERT INTO family (pkey,family_name,name_dad,name_mom,family_phone,organization_id,collector_id,food_bagged)values(NULL,'$name','$name_dad','$name_mom','$phone','$organization','$collector','$bagged_food')");
		$pkey = mysql_insert_id();	
		$result = mysql_query("UPDATE family SET family_id='$pkey' WHERE pkey='$pkey'");
		$pkey = (string)$pkey;

			return $pkey;
	}
	
		public function load_blank_recipient($ornament_height,$ornament_body_height,$ornament_width)
		{
	
		$side = 'front';

		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$id = '';

		$result = mysql_query("SELECT * FROM recipient INNER JOIN need ON recipient.recipient_id = need.recipient_id WHERE recipient.recipient_id = '0'");
		while($row = mysql_fetch_array($result))
		{
			$pkey= '0';
		//	return $pkey;
			$recipient_id= $row['recipient_id'];
			$rec = '<div id="rec--recipient--'.$pkey.'" class="ornament" style="float:left;width=200%;position:relative;"><div class="ornament_body body--recipient--id--'.$pkey.'">';
			$message = $message.$rec;
			
			
			$recipient_name = $row['recipient_name'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		

			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$gift = $row['gift'];
			
			
			$family_id = $row['family_id'];

			$action = new action;
			$sponsor = $action->get_field_value('sponsor', 'name', 'recipient_id', $recipient_id);
			$family = $action->get_field_value('family', 'name', 'family_id', $family_id);
			$organization_id = $action->get_field_value('family', 'organization_id', 'family_id', $family_id);
			$organization_due_date = $action->get_field_value('organization', 'date_due', 'organization_id', $organization_id);
			$organization = $action->get_field_value('organization', 'name', 'organization_id', $organization_id);
			$collector_id = $action->get_field_value('family', 'collector_id', 'family_id', $family_id);
			$collector = $action->get_field_value('collector', 'name', 'pkey', $collector_id);
			
			$collector_address = $action->get_field_value('collector', 'street', 'pkey', $collector_id);
			$collector_city = $action->get_field_value('collector', 'city', 'pkey', $collector_id);
			$collector_state = $action->get_field_value('collector', 'state', 'pkey', $collector_id);
			$collector_zip = $action->get_field_value('collector', 'zip', 'pkey', $collector_id);
			$collector_directions = $action->get_field_value('collector', 'instructions', 'pkey', $collector_id);
			
			
	
			$formated_id = '<div id="organization--id--'.$pkey.'" class="orgnaization_id" style="width:auto;float:left;text-decoration:underline;">'.$organization_id.'</div>' .'<div id="family_id--id--'.$pkey.'"  class="family_id" style="width:auto;float:left;text-decoration:underline;margin-left:2px;">'.$family_id.'-'.$action->family_member_count($family_id).'</div>';
			
			$message = $message. '<div id="left_recipient--id--'.$row['pkey'].'" class="ornament_field_wrapper" style="height:400px;">
			
									
									<div id="recipient--formated_id--'.$pkey.'" style="display:none;" class="ornament_label ornament_formatted_id recipient--formated_id--'.$pkey.'" >'.$formated_id.'</div>
									<div id="recipient--name--'.$pkey.'" style="display:none;" class="ornament_field ornament_recipient recipient--name--'.$pkey.'">'.$recipient_name.'</div>
									<div id="recipient--age--'.$pkey.'" style="display:none;" class="ornament_field ornament_age recipient--age--'.$pkey.'">'.$recipient_age.'</div>
									<div id="need--clothing_items--'.$pkey.'" style="display:none;" class="ornament_field"><div id="need--clothing_items--'.$pkey.'" class="ornament_label">Desired Clothing:</div><div id="need--clothing_items--'.$pkey.'" class="field_value need--clothing_items--'.$pkey.'">'.$clothing_items.'</div></div>
									<div id="need--clothing_other_size--'.$pkey.'" style="display:none;" class="ornament_field"><div id="need--clothing_other_size--'.$pkey.'" class="ornament_label" style="margin-left:10px;">Size:</div><div id="need--clothing_other_size--'.$pkey.'" class="field_value need--clothing_other_size--'.$pkey.'">'.$clothing_other_size.'</div></div>
									<div id="need--clothing_other_color--'.$pkey.'" style="display:none;" class="ornament_field"><div id="need--clothing_other_color--'.$pkey.'" class="ornament_label" style="margin-left:10px;">Color:</div><div id="need--clothing_other_color--'.$pkey.'" class="field_value need--clothing_other_color--'.$pkey.'">'.$clothing_other_color.'</div></div>
									

																	
									<div id="need--clothing_sock_size--'.$pkey.'" style="display:none;" class="ornament_field"><div id="need--clothing_sock_size--'.$pkey.'" class="ornament_label">Sock Size:</div><div id="need--clothing_sock_size--'.$pkey.'" class="field_value need--clothing_sock_size--'.$pkey.'">'.$clothing_sock_size.'</div></div>
									<div id="need--clothing_underware_size--'.$pkey.'" style="display:none;" class="ornament_field ornament_clothing_underware_size"><div id="need--clothing_underware_size--'.$pkey.'" class="ornament_label">Underware Size:</div><div id="need--clothing_underware_size--'.$pkey.'" class="field_value need--clothing_underware_size--'.$pkey.'">'.$clothing_underware_size.'</div></div>
									<div id="need--gift--'.$pkey.'" style="display:none;" class="ornament_field"><div id="need--gift--'.$pkey.'" class="ornament_label">Desired Gift:</div><div id="need--gift--'.$pkey.'"  class="field_value need--gift--'.$pkey.'">'.$gift.'</div></div>
									<div id="organization--due_date--'.$pkey.'" style="display:none;" class="ornament_due_date" style="display:none;"><div id="organization--due_date--'.$pkey.'"class="ornament_label" style="width:auto;text-decoration:underline;cursor:pointer;">Due Date:</div><div id="organization--due_date--'.$pkey.'" class="field_value organization--due_date--'.$pkey.'" style=:width:auto;">'.$organization_due_date.'</div></div>
							
									';
			
	
	$message = $message . '</div></div>';	
	
	
	
return $message;

}
		
	
	}

public function ornament_flip($side,$pkey)
	{
	
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$id = '';
		$foundit = false;
		$result = mysql_query("SELECT * FROM recipient INNER JOIN need ON recipient.recipient_id = need.recipient_id INNER JOIN family ON recipient.family_id = family.family_id INNER JOIN organization ON family.organization_id = organization.organization_id INNER JOIN collector ON collector.collector_id = family.collector_id WHERE recipient.recipient_id = '$pkey'"
		);
		

		while($row = mysql_fetch_array($result))
		{

			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];
			
			$collector_street = $row['street'];
			$collector_city = $row['city'];
			$collector_state = $row['state'];
			$collector_zip = $row['zip'];
			$collector_directions = $row['instructions'];
			$collector_id = $row['collector_id'];
			$collector = $row['collector_name'];
			
			$message = $message.'<div class="ornament_body body--recipient--recipient_id--'.$pkey.'">';
			
			$formated_id = '<div id="'.$pkey.'--organization--'.$organization_id.'" class="orgnaization_id " style="width:auto;float:left;">'.$organization_id.'</div>' .'<div id="'.$pkey.'--family--family_id--'.$family_id.'"  class="family_id" style="width:auto;float:left;margin-left:2px;">'.$family_id.'-'.$family_count.'</div>';
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			
			<div id="--'.$pkey.'" class="flip_link ornament_flip_back">View Back</div>
									
			<div id="'.$pkey.'--recipient--formated_id--'.$recipient_id.'" class="ornament_label ornament_formatted_id 
			'.$pkey.'--recipient--formated_id--'.$recipient_id.'">'.$formated_id.'</div>
			
			<div id="'.$pkey.'--recipient--recipient_name--'.$recipient_id.'" class="ornament_field ornament_recipient 
			'.$pkey.'--recipient--recipient_name--'.$recipient_id.'">'.$recipient_name.'</div>
			
			
			<div id="'.$pkey.'--recipient--age--'.$recipient_id.'" class="ornament_field ornament_age 
			'.$pkey.'--recipient--age--'.$recipient_id.'">'.$recipient_age.'</div>
			
			
			<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_field">
			<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_label">Desired Clothing:</div>
			<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="field_value 
			'.$pkey.'--need--clothing_items--'.$need_id.'">'.$clothing_items.'</div></div>
			
			<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_field">
			<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Size:</div>
			<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="field_value 
			'.$pkey.'--need--clothing_other_size--'.$need_id.'">'.$clothing_other_size.'</div></div>
			
			<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_field">
			<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Color:</div>
			<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="field_value 
			'.$pkey.'--need--clothing_other_color--'.$need_id.'">'.$clothing_other_color.'</div></div>
											
			<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_field">
			<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_label">Sock Size:</div>
			<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="field_value 
			'.$pkey.'--need--clothing_sock_size--'.$need_id.'">'.$clothing_sock_size.'</div></div>
			
			<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_field ornament_clothing_underware_size">
			<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_label">Underware Size:</div>
			<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="field_value 
			'.$pkey.'--need--clothing_underware_size--'.$need_id.'">'.$clothing_underware_size.'</div></div>
			
			<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_field">
			<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_label">Desired Gift:</div>
			<div id="'.$pkey.'--need--gift--'.$need_id.'"  class="field_value 
			'.$pkey.'--need--gift--'.$need_id.'">'.$gift.'</div></div>

			
			<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="ornament_date_due">
			<div id="'.$pkey.'--organization--date_due--'.$need_id.'"class="ornament_label" style="width:auto;">Due Date:</div>
			<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="field_value 
			'.$pkey.'--organization--date_due--'.$need_id.'" style=:width:auto;">'.$organization_due_date.'</div></div>
	
			';
			
			$message = $message . '</div></div><div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div>';	
	
		
	
			$message_back = $message_back.'<div class="ornament_body body--recipient--recipient_id--'.$pkey.'">
		
			
			<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			
			<div id="--'.$pkey.'" class="flip_link ornament_flip_front">View Front</div>
				
			<div id="'.$pkey.'--collector--collector_name--'.$collector_id.'" class="" style="margin-top:20px;"><div id="'.$pkey.'--collector--collector_name--'.$collector_id.'" class="ornament_label">Collector:</div><div id="'.$pkey.'--collector--collector_name--'.$collector_id.'" class="field_value '.$pkey.'--collector--collector_name--'.$collector_id.'" style="font-weight:bold;">'.$collector.'</div></div>
				
			<div id="'.$pkey.'--collector--collector_address--'.$collector_id.'" class="field_value collector_address" style="margin-left:10px;">'.$collector_street.'</div>
			<div id="'.$pkey.'--collector--city--'.$collector_id.'" class="field_value collector_city" style="margin-left:10px;">'.$collector_city.', '.$collector_state. ' '.$collector_zip.'</div>
			<br><div id="'.$pkey.'--collector--collector_directions--'.$pkey.'" class=""><div id="'.$pkey.'--collector--collector_directions--'.$collector_id.'" class="ornament_label">Directions:</div><div id="'.$pkey.'--collector--collector_directions--'.$collector_id.'" class="field_value '.$pkey.'--collector--collector_directions--'.$collector_id.'">'.$collector_directions.'</div></div>

			';
			
	
			$message_back = $message_back . '</div></div><div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div>';	
	
		}

	if ($side == 'front'){return $message;}
	else{return $message_back;}
		
			
	

	}
	
	public function get_last_recipient()
	{
		
	
	$del_option = '';
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		
		
		$id = '';



		$result = mysql_query("SELECT * FROM recipient INNER JOIN need ON recipient.recipient_id = need.recipient_id INNER JOIN family ON recipient.family_id = family.family_id INNER JOIN organization ON family.organization_id = organization.organization_id WHERE recipient.recipient_id <> '0' ORDER BY recipient.recipient_id DESC LIMIT 1"
		);
		
			$action = new action;
					$org_id = '';
			$fam_id = '';
		while($row = mysql_fetch_array($result))
		{
				
			

			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];

			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--recipient--'.$recipient_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--recipient--'.$recipient_id.'" class="del_error"></div>';
				$ornament_flip = 'hidden';
			}
			else
			{
				$del_button = '';
				$ornament_flip = 'flip_link ornament_flip_back';
			}

			$formated_id = '<div id="'.$pkey.'--organization--organization_id--'.$organization_id.'" class="orgnaization_id " style="width:auto;float:left;">'.$organization_id.'</div>' .'<div id="'.$pkey.'--family--family_id--'.$family_id.'"  class="family_id" style="width:auto;float:left;margin-left:2px;">'.$family_id.'-'.$family_count.'</div>';

		
					
			$message = $message. '
			
			<div id="rec--recipient--'.$pkey.'" class="ornament"><div class="ornament_body body--recipient--recipient_id--'.$pkey.'">
				<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
				
					'.$del_button.'
					<div id="--'.$pkey.'" class="'.$ornament_flip.'">View Back</div>
					
					<div id="'.$pkey.'--recipient--formated_id--'.$recipient_id.'" class="ornament_label ornament_formatted_id 
					'.$pkey.'--recipient--formated_id--'.$recipient_id.'">'.$formated_id.'</div>
					
					<div id="'.$pkey.'--recipient--recipient_name--'.$recipient_id.'" class="ornament_field ornament_recipient 
					'.$pkey.'--recipient--recipient_name--'.$recipient_id.'">'.$recipient_name.'</div>
					
					
					<div id="'.$pkey.'--recipient--age--'.$recipient_id.'" class="ornament_field ornament_age 
					'.$pkey.'--recipient--age--'.$recipient_id.'">'.$recipient_age.'</div>
					
					
					<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_field ">
					<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_label">Desired Clothing:</div>
					<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="field_value 
					'.$pkey.'--need--clothing_items--'.$need_id.'">'.$clothing_items.'</div></div>
					
					<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_field ">
					<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Size:</div>
					<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="field_value 
					'.$pkey.'--need--clothing_other_size--'.$need_id.'">'.$clothing_other_size.'</div></div>
					
					<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_field ">
					<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Color:</div>
					<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="field_value 
					'.$pkey.'--need--clothing_other_color--'.$need_id.'">'.$clothing_other_color.'</div></div>
													
					<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_field ">
					<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_label">Sock Size:</div>
					<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="field_value 
					'.$pkey.'--need--clothing_sock_size--'.$need_id.'">'.$clothing_sock_size.'</div></div>
					
					<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_field  ornament_clothing_underware_size">
					<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_label">Underware Size:</div>
					<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="field_value 
					'.$pkey.'--need--clothing_underware_size--'.$need_id.'">'.$clothing_underware_size.'</div></div>
					
					<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_field ">
					<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_label">Desired Gift:</div>
					<div id="'.$pkey.'--need--gift--'.$need_id.'"  class="field_value 
					'.$pkey.'--need--gift--'.$need_id.'">'.$gift.'</div></div>

					
					<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="ornament_date_due">
					<div id="'.$pkey.'--organization--date_due--'.$need_id.'"class="ornament_label" style="width:auto;">Due Date:</div>
					<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="field_value 
					'.$pkey.'--organization--date_due--'.$need_id.'" style=:width:auto;">'.$organization_due_date.'</div></div>
			
					';
			
	
	$message = $message . '<div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div></div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
public function get_sponsor($formatted_recipient_id)
	{
		
	
	$del_option = '';
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		
		
		$id = '';



		$result = mysql_query("SELECT * FROM recipient 
		INNER JOIN need ON recipient.recipient_id = need.recipient_id 
		INNER JOIN family ON recipient.family_id = family.family_id 
		INNER JOIN organization ON family.organization_id = organization.organization_id 
		INNER JOIN sponsor ON sponsor.recipient_id = recipient.recipient_id
		WHERE recipient.recipient_id <> '0' ORDER BY recipient.recipient_id DESC");

		
		
		while($row = mysql_fetch_array($result))
		{
			
			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];
			$sponsor_id = $row['sponsor_id'];
			


			$formated_id = strtolower($organization_id.$family_id.'-'.$family_count);
			if ($formated_id == strtolower($formatted_recipient_id))
			{
				return $sponsor_id;
			}
		}
		
			return '';		
	

			}
public function good_recipient($id)
	{

		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';

		$result = mysql_query("SELECT * FROM recipient 
		INNER JOIN need ON recipient.recipient_id = need.recipient_id 
		INNER JOIN family ON recipient.family_id = family.family_id 
		INNER JOIN organization ON family.organization_id = organization.organization_id 
		WHERE recipient.recipient_id <> '0' ORDER BY recipient.recipient_id DESC");

		
		
		while($row = mysql_fetch_array($result))
		{
			
			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];
			
			


			$formated_id = trim(strtolower($organization_id.$family_id.'-'.$family_count));
			if ($formated_id == trim(strtolower($id)))
			{
				return $recipient_id;
			}
		}
		
			return 'false';		
	

			}
	public function load_recipient_grid($del_option)
	{
		
	//	if ($sort == ''){$sort = 'DESC';}
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		
		
		$id = '';



		$result = mysql_query("SELECT * FROM recipient INNER JOIN need ON recipient.recipient_id = need.recipient_id INNER JOIN family ON recipient.family_id = family.family_id INNER JOIN organization ON family.organization_id = organization.organization_id WHERE recipient.recipient_id <> '0' ORDER BY organization.organization_name DESC"
		);
		
			$action = new action;
					$org_id = '';
			$fam_id = '';
		while($row = mysql_fetch_array($result))
		{
				
			

			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];

			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--recipient--'.$recipient_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--recipient--'.$recipient_id.'" class="del_error"></div>';
				$ornament_flip = 'hidden';
			}
			else
			{
				$del_button = '';
				$ornament_flip = 'flip_link ornament_flip_back';
			}

			if ($org_id != $organization_id){
				
				$message = $message . '<div class="new_organization_label">'.$action->pcase($organization).'</div>';
				$org_id = $organization_id;
			}
			if ($fam_id != $family_id){
				$message = $message . '<div class="new_family_label">'.$action->pcase($family).'</div>';
				$fam_id = $family_id;
			}
						
			$rec = '<div id="rec--recipient--'.$pkey.'" class="ornament" ><div class="ornament_body body--recipient--recipient_id--'.$pkey.'">';
			$message = $message.$rec;
		
			
			$formated_id = '<div id="'.$pkey.'--organization--organization_id--'.$organization_id.'" class="orgnaization_id " style="width:auto;float:left;">'.$organization_id.'</div>' .'<div id="'.$pkey.'--family--family_id--'.$family_id.'"  class="family_id" style="width:auto;float:left;margin-left:2px;">'.$family_id.'-'.$family_count.'</div>';
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
									'.$del_button.'
									<div id="--'.$pkey.'" class="'.$ornament_flip.'">View Back</div>
									
									<div id="'.$pkey.'--recipient--formated_id--'.$recipient_id.'" class="ornament_label ornament_formatted_id 
									'.$pkey.'--recipient--formated_id--'.$recipient_id.'">'.$formated_id.'</div>
									
									<div id="'.$pkey.'--recipient--recipient_name--'.$recipient_id.'" class="ornament_field ornament_recipient 
									'.$pkey.'--recipient--recipient_name--'.$recipient_id.'">'.$recipient_name.'</div>
									
									
									<div id="'.$pkey.'--recipient--age--'.$recipient_id.'" class="ornament_field ornament_age 
									'.$pkey.'--recipient--age--'.$recipient_id.'">'.$recipient_age.'</div>
									
									
									<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_field ">
									<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="ornament_label">Desired Clothing:</div>
									<div id="'.$pkey.'--need--clothing_items--'.$need_id.'" class="field_value 
									'.$pkey.'--need--clothing_items--'.$need_id.'">'.$clothing_items.'</div></div>
									
									<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_field ">
									<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Size:</div>
									<div id="'.$pkey.'--need--clothing_other_size--'.$need_id.'" class="field_value 
									'.$pkey.'--need--clothing_other_size--'.$need_id.'">'.$clothing_other_size.'</div></div>
									
									<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_field ">
									<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="ornament_label" style="margin-left:10px;">Color:</div>
									<div id="'.$pkey.'--need--clothing_other_color--'.$need_id.'" class="field_value 
									'.$pkey.'--need--clothing_other_color--'.$need_id.'">'.$clothing_other_color.'</div></div>
																	
									<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_field ">
									<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="ornament_label">Sock Size:</div>
									<div id="'.$pkey.'--need--clothing_sock_size--'.$need_id.'" class="field_value 
									'.$pkey.'--need--clothing_sock_size--'.$need_id.'">'.$clothing_sock_size.'</div></div>
									
									<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_field  ornament_clothing_underware_size">
									<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="ornament_label">Underware Size:</div>
									<div id="'.$pkey.'--need--clothing_underware_size--'.$need_id.'" class="field_value 
									'.$pkey.'--need--clothing_underware_size--'.$need_id.'">'.$clothing_underware_size.'</div></div>
									
									<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_field ">
									<div id="'.$pkey.'--need--gift--'.$need_id.'" class="ornament_label">Desired Gift:</div>
									<div id="'.$pkey.'--need--gift--'.$need_id.'"  class="field_value 
									'.$pkey.'--need--gift--'.$need_id.'">'.$gift.'</div></div>
		
									
									<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="ornament_date_due">
									<div id="'.$pkey.'--organization--date_due--'.$need_id.'"class="ornament_label" style="width:auto;">Due Date:</div>
									<div id="'.$pkey.'--organization--date_due--'.$need_id.'" class="field_value 
									'.$pkey.'--organization--date_due--'.$need_id.'" style=:width:auto;">'.$organization_due_date.'</div></div>
							
									';
			
	
	$message = $message . '<div id="body--recipient--spinner--'.$pkey.'" class="spinner"></div></div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}



	public function load_counselor_grid($del_option)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$action = new action;
		
		$id = '';
		$result = mysql_query("SELECT * FROM counselor INNER JOIN client ON counselor.client_id = client.client_id INNER JOIN organization ON counselor.organization_id = organization.organization_id ORDER BY organization.organization_name DESC"
		);
		
		while($row = mysql_fetch_array($result))
		{
				
			

			$pkey = $row['pkey'];	
			$client_id = $row['client_id'];	
			$pkey = $client_id;
			$username = $row['username'];
			$password = $row['password'];
			$client_name = $row['client_name'];
			
			$client_id = $row['client_id'];
			$client_name = $row['client_name'];
			$client_phone = $row['client_phone'];
			$username	= $row['username'];
			
			$organization_name = $row['organization_name'];
			$organization_id = $row['organization_id'];

			$counselor_id = $row['counselor_id'];
			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--counselor--'.$counselor_id.'" alt="delete" class="ornament_delete">
				</div><div id="delerr--counselor--'.$counselor_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
			
						
			$rec = '<div id="rec--counselor--'.$counselor_id.'" class="ornament"><div class="ornament_body body--recipient--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--id--'.$pkey.'" class="ornament_field_wrapper">
			'.$del_button.'
			<div id="'.$pkey.'--counselor--organization_id--'.$counselor_id.'" class="ornament_field ornament_recipient '.$pkey.'--counselor--organization_id--'.$counselor_id.'" style="width:100%;">'.$organization_name.'</div>					
			<div id="'.$pkey.'--client--client_name--'.$client_id.'" class="ornament_field ornament_recipient '.$pkey.'--client--client_name--'.$client_id.'" style="width:100%;">'.$client_name.'</div>									
			<div id="'.$pkey.'--client--username--'.$client_id.'" class="ornament_field"><div id="'.$pkey.'--client--username--'.$client_id.'" class="ornament_label">Email:</div><div id="'.$pkey.'--client--'.$client_id.'" class="field_value '.$pkey.'--client--'.$client_id.'">'.$username.'</div></div> 
			<div id="'.$pkey.'--client--client_phone--'.$client_id.'" class="ornament_field"><div id="'.$pkey.'--client--client_phone--'.$client_id.'" class="ornament_label">Phone:</div><div id="'.$pkey.'--client--client_phone--'.$client_id.'" class="field_value '.$pkey.'--client--client_phone--'.$client_id.'">'.$client_phone.'</div></div> 
			
			';
			
			$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}

public function load_family_grid($del_option)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$action = new action;
		
		$id = '';
		$result = mysql_query("SELECT * FROM family INNER JOIN organization ON family.organization_id = organization.organization_id INNER JOIN collector ON family.collector_id = collector.collector_id ORDER BY family_name DESC"
		);

		while($row = mysql_fetch_array($result))
		{						

	
			$family_name = $row['family_name'];
			$family_id = $row['family_id'];
			$pkey = $family_id;
			$name_dad = $row['name_dad'];
			$name_mom = $row['name_mom'];
			$family_phone = $row['family_phone'];
			$food_bagged = $row['food_bagged'];
			$food_dinner = $row['food_dinner'];
			
			$organization_id = $row['organization_id'];	
			$organization_name = $row['organization_name'];
			
			$collector_id = $row['collector_id'];	
			$collector_name = $row['collector_name'];
			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--family--'.$family_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--family--'.$family_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
					
			$rec = '<div id="rec--family--'.$pkey.'" class="ornament"><div class="ornament_body body--family--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			'.$del_button.'
							
			<div id="'.$pkey.'--family--family_name--'.$pkey.'" class="ornament_field ornament_recipient '.$pkey.'--family--family_name--'.$family_id.'" style="width:100%;">'.$family_name.'</div>
									
			<div id="'.$pkey.'--family--name_mom--'.$family_id.'" class="ornament_field"><div id="ornament_mom '.$pkey.'--family--name_mom--'.$family_id.'" class="ornament_label">Mom:</div><div id="'.$pkey.'--family--name_mom--'.$family_id.'" class="field_value '.$pkey.'--family--name_mom--'.$family_id.'">'.$name_mom.'</div></div> 
			<div id="'.$pkey.'--family--name_dad--'.$family_id.'" class="ornament_field"><div id="ornament_dad '.$pkey.'--family--name_dad--'.$family_id.'" class="ornament_label">Dad:</div><div id="'.$pkey.'--family--name_dad--'.$family_id.'" class="field_value '.$pkey.'--family--name_dad--'.$family_id.'">'.$name_dad.'</div></div> 
			<div id="'.$pkey.'--family--family_phone--'.$family_id.'" class="ornament_field"><div id="ornament_state '.$pkey.'--family--family_phone--'.$family_id.'" class="ornament_label">Phone:</div><div id="'.$pkey.'--family--family_phone--'.$family_id.'" class="field_value '.$pkey.'--family--family_phone--'.$family_id.'">'.$family_phone.'</div></div> 
			<div id="'.$pkey.'--family--food_bagged--'.$family_id.'" class="ornament_field"><div id="ornament_zip '.$pkey.'--family--food_bagged--'.$family_id.'" class="ornament_label">Bagged Food:</div><div id="'.$pkey.'--family--food_bagged--'.$family_id.'" class="field_value '.$pkey.'--family--food_bagged--'.$family_id.'">'.$food_bagged.'</div></div> 
			<div id="'.$pkey.'--family--food_dinner--'.$family_id.'" class="ornament_field"><div id="ornament_contact '.$pkey.'--family--food_dinner--'.$family_id.'" class="ornament_label">Dinner:</div><div id="'.$pkey.'--family--food_dinner--'.$family_id.'" class="field_value '.$pkey.'--family--food_dinner--'.$family_id.'">'.$food_dinner.'</div></div> 
			<div id="'.$pkey.'--family--collector_id--'.$collector_id.'" class="ornament_field"><div id="ornament_email '.$pkey.'--family--collector_id--'.$collector_id.'" class="ornament_label">Collector:</div><div id="'.$pkey.'--family--collector_id--'.$collector_id.'" class="field_value '.$pkey.'--family--family_name--'.$collector_id.'">'.$collector_name.'</div></div> 
			<div id="'.$pkey.'--organization--organization_name--'.$organization_id.'" class="ornament_field_fixed"><div id="ornament_date_due '.$pkey.'--organization--organization_name--'.$organization_id.'" class="ornament_label">Organization:</div><div id="'.$pkey.'--organization--organization_name--'.$organization_id.'" class="field_value '.$pkey.'--organization--organization_name--'.$organization_id.'">'.$organization_name.'</div></div> 
			
			';
			
	
	$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
public function load_account_grid($del_option)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$action = new action;
		
		$id = '';
		$result = mysql_query("SELECT * FROM client ORDER BY client_name DESC");

		while($row = mysql_fetch_array($result))
		{						

	
			$client_name = $row['client_name'];
			$client_id = $row['client_id'];
			$pkey = $client_id;
			$client_username = $row['username'];
			$client_password = $row['password'];
			$client_enabled = $row['enabled'];
			$client_phone = $row['client_phone'];
			
			$actions = new $action;
			
			if ($actions->exists('group_admin','client_id',$client_id) == 'true')
			{
				$is_admin = 'yes';
			}
			else {
				$is_admin = 'no';
			}
			if ($actions->exists('counselor','client_id',$client_id) == 'true')
			{
				$is_counselor = 'yes';
			}
			else {
				$is_counselor = 'no';
			}
			if ($actions->exists('collector','client_id',$client_id) == 'true')
			{
				$is_collector = 'yes';
			}
			else {
				$is_collector = 'no';
			}	
			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--client--'.$client_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--client--'.$client_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
					
			$rec = '<div id="rec--client--'.$pkey.'" class="ornament"><div class="ornament_body body--client--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			'.$del_button.'
							
			<div id="'.$pkey.'--client--client_name--'.$pkey.'" class="ornament_field ornament_recipient '.$pkey.'--client--client_name--'.$client_id.'" style="width:100%;">'.$client_name.'</div>
									
			<div id="'.$pkey.'--client--username--'.$client_id.'" class="ornament_field"><div id="ornament_mom '.$pkey.'--client--username--'.$client_id.'" class="ornament_label">Username:</div><div id="'.$pkey.'--client--username--'.$client_id.'" class="field_value '.$pkey.'--client--username--'.$client_id.'">'.$client_username.'</div></div> 
			<div id="'.$pkey.'--client--password--'.$client_id.'" class="ornament_field"><div id="ornament_dad '.$pkey.'--client--password--'.$client_id.'" class="ornament_label">Password:</div><div id="'.$pkey.'--client--password--'.$client_id.'" class="field_value '.$pkey.'--client--password--'.$client_id.'">************</div></div> 
			<div id="'.$pkey.'--client--client_phone--'.$client_id.'" class="ornament_field"><div id="ornament_state '.$pkey.'--client--client_phone--'.$client_id.'" class="ornament_label">Phone:</div><div id="'.$pkey.'--client--client_phone--'.$client_id.'" class="field_value '.$pkey.'--client--client_phone--'.$client_id.'">'.$client_phone.'</div></div> 
			<div id="'.$pkey.'--client--enabled--'.$client_id.'" class="ornament_field"><div id="ornament_zip '.$pkey.'--client--enabled--'.$client_id.'" class="ornament_label">Account Enabled:</div><div id="'.$pkey.'--client--enabled--'.$client_id.'" class="field_value '.$pkey.'--client--enabled--'.$client_id.'">'.$client_enabled.'</div></div> 
			<div id="'.$pkey.'--group_admin--client_id--'.$client_id.'" class="ornament_field"><div id="ornament_contact '.$pkey.'--group_admin--client_id--'.$client_id.'" class="ornament_label">Administrator:</div><div id="'.$pkey.'--group_admin--client_id--'.$client_id.'" class="field_value '.$pkey.'--group_admin--client_id--'.$client_id.'">'.$is_admin.'</div></div> 
			<div id="'.$pkey.'--collector--client_id--'.$client_id.'" class="ornament_field_fixed"><div id="ornament_email '.$pkey.'--collector--client_id--'.$client_id.'" class="ornament_label">Collector:</div><div id="'.$pkey.'--collector--client_id--'.$client_id.'" class="field_value '.$pkey.'--collector--client_id--'.$client_id.'">'.$is_collector.'</div></div> 
			<div id="'.$pkey.'--counselor--client_id--'.$client_id.'" class="ornament_field_fixed"><div id="ornament_date_due '.$pkey.'--counselor--client_id--'.$client_id.'" class="ornament_label">Counselor:</div><div id="'.$pkey.'--counselor--client_id--'.$client_id.'" class="field_value '.$pkey.'--counselor--client_id--'.$client_id.'">'.$is_counselor.'</div></div> 
			
			';
			
	
	$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
	public function load_organization_grid($del_option)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$action = new action;
		
		$id = '';
		$result = mysql_query("SELECT * FROM organization ORDER BY organization_name DESC"
		);

		while($row = mysql_fetch_array($result))
		{						

			$pkey = $row['pkey'];	
			$organization_id = $row['organization_id'];	
			$pkey = $organization_id;
			
			$organization_name = $row['organization_name'];
			$organization_street = $row['street'];
			$organization_city = $row['city'];
			
			$organization_zip = $row['zip'];
			$organization_state = $row['state'];
			$organization_contact = $row['contact'];
			$organization_email= $row['email'];
			$organization_date_due = $row['date_due'];
			$organization_notes = $row['notes'];
			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--organization--'.$organization_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--organization--'.$organization_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
						
			$rec = '<div id="rec--organization_id--'.$pkey.'" class="ornament"><div class="ornament_body body--organization--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			'.$del_button.'
							
			<div id="'.$pkey.'--organization--organization_name--'.$pkey.'" class="ornament_field ornament_recipient '.$pkey.'--organization--organization_name--'.$organization_id.'" style="width:100%;">'.$organization_name.'</div>
									
			<div id="'.$pkey.'--organization--street--'.$organization_id.'" class="ornament_field"><div id="ornament_street '.$pkey.'--organization--street--'.$organization_id.'" class="ornament_label">Street:</div><div id="'.$pkey.'--organization--street--'.$organization_id.'" class="field_value '.$pkey.'--organization--street--'.$organization_id.'">'.$organization_street.'</div></div> 
			<div id="'.$pkey.'--organization--city--'.$organization_id.'" class="ornament_field"><div id="ornament_city '.$pkey.'--organization--city--'.$organization_id.'" class="ornament_label">City:</div><div id="'.$pkey.'--organization--city--'.$organization_id.'" class="field_value '.$pkey.'--organization--city--'.$organization_id.'">'.$organization_city.'</div></div> 
			<div id="'.$pkey.'--organization--state--'.$organization_id.'" class="ornament_field"><div id="ornament_state '.$pkey.'--organization--state--'.$organization_id.'" class="ornament_label">State:</div><div id="'.$pkey.'--organization--state--'.$organization_id.'" class="field_value '.$pkey.'--organization--state--'.$organization_id.'">'.$organization_state.'</div></div> 
			<div id="'.$pkey.'--organization--zip--'.$organization_id.'" class="ornament_field"><div id="ornament_zip '.$pkey.'--organization--zip--'.$organization_id.'" class="ornament_label">Zipcode:</div><div id="'.$pkey.'--organization--zip--'.$organization_id.'" class="field_value '.$pkey.'--organization--zip--'.$organization_id.'">'.$organization_zip.'</div></div> 
			<div id="'.$pkey.'--organization--contact--'.$organization_id.'" class="ornament_field"><div id="ornament_contact '.$pkey.'--organization--contact--'.$organization_id.'" class="ornament_label">Contact:</div><div id="'.$pkey.'--organization--contact--'.$organization_id.'" class="field_value '.$pkey.'--organization--contact--'.$organization_id.'">'.$organization_contact.'</div></div> 
			<div id="'.$pkey.'--organization--email--'.$organization_id.'" class="ornament_field"><div id="ornament_email '.$pkey.'--organization--email--'.$organization_id.'" class="ornament_label">Email:</div><div id="'.$pkey.'--organization--email--'.$organization_id.'" class="field_value '.$pkey.'--organization--email--'.$organization_id.'">'.$organization_email.'</div></div> 
			<div id="'.$pkey.'--organization--date_due--'.$organization_id.'" class="ornament_field"><div id="ornament_date_due '.$pkey.'--organization--date_due--'.$organization_id.'" class="ornament_label">Due Date:</div><div id="'.$pkey.'--organization--date_due--'.$organization_id.'" class="field_value '.$pkey.'--organization--date_due--'.$organization_id.'">'.$organization_date_due.'</div></div> 
			<div id="'.$pkey.'--organization--notes--'.$organization_id.'" class="ornament_field"><div id="ornament_notes '.$pkey.'--organization--notes--'.$organization_id.'" class="ornament_label">Notes:</div><div id="'.$pkey.'--organization--notes--'.$organization_id.'" class="field_value '.$pkey.'--organization--notes--'.$organization_id.'">'.$organization_notes.'</div></div> 
		
			';
			
	
	$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
public function load_collector_grid($del_option)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$message_back = '';
		$action = new action;
		
		$id = '';
		$result = mysql_query("SELECT * FROM collector ORDER BY collector_name DESC"
		);

		while($row = mysql_fetch_array($result))
		{						

			$collector_id = $row['collector_id'];
			$pkey = $collector_id;
			
			$collector_name = $row['collector_name'];
			$collector_instructions = $row['instructions'];
			$collector_city = $row['city'];
			$collector_street = $row['street'];
			$collector_zip = $row['zip'];
			$collector_state = $row['state'];
			$collector_phone = $row['phone'];
			$collector_email= $row['email'];

			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--collector--'.$collector_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--collector--'.$collector_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
						
			$rec = '<div id="rec--collector--'.$pkey.'" class="ornament"><div class="ornament_body body--collector--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--recipient_id--'.$pkey.'" class="ornament_field_wrapper">
			'.$del_button.'
							
			<div id="'.$pkey.'--collector--collector_name--'.$pkey.'" class="ornament_field ornament_recipient '.$pkey.'--collector--collector_name--'.$collector_id.'" style="width:100%;">'.$collector_name.'</div>
									
			<div id="'.$pkey.'--collector--street--'.$collector_id.'" class="ornament_field"><div id="ornament_street '.$pkey.'--collector--street--'.$collector_id.'" class="ornament_label">Street:</div><div id="'.$pkey.'--collector--street--'.$collector_id.'" class="field_value '.$pkey.'--collector--street--'.$collector_id.'">'.$collector_street.'</div></div> 
			<div id="'.$pkey.'--collector--city--'.$collector_id.'" class="ornament_field"><div id="ornament_city '.$pkey.'--collector--city--'.$collector_id.'" class="ornament_label">City:</div><div id="'.$pkey.'--collector--city--'.$collector_id.'" class="field_value '.$pkey.'--collector--city--'.$collector_id.'">'.$collector_city.'</div></div> 
			<div id="'.$pkey.'--collector--state--'.$collector_id.'" class="ornament_field"><div id="ornament_state '.$pkey.'--collector--state--'.$collector_id.'" class="ornament_label">State:</div><div id="'.$pkey.'--collector--state--'.$collector_id.'" class="field_value '.$pkey.'--collector--state--'.$collector_id.'">'.$collector_state.'</div></div> 
			<div id="'.$pkey.'--collector--zip--'.$collector_id.'" class="ornament_field"><div id="ornament_zip '.$pkey.'--collector--zip--'.$collector_id.'" class="ornament_label">Zipcode:</div><div id="'.$pkey.'--collector--zip--'.$collector_id.'" class="field_value '.$pkey.'--collector--zip--'.$collector_id.'">'.$collector_zip.'</div></div> 
			<div id="'.$pkey.'--collector--phone--'.$collector_id.'" class="ornament_field"><div id="ornament_contact '.$pkey.'--collector--phone--'.$collector_id.'" class="ornament_label">Phone:</div><div id="'.$pkey.'--collector--phone--'.$collector_id.'" class="field_value '.$pkey.'--collector--phone--'.$collector_id.'">'.$collector_phone.'</div></div> 
			<div id="'.$pkey.'--collector--email--'.$collector_id.'" class="ornament_field"><div id="ornament_email '.$pkey.'--collector--email--'.$collector_id.'" class="ornament_label">Email:</div><div id="'.$pkey.'--collector--email--'.$collector_id.'" class="field_value '.$pkey.'--collector--email--'.$collector_id.'">'.$collector_email.'</div></div> 
			<div id="'.$pkey.'--collector--instructions--'.$collector_id.'" class="ornament_field"><div id="ornament_instructions '.$pkey.'--collector--instructions--'.$collector_id.'" class="ornament_label">Due Date:</div><div id="'.$pkey.'--collector--instructions--'.$collector_id.'" class="field_value '.$pkey.'--collector--instructions--'.$collector_id.'">'.$collector_instructions.'</div></div> 
		
			';
			
	
	$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
public function load_sponsor_grid($del_option,$sponsor_id)
	{
		
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';
		$message = '';
		$action = new action;
		
		$id = '';
		if ($sponsor_id != '')
		{
			$result = mysql_query("SELECT * FROM sponsor 
			INNER JOIN recipient ON sponsor.recipient_id = recipient.recipient_id 
			INNER JOIN family ON family.family_id = recipient.family_id  
			INNER JOIN organization ON organization.organization_id = family.organization_id  
			WHERE sponsor_id = '$sponsor_id'");
		}
		else
		{
			$result = mysql_query("SELECT * FROM sponsor 
			INNER JOIN recipient ON sponsor.recipient_id = recipient.recipient_id 
			INNER JOIN family ON family.family_id = recipient.family_id  
			INNER JOIN organization ON organization.organization_id = family.organization_id  
			ORDER BY sponsor_name DESC");
		}
	

		while($row = mysql_fetch_array($result))
		{						

			$pkey = $row['pkey'];	
			$sponsor_id = $row['sponsor_id'];	
			$pkey = $sponsor_id;		
			$sponsor_name = $row['sponsor_name'];			
			$sponsor_email= $row['sponsor_email'];
			$sponsor_phone= $row['sponsor_phone'];
			

			$recipient_name = $row['recipient_name'];
			$recipient_id = $row['recipient_id'];
			$family_count = $row['family_count'];
			
			$family_name = $row['family_name'];
			$family_id = $row['family_id'];
			
			$organization_id = $row['organization_id'];
			$organization_name = $row['organization_name'];
			
			if ($del_option == 'del_option'){
				
				$del_button = '<div id="del--sponsor--'.$sponsor_id.'" alt="delete" class="ornament_delete"></div><div id="delerr--sponsor--'.$sponsor_id.'" class="del_error"></div>';
			}
			else
			{
				$del_button = '';
			}
						
			$rec = '<div id="rec--sponsor--'.$pkey.'" class="ornament"><div class="ornament_body body--sponsor--'.$pkey.'">';
			$message = $message.$rec;
			
			$message = $message. '<div id="left_recipient--id--'.$pkey.'" class="ornament_field_wrapper">
			
			'.$del_button.'				
			<div id="'.$pkey.'--sponsor--sponsor_name--'.$sponsor_id.'" class="ornament_field ornament_recipient '.$pkey.'--sponsor--sponsor_name--'.$sponsor_id.'" style="width:100%;">'.$sponsor_name.'</div>									
			<div id="'.$pkey.'--sponsor--sponsor_email--'.$sponsor_id.'" class="ornament_field"><div id="'.$pkey.'--sponsor--sponsor_email--'.$sponsor_id.'" class="ornament_label">Email:</div><div id="'.$pkey.'--sponsor--sponsor_email--'.$sponsor_id.'" class="field_value '.$pkey.'--sponsor--sponsor_email--'.$sponsor_id.'">'.$sponsor_email.'</div></div> 
			<div id="'.$pkey.'--sponsor--sponsor_phone--'.$sponsor_id.'" class="ornament_field"><div id="'.$pkey.'--sponsor--sponsor_phone--'.$sponsor_id.'" class="ornament_label">Phone:</div><div id="'.$pkey.'--sponsor--sponsor_phone--'.$sponsor_id.'" class="field_value '.$pkey.'--sponsor--sponsor_phone--'.$sponsor_id.'">'.$sponsor_phone.'</div></div> 
			
			';
			
			$message = $message . '</div></div></div>';	
	
	

	
	}
		
	return $message;		
	

	}
	
	public function next_family_member_count($family_id)
	{
		
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$count = 0;
		$result = mysql_query("SELECT * FROM recipient WHERE family_id = '$family_id'");		
		while($row = mysql_fetch_array($result))
		{
			//$id = $row['pkey'];	
			$count = $count+1;
		}
		
		$count = $count + 1;
		$count = (string)$count;
		return $count;
	}
	public function load_family_list()
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '<option value=""></option><option value="--new_family">Add New Family</option>';
		
		$result = mysql_query("SELECT * FROM family");		
		while($row = mysql_fetch_array($result))
		{
			$name = $row['family_name'];
			$id = $row['family_id'];
		$message = $message. '<option value="'.$id.'">'.$id.' '.$name.'</option>';

		}
		
		return $message;
	}
	public function load_recipient_list()
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM recipient 
		INNER JOIN need ON recipient.recipient_id = need.recipient_id 
		INNER JOIN family ON recipient.family_id = family.family_id 
		INNER JOIN organization ON family.organization_id = organization.organization_id 
		WHERE recipient.recipient_id <> '0' 
		ORDER BY recipient.recipient_id DESC");
			
		while($row = mysql_fetch_array($result))
		{
			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$recipient_name = $row['recipient_name'];
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];
			
						
			$formated_name = $organization_id.$family_id.'-'.$family_count;
		
		$message = $message. '<option value="'.$recipient_id.'">'.$recipient_name .'  ('.$formated_name.')</option>';

		}
		
		return $message;
	}
	public function export_recipients($limit)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '';
				
	
		
		if ($limit == 'yes')
		{
			$stop_point = '0';	
			
			$result = mysql_query("SELECT last_export FROM export WHERE export_id = '1'");	
			
			while($row = mysql_fetch_array($result))
			{
				$old_count = $row['last_export'];
			}
			
			$new_count = mysql_query("SELECT COUNT(DISTINCT recipient_id) AS recipient_num FROM recipient");
				
			while($row = mysql_fetch_array($new_count))
			{
				$my_count = $row['recipient_num'];
			}
			
			$stop_point = $my_count - $old_count;

			if ($stop_point <= '0')
			{
				return 'No new Recipients...';
			}
			
			$result = mysql_query("SELECT * FROM recipient 
			INNER JOIN need ON recipient.recipient_id = need.recipient_id 
			INNER JOIN family ON recipient.family_id = family.family_id 
			INNER JOIN organization ON family.organization_id = organization.organization_id 
			INNER JOIN collector ON collector.collector_id = family.collector_id
			WHERE recipient.recipient_id <> '0' ORDER BY recipient.recipient_id DESC LIMIT $stop_point");	
		}
		else 
		{			

		
			$result = mysql_query("SELECT * FROM recipient 
			INNER JOIN need ON recipient.recipient_id = need.recipient_id 
			INNER JOIN family ON recipient.family_id = family.family_id 
			INNER JOIN organization ON family.organization_id = organization.organization_id 
			INNER JOIN collector ON collector.collector_id = family.collector_id
			WHERE recipient.recipient_id <> '0' ORDER BY recipient.recipient_id DESC");
		
		}
		
			$action = new action;

		while($row = mysql_fetch_array($result))
		{
				
			

			$pkey = $row['recipient_id'];
			$family_count= $row['family_count'];
			$family_id= $row['family_id'];
			$recipient_id= $row['recipient_id'];
			$recipient_name = $row['recipient_name'];
			$recipient_age= $row['age'];
			$recipient_gender = $row['gender'];		
			$clothing_items = $row['clothing_items'];
			$clothing_sock_size = $row['clothing_sock_size'];
			$clothing_other_size = $row['clothing_other_size'];
			$clothing_other_color = $row['clothing_other_color'];
			$clothing_underware_size = $row['clothing_underware_size'];
			$need_id =  $row['need_id'];
			$gift = $row['gift'];			
			$family_id = $row['family_id'];
			$family = $row['family_name'];
			$organization_id = $row['organization_id'];
			$organization_due_date = $row['date_due'];
			$organization = $row['organization_name'];
			$organization_id = $row['organization_id'];
			
			$collector_id = $row['collector_id'];
			$collector_name = $row['collector_name'];
			$collector_instructions = $row['instructions'];
		
			
			$formated_id = $organization_id.$family_id.'-'.$family_count;
			
			$message = $message.'	'.$recipient_id.'	'.$recipient_name.'	'.$recipient_gender.'		'.$recipient_age.'		'.$formated_id.'		'.$clothing_items.'		'.$clothing_sock_size.
			'		'.$clothing_other_size.'		'.$clothing_other_color.'		'.$clothing_underware_size.'		'.$collector_name.'		'.$collector_instructions;
			
		}
			$myFile = "../export/recipients.txt";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $message);
			fclose($fh);
			
	
			$new_count = mysql_query("SELECT COUNT(DISTINCT recipient_id) AS recipient_num FROM recipient");	
			while($row = mysql_fetch_array($new_count))
			{
				$mycount = $row['recipient_num'];
			}
			
				$result = mysql_query("UPDATE export SET last_export = '$mycount' WHERE export_id = '1' ");	
	
			$filename = 'recipients.txt';
			$myheader = '<?php header(\'Content-Disposition: attachment; filename="' . $filename . '"\'); 
			readfile("recipients.txt");
			?>';
			$myFile = "../export/export.php";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $myheader);
			fclose($fh);
			
			return '<a href="../export/export.php">Recipient List</a>';

		
	}
	public function load_organization_list()
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM organization");		
		while($row = mysql_fetch_array($result))
		{
			$name = $row['organization_name'];
			$id = $row['organization_id'];
		$message = $message. '<option value="'.$id.'">'.$name.'</option>';

		}
		
		return $message;
	}
	public function load_collector_list()
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM collector");		
		while($row = mysql_fetch_array($result))
		{
			$name = $row['collector_name'];
			$id = $row['collector_id'];
		$message = $message. '<option value="'.$id.'">'.$id.' '.$name.'</option>';

		}
		
		return $message;
	}
		
	public function need_list()
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$message = '<option value=""></option>';
		
		$result = mysql_query("SELECT * FROM need_list");		
		while($row = mysql_fetch_array($result))
		{
			$name = $row['name'];
		$message = $message. '<option value="'.$name.'">'.$name.'</option>';

		}
		
		return $message;
	}
	public function family_member_count($family_id)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		$result = '';
		$row = '';
		$foundit = 0;
		
		$result = mysql_query("SELECT * FROM recipient WHERE family_id = '$family_id'");		
		while($row = mysql_fetch_array($result))
		{
			$foundit = $foundit + 1;
		}
		
		return $foundit;
	}
	public function in_group($client_id,$table)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		
		// 1
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
	
	public function get_field_value($table,$field,$pkey_field,$pkey_value)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
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
	public function update_field_by_pkey($table,$field,$myvalue,$pkey)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){die('Could not connect: ' . mysql_error());}
		mysql_select_db("$db", $con);
		$result = '';
		$row = '';

		$result = mysql_query("UPDATE $table SET $field='$myvalue' WHERE pkey='$pkey'");
		
		return $result;
	}
	public function exists($table,$field,$value)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
			mysql_select_db("$db", $con);
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
	
							
	public function send_welcome_email($username,$password,$name,$role)
	{

	$action = new action;
	 $subject = "Welcome New $role - TWUMC Christmas Miracles ";
		

		$USERNAME = "USERNAME: $username <br>";
		$PASSWORD = "PASSWORD: $password <br>";
		$LINK = "URL: <a href=\"http://cm.thewoodlandsumc.org\">cm.thewoodlandsumc.org</a> <br>";
		
		
		 $WELCOME = "<br><b>Welcome $name!</b><br>
							The Woodlands Methodist Church has created you an account for the online Christmas Miracles website. Login using the username and password stated below.
							<br><br>$USERNAME $PASSWORD $LINK";

		
			$message = "<html><head><style>*{font-size:10pt;}</style></head>
				$WELCOME 
			";
		
		return $message;
		$doit = $action->send_summery($username,$subject,$message);
		
		return $doit;
	}
	
	public function send_summery($to,$subject,$message)
	{
	
		$headers = "From: webmaster@twumc.org\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$from = "webmaster@twumc.org";
	

		$ok = @mail($to,$subject,$message,$headers);
	
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

}
//******************************************************************************


?>