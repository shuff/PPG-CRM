<?php

//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************
//check if calling from the correct domain.
$pageURL = $_SERVER["SERVER_NAME"];
if ($pageURL != 'crm.patriotpaymentgroup.com')
{

	die();
	
}


$whoami = $_COOKIE['ppg_crm_client_id'];

$action = new bgck_func();
$alive = $action->ding_dong('client','client_id',$whoami);
$enabled = $action->can_i_come_in($whoami);

if ($alive == 'yes' && $enabled == 'true')
{
	//person is valid, continue
}
else { die();}
//******************************************************************************


class bgck_func
{
	public function bgck_func()
	{}

public function ding_dong($table,$field,$value)
	{
		$table = 'client';
		$field = 'client_id';
		$value = trim($value);
		
		require_once 'ppg.f.database.php';$action = new bgck_func;
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
	
	public function can_i_come_in($client_id)
	{
		
	
		require_once 'ppg.f.database.php';$action = new bgck_func;
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
