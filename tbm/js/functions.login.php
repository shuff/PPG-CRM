<?php

ini_set('display_errors',1); 
 error_reporting(E_ALL);
//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************


//check if calling from the correct domain.
$pageURL = trim($_SERVER["SERVER_NAME"]);
if ($pageURL != 'www.bestfigs.com' && $pageURL != 'apps.thewoodlandsumc.org' && $pageURL != 'comm.thewoodlandsumc.org' && $pageURL != 'cm-dev.thewoodlandsumc.org'&& $pageURL != 'dev.thewoodlandsumc.org')
{
	echo '<h1>Could not process request.</h1>';
	die();
}


//******************************************************************************
//******************************************************************************
// 									SET VARs & INCLUDES
//******************************************************************************
$action = new login;
$email = new email;

//******************************************************************************

//******************************************************************************
// 									INCOMMING
//******************************************************************************

if (isset($_REQUEST['email_password']))
{
	$my_password = mysql_real_escape_string($_REQUEST['password']);
	$my_email = mysql_real_escape_string($_REQUEST['email']);
	$doit = $email->email_password($my_email,$my_password);
	die($doit);
}

if (isset($_REQUEST['get_password']))
{
	$get_password = mysql_real_escape_string($_REQUEST['get_password']);
	$doit = $action->get_password($get_password);
	die($doit);
}

if(isset($_REQUEST['login_validate']))
{
	if(isset($_REQUEST['username']))
		{$username = $_REQUEST['username'];}
	if(isset($_REQUEST['password']))
		{$password = $_REQUEST['password'];}
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	die(trim($action->log_me_in($username,$password)));

} 

if(isset($_REQUEST['client_enabled']))
{
	$id = $_REQUEST['client_enabled'];
	$id = mysql_real_escape_string($id);
	die(trim($action->enabled($id)));
} 

if(isset($_REQUEST['exists']))
{
	$table = $_REQUEST['table'];
	$field = $_REQUEST['field'];
	$value = $_REQUEST['value'];
	mysql_real_escape_string($table);
	mysql_real_escape_string($field);
	mysql_real_escape_string($value);
	die(trim($action->exists($table,$field,$value)));
} 


//******************************************************************************

class email
{
 public function email()
 {}
 	
 	public function email_password($to, $password)
 	{

 		$headers = "From: webmaster@twumc.org\r\n";
 		$headers .= "MIME-Version: 1.0\r\n";
 		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 		$to = $to;
 		$from = "webmaster@twumc.org";
 		
 		$subject = "TWUMC Giving Tree - Login";
 		$message = "Login: $to <br><br> Password: $password";
 		
 		//echo($subject . $message . $my_email);
 		//return	$send_it->with_to($my_email, $subject, $message);
 	
 		$ok = @mail($to,$subject,$message,$headers);
 	
 			if($ok) {

 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	;
	 }
 
}

class login
{
	public function login()
	{}

	public function establish_session($client_id,$username)
	{
		//$cookie_life = time() + 31536000;

		//$doit = setcookie('twumc_gt_client_id',$client_id,$cookie_life);
		//$doit = setcookie('twumc_gt_session_id',time(),$cookie_life);
		//$doit = setcookie('twumc_gt_email',$username,$cookie_life);
		//$doit = setcookie('twumc_gt_auto_login','yes',$cookie_life);		
		
		//return ;
	}	


	public function get_password($username)
	{
		require_once "class.goodies.php";
		$goodies_class = new goodies;

		$sqllogin = $goodies_class->getlogin();
		$sqlpassword = $goodies_class->getpassword();
		$host = $goodies_class->gethost();
		$db = $goodies_class->getdbname();
	
		$con = mysql_connect("$host","$sqllogin","$sqlpassword");
	
		if (!$con){
			return 'Could not connect: ' . mysql_error();
		}
		mysql_select_db("$db", $con);
	
		$result= ''; 
		$foundit= '';
		$value = '';
		
		$result = mysql_query("SELECT * FROM client WHERE username = '$username'");
	
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
	public function enabled($username)
	{
		
		$username= strtolower($username);
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
			$foundit = 'false';
			$result = mysql_query("SELECT * FROM client WHERE username= '$username'");
			
			while($row = mysql_fetch_array($result))
			{
			
				if ($row['enabled'] == 'yes')
				{
					
					$foundit = 'true';
				}
			
			}
			
		}
		return $foundit;
	}	
	
	public function log_me_in($username,$password)
	{
		$username= strtolower($username);		
		$action = new login;
		
		if($action->enabled($username) == 'false'){return 'false';}

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
			$foundit = 'false';
			$result = mysql_query("SELECT * FROM client WHERE lcase(username) = '$username'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($password == $row['password'])
				{
					
					$foundit = 'true';
				}
			
			}
			
		}
		
		if ($foundit == 'true')
		{
			$client_id = $action->get_client_id($username,$password);
			//$doit = $action->establish_session($client_id,$username);
		}
		
		return $client_id;
	}	
	
	
	public function get_client_id($username,$password)
	{
	
		$username= strtolower($username);
	
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
			$id = '';
			

			$result = mysql_query("SELECT * FROM client WHERE lcase(username) = '$username'");
			
			while($row = mysql_fetch_array($result))
			{
			
				if ($password == $row['password']) {$uid = $row['client_id'];}
			
			}			
			
			return $uid;
		
	}
	

	
}

//******************************************************************************


	?>