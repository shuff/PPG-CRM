<?php
final class com_portal_login
{
	public function com_portal_login()
	{}
	
	
	
	public function get_password($email)
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
	
		$result= '';
		$foundit= '';
		$value = '';
		
		$result = mysql_query("SELECT * FROM client WHERE email = '$email'");
	
				while($row = mysql_fetch_array($result))
			{
				$value = $row['password'];
			
			}
			return $value;
	
	}
	public function exists($table,$field,$value)
	{
		$table = trim($table);
		$field = trim($field);
		$value = trim($value);
		
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
		else
		{
			mysql_select_db("$db", $con);
			$result = '';
			$row = '';
			$foundit = 'no';
			$result = mysql_query("SELECT * FROM $table WHERE $field = '$value'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($value == $row[$field])
				{
					$foundit = 'yes';
				}
			
			}
			return $foundit;
		}
		
	}
	public function login($com_client,$com_password)
	{
		$com_client = strtolower($com_client);
		
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
		else
		{
			mysql_select_db("$db", $con);
			$result = '';
			$row = '';
			$foundit = 'no';
			$result = mysql_query("SELECT * FROM client WHERE lcase(email) = '$com_client'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($com_password == $row['password'])
				{
					
					$foundit = 'yes';
				}
			
			}
			
		}
		return $foundit;
	}	
	
	public function get_client_fb_id($fb_id)
	{
		$com_client = strtolower($com_client);
	
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
		else
		{
			mysql_select_db("$db", $con);
			$result = '';
			$row = '';
			$foundit = 'no';
			$result = mysql_query("SELECT * FROM client WHERE facebook_id = '$fb_id'");
	
			while($row = mysql_fetch_array($result))
			{
				if ($fb_id == $row['facebook_id'])
				{
					$foundit = $row['pkey'];
				}
	
			}
	
		}
		return $foundit;
	}
	
	public function get_client_uid($com_client,$com_password,$fb_id)
	{
	
		$com_client = strtolower($com_client);
	
		require_once "class.goodies.php";
		$goodies_class = new goodies;
	
		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	
			mysql_select_db("$db", $con);
			$result = '';
			$row = '';
			$uid = '';
			$foundit = 'no';
			
		if ($fb_id == 'none')
		{
			$result = mysql_query("SELECT * FROM client WHERE lcase(email) = '$com_client'");
			
			while($row = mysql_fetch_array($result))
			{
			
				if ($com_password == $row['password']) {$uid = $row['id'];}
			
			}			
			
			return $uid;
		}
		else 
		{
			$result = mysql_query("SELECT * FROM client WHERE facebook_id = '$fb_id'");
	
			while($row = mysql_fetch_array($result))
			{
				
				$uid = $row['id'];
	
			}

			return $uid;
		}	
	}
	
	
	
	
}
?>