<?php

//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************
//check if calling from the correct domain.
$pageURL = trim($_SERVER["SERVER_NAME"]);
if ($pageURL != '108.171.191.231')
{

	header('Location: index.html');
	die();
}


$whoami = $_COOKIE['ppg_crm_client_id'];

$action = new login();
$alive = $action->exists('client','client_id',$whoami);
$enabled = $action->caniplay($whoami);

if ($alive == 'yes' && $enabled == 'true')
{
	//person is valid, continue
}
//else { header('Location: /'); die();}
//******************************************************************************


class login
{
	public function login()
	{}

public function exists($table,$field,$value)
	{
		$table = 'client';
		$field = 'client_id';
		$value = trim($value);
		
			require_once 'ppg.f.database.php';

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
		
	
	
	public function caniplay($client_id)
	{
		
	
require_once 'ppg.f.database.php';
			$result = '';
			$row = '';
			$foundit = 'false';
			$result = mysql_query("SELECT * FROM client WHERE client_id= '$client_id'");
			
			while($row = mysql_fetch_array($result))
			{
			
				if ($row['client_enabled'] == 'yes')
				{
					
					$foundit = 'true';
				}
			
			}
			
		
		return $foundit;
	}	
	
}

?>
