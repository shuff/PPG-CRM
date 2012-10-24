<?php 

		require_once 'ppg.f.database.php';

		$row = '';
		$message = '';

		$result = mysql_query("SELECT * FROM orders");

		while($row = mysql_fetch_array($result))
		{
			$merchant_id = $row['merchant_id'];
			$amount_processed = $row['amount_processed'];
			$number_processed = $row['number_processed'];

			$result2= mysql_query("SELECT * FROM transaction_history WHERE merchant_id = '$merchant_id' ORDER BY timestamp DESC LIMIT 30");
			if (mysql_num_rows($result2) < 30){$doit = mysql_query("INSERT INTO transaction_history (merchant_id,amount_processed,number_processed)VALUES
				('$merchant_id','$amount_processed','$number_processed')");}
			else{
				$i = 0;
				while ($row2 = mysql_fetch_array($result2))
				{
					if ($i=0){
						$pkey = $row2['pkey'];
						$doit = ("UPDATE transaction_history SET amount_processed='$amount_processed',number_processed='$number_processed' WHERE pkey='$pkey'");
					}
					$i++;
				}
			}
			
		}

echo $doit;
?>
