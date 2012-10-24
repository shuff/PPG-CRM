<?php

//******************************************************************************
//  					STANDARD BACKGROUND CHECK
//******************************************************************************
//check if calling from the correct domain.
$pageURL = $_SERVER["SERVER_NAME"];
if ($pageURL != 'crm.patriotpaymentgroup.com')
{

	header('Location: index.html');
	die();
	
}


$whoami = $_COOKIE['ppg_crm_client_id'];

$action = new bgck;
$alive = $action->knock_knock('client','client_id',$whoami);
$enabled = $action->can_i_play($whoami);


if ($alive == 'yes' && $enabled == 'true')
{
	//person is valid, continue
}
else { header('Location: /'); die('Failed BC');
}
//******************************************************************************


class bgck
{
	

public function knock_knock($table,$field,$value)
	{
		$table = 'client';
		$field = 'client_id';
		$value = trim($value);
		
		require_once 'ppg.f.database.php';
			$result = '';
			$row = '';
			$foundit = 'no';
			$result = mysql_query("SELECT * FROM client WHERE client_id = '$value'");
			
			while($row = mysql_fetch_array($result))
			{
				if ($value == $row['client_id'])
				{
					$foundit = 'yes';
					if ($foundit='yes'){return $foundit;}
				}
			
			}
			return $foundit;
		
		
	}
	
	public function can_i_play($client_id)
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
