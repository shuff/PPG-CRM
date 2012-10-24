<?php
/**
  * Author: Ted Hayes
	* Based on code by: Ernest Wojciuk
	* Web Site: www.liminastudio.com
	*/

#ini_set('max_execution_time', 3000);
#ini_set('default_socket_timeout', 3000);
#ini_set('memory_limit','512M');

class EMAIL_TO_DB {

	var $IMAP_host; #pop3 server

	var $IMAP_port; #pop3 server port

	var $IMAP_login;

	var $IMAP_pass;

	var $FILE_OWNER = 'shuff';		// owner of downloaded file attachments

	var $link;

	var $error = array();

	var $status;

	var $max_headers = 'max';  #How much headers you want to retrive 'max' = all headers

	var $filestore;

	var $filename_array;

	var $file_path;
	
	var $attachments_path = 'files/email';

	var $partsarray = array();

	var $msgid =1;

	var $msgid_start = 1;

	var $newid;

	var $logid;

	//var $this_file_name = 'itp_list_to_db.php'; #If mode "html" 

	//var $mode = 'html'; #If script run from cron "mode" =  "cron" or ""; mode "html" is using if You run script from browser

	var $spam_folder = 1; #Folder where moving spam (ID from DB)

	var $file = array(); #File in multimart message

	function connect($host, $port, $login, $pass){
		
		$fullpath = $_SERVER["PHP_SELF"];
		$thisfile = basename($fullpath); 
		$cutoffpos = strpos($fullpath,$thisfile); 
		$this->file_path = substr($fullpath, 0, $cutoffpos).$this->attachments_path;

		$this->IMAP_host = $host;
		$this->IMAP_login = $login;

		// Using folder: [Gmail]/All Mail
		//$this->link = imap_open("{". $host . $port."}INBOX", $login, $pass);
		$this->link = imap_open("{". $host . $port."}[Gmail]/All Mail", $login, $pass);

		if($this->link) {
			$this->status = 'Connected';
		} else {
			$this->error[] = imap_last_error();
			$this->status = 'Not connected';
		}
	}

	function set_path(){

		#If You need set here more parameters
		# - recognise operating systems, or something

		$path = $this->file_path;

		return $path;
	}


	function set_filestore(){
		$dir = $this->dir_name();
		$path = $this->set_path();
		//$this->filestore = $path.$dir;
		$this->filestore = $dir;

	}

	/**
		* Get mailbox info
		*/
	function mailboxmsginfo(){

		//$mailbox = imap_mailboxmsginfo($this->link); #It's very slow
		$mailbox = imap_check($this->link);

		if ($mailbox) {
			$mbox["Date"]    = $mailbox->Date;
			$mbox["Driver"]  = $mailbox->Driver;
			$mbox["Mailbox"] = $mailbox->Mailbox;
			$mbox["Messages"]= $this->num_message();
			$mbox["Recent"]  = $this->num_recent();
			$mbox["Unread"]  = $mailbox->Unread;
			$mbox["Deleted"] = $mailbox->Deleted;
			$mbox["Size"]    = $mailbox->Size;
		} else {
			$this->error[] = imap_last_error();
		}

		return $mbox;
	}

	/**
		* Number of Total Emails
		*/
	function num_message(){
		return imap_num_msg($this->link);
	}

	/**
		* Number of Recent Emails
		*/
	function num_recent(){
		return imap_num_recent($this->link);
	}

	/**
		* Type and subtype message
		*/
	function msg_type_subtype($_type){

		if($_type > 0){
			switch($_type){
				case '0': $type = "text"; break;
				case '1': $type = "multipart"; break;
				case '2': $type = "message"; break;
				case '3': $type = "application"; break;
				case '4': $type = "audio"; break;
				case '5': $type = "image"; break;
				case '6': $type = "video"; break;
				case '7': $type = "other"; break;
			}
		}

		return $type;
	}
	/**
		* Flag message
		*/
	function email_flag(){

		switch ($char) {
			case 'S':
			if (strtolower($flag) == '\\seen') {
				$msg->is_seen = true;
			}
			break;
			case 'A':
			if (strtolower($flag) == '\\answered') {
				$msg->is_answered = true;
			}
			break;
			case 'D':
			if (strtolower($flag) == '\\deleted') {
				$msg->is_deleted = true;
			}
			break;
			case 'F':
			if (strtolower($flag) == '\\flagged') {
				$msg->is_flagged = true;
			}
			break;
			case 'M':
			if (strtolower($flag) == '$mdnsent') {
				$msg->is_mdnsent = true;
			}
			break;
			default:
			break;
		}
	}

	/**
		* Parse e-mail structure
		*/
	function parsepart($p,$msgid,$i){

		$part=imap_fetchbody($this->link,$msgid,$i);
		#Multipart
		if ($p->type!=0){
			#if base64
			if ($p->encoding==3) $part = base64_decode($part);
			#if quoted printable
			if ($p->encoding==4) $part = quoted_printable_decode($part);
			#If binary or 8bit -we no need to decode

			#body type (to do)
			switch($p->type) {
				case '5': # image
				$this->partsarray[$i]['image'] = array('filename'=>$imag1,'string'=>$part, 'part_no'=>$i);
				break;
			}

			#Get attachment
			$filename='';
			if (count($p->dparameters)>0){
				foreach ($p->dparameters as $dparam){
					if ((strtoupper($dparam->attribute)=='NAME') ||(strtoupper($dparam->attribute)=='FILENAME')) $filename=$dparam->value;
				}
			}
			#If no filename
			if ($filename==''){
				if (count($p->parameters)>0){
					foreach ($p->parameters as $param){
						if ((strtoupper($param->attribute)=='NAME') ||(strtoupper($param->attribute)=='FILENAME')) $filename=$param->value;
					}
				}
			}
			if ($filename!=''){
				$this->partsarray[$i]['attachment'] = array('filename'=>$filename,'string'=>$part, 'encoding'=>$p->encoding, 'part_no'=>$i,'type'=>$p->type,'subtype'=>$p->subtype);

			}
			#end if type!=0       
		}

		#Text email
		else if($p->type==0){
			#decode text
			#if QUOTED-PRINTABLE
			if ($p->encoding==4) $part=quoted_printable_decode($part);
			#if base_64
			if ($p->encoding==3) $part=base64_decode($part);

			#if plain text
			if (strtoupper($p->subtype)=='PLAIN')1;
			#if HTML
			else if (strtoupper($p->subtype)=='HTML')1;
			//echo "\t MP BODY: ".$part."\t";
			$this->partsarray[$i]['text'] = array('type'=>$p->subtype,'string'=>$part);
		}

		#if subparts
		if (count($p->parts)>0){
			foreach ($p->parts as $pno=>$parr){
				$this->parsepart($parr,$this->msgid,($i.'.'.($pno+1)));           
			}
		}
		return;
	}

	/**
		* All email headers
		*/
	function email_headers(){

		#$headers=imap_headers($this->link);
		if($this->max_headers == 'max'){
			$headers = imap_fetch_overview($this->link, "1:".$this->num_message(), 0);
		} else {
			$headers = imap_fetch_overview($this->link, "1:$this->max_headers", 0);
		}
		if($this->max_headers == 'max') {
			$num_headers = count($headers);
		} else {
			$count =  count($headers);
			if($this->max_headers >= $count){
				$num_headers = $count;
			} else {
				$num_headers = $this->max_headers;
			}
		}

		$size=sizeof($headers);
		for($i=1; $i<=$size; $i++){

			$val=$headers[$i]; 
			//while (list($key, $val) = each($headers)){

				$subject_s = (empty($val->subject)) ? '[No subject]' : $val->subject;
				$lp = $lp +1;
				imap_setflag_full($this->link,imap_uid($this->link,$i),'\\SEEN',SE_UID);
				$header=imap_headerinfo($this->link, $i, 80,80);

				if($val->seen == "0"  && $val->recent == "0") {
					echo  '<b>'.$val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."</b><br><hr>" ;
				} else {
					echo  $val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."<br><hr>" ;
				}
			}
		}

		/**
			* Get email
			*/
		function email_get(){
			$email = array();
			$this->set_filestore();

			$header=imap_headerinfo($this->link, $this->msgid, 80,80);
			$from = $header->from;
			$udate= $header->udate;
			$to   = $header->to;
			$size = $header->Size;

			// changed to ALWAYS get ALL messages
			//if ($header->Unseen == "U" || $header->Recent == "N") {

				#Check is it multipart messsage
				$s = imap_fetchstructure($this->link,$this->msgid);
				
				if (count($s->parts)>0){
					echo " *Multipart* ";
					foreach ($s->parts as $partno=>$partarr){
						#parse parts of email
						$this->parsepart($partarr,$this->msgid,$partno+1);
					}
					$text=imap_body($this->link,$this->msgid);
					foreach($this->partsarray as $part){					
						if($part['text']['type'] == 'HTML'){
							//$message_HTML = $part['text']['string'];
							//$this->db_update_message($part['text']['string'], $type= 'HTML');
							
							$email['BODY_HTML'] = $text;//$part['text']['string'];
						}elseif($part['text']['type'] == 'PLAIN'){
							$email['BODY'] = $text;//$part['text']['string'];
						}
					}
					
					
				} else { #for not multipart messages
				
				
					echo " *Not MP* ";
					#get body of message
					$text=imap_body($this->link,$this->msgid);

					#decode if quoted-printable
					if ($s->encoding==4) $text=quoted_printable_decode($text);

					$this->partsarray['not multipart']['text']=array('type'=>$s->subtype,'string'=>$text);
					$email['BODY'] = $text;
				}
					
						
						if(is_array($from)){
							foreach ($from as $id => $object) {
								$fromname = $object->personal;
								$fromaddress = $object->mailbox . "@" . $object->host;
							}
						}

						if(is_array($to)){
							foreach ($from as $id => $object) {
								$toaddress = $object->mailbox . "@" . $object->host;
							}
						}

						$email['CHARSET']    = $charset;
						$email['SUBJECT']    = $this->mime_text_decode($header->Subject);
						$email['FROM_NAME']  = $this->mime_text_decode($fromname);
						$email['FROM_EMAIL'] = $fromaddress;
						$email['TO_EMAIL']   = $toaddress;
						$email['DATE']       = date("Y-m-d H:i:s",strtotime($header->date));
						$email['SIZE']       = $size;
						//$email['BODY'] = $text;
						#SECTION - FLAGS
						$email['FLAG_RECENT']  = $header->Recent;
						$email['FLAG_UNSEEN']  = $header->Unseen;
						$email['FLAG_ANSWERED']= $header->Answered;
						$email['FLAG_DELETED'] = $header->Deleted;
						$email['FLAG_DRAFT']   = $header->Draft;
						$email['FLAG_FLAGGED'] = $header->Flagged;

						return $email;

					}

					function mime_text_decode($string){

						$string = htmlspecialchars(chop($string));

						$elements = imap_mime_header_decode($string);
						if(is_array($elements)){
							for ($i=0; $i<count($elements); $i++) {
								$charset = $elements[$i]->charset;
								$txt = $elements[$i]->text;
							}
						} else {
							$txt = $string;
						}
						if($txt == ''){
							$txt = 'No_name';
						}
						if($charset == 'us-ascii'){
							//$txt = $this->charset_decode_us_ascii ($txt);
						}
						return $txt;
					}

					/**
						* Save file on local disk
						*/ 
					function save_files($filename, $part){
						echo "saving file: ".$this->filestore.$filename."<br>";
						$fp=fopen($this->filestore.$filename,"w+");
						fwrite($fp,$part);
						fclose($fp);
						//chown($this->filestore.$filename, $FILE_OWNER);

					}
					/**
						* Set flags
						*/ 
					function email_setflag(){

						imap_setflag_full($this->link, "2,5","\\Seen \\Flagged"); 

					}
					/**
						* Mark a message for deletion 
						*/ 
					function email_delete(){

						imap_delete($this->link, $this->msgid); 

					}

					/**
						* Delete marked messages 
						*/ 
					function email_expunge(){

						imap_expunge($this->link);

					}


					/**
						* Close IMAP connection
						*/ 
					function close(){
						imap_close($this->link);   
					}


					function listmailbox(){
						$list = imap_list($this->link, "{".$this->IMAP_host."}", "*");
						if (is_array($list)) {
							return $list;
						} else {
							$this->error =  "imap_list failed: " . imap_last_error() . "\n";
						}
						return array();
					}

					/*******************************************************************************
						*                                 SPAM  DETECTION                               
						******************************************************************************/

					function spam_detect(){

						$email = array();

						$id = $this->newid; #ID email in DB

						$execute = mysql_query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, Subject, Message, Message_html FROM emailtodb_email WHERE ID='".$id."'");
						$row = mysql_fetch_array($execute);
						$ID = $row['ID'];
						$email['Email']       = $row['EmailFrom'];
						$email['Subject']     = $row['Subject'];
						$email['Text']        = $row['Message'];
						$email['Text_HTML']   = $row['Message_html'];
						if($this->check_blacklist($email['Email'])){
							$this->update_folder($id, $this->spam_folder);  
						}
						if($this->check_words($email['Subject'])){
							$this->update_folder($id, $this->spam_folder);  
						}
						if($this->check_words($email['Text'])){
							$this->update_folder($id, $this->spam_folder);  
						}
						if($this->check_words($email['Text_HTML'])){
							$this->update_folder($id, $this->spam_folder);  
						}
					}


					function check_blacklist($email){
						#spam - emails 
						$execute = mysql_query("SELECT Email FROM emailtodb_list WHERE Email='".addslashes($email)."' AND Type='B'");
						$row = mysql_fetch_array($execute);
						$e_mail = $row['Email'];
						if($e_mail == $email){
							return 1;
						} else {
							return 0;
						}

					}

					function check_words($string){
						#spam - words
						$string = strtolower($string);

						$execute = mysql_query("SELECT Word FROM emailtodb_words ");
						while($row = mysql_fetch_array($execute)){

							$word = strtolower($row['Word']);

							if (eregi($word, $string)) {
								return 1;
							}
						}
					}
					/*******************************************************************************
						*                                 DB FUNCTIONS                                 
						******************************************************************************/

					/**
						* Add email to DB
						*/
					function db_add_message($email){
					//	$my_html_body = imap_fetchbody($this->link,$msgid,1.2); 
						if(isset($email['BODY_HTML'])){
							$temp_html_body = $email['BODY_HTML'];
						} else {
							$temp_html_body = "";
						}
						//$execute = mysql_query("INSERT INTO emailtodb_email (IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, MsgSize) VALUES
						$execute = mysql_query("INSERT INTO emailtodb_email (IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, Message, Message_html, MsgSize) VALUES
						('NULL',
						'".$email['FROM_EMAIL']."',
						'".addslashes(strip_tags($email['FROM_NAME']))."',
						'".addslashes(strip_tags($email['TO_EMAIL']))."',
						'".$email['DATE']."',
						'".date("Y-m-d H:i:s")."',
						'".addslashes($email['SUBJECT'])."',
						'".addslashes($email['BODY'])."',
						'".addslashes($temp_html_body)."',
						'".$email["SIZE"]."')");

					$execute = mysql_query("select LAST_INSERT_ID() as UID");
					$row = mysql_fetch_array($execute);
					$this->newid = $row["UID"];

				}
				/**
					* Add attachments to DB
					**/

				function db_add_attach($file_orig, $filename){

					$execute = mysql_query("INSERT INTO emailtodb_attach (IDEmail, FileNameOrg, Filename) VALUES
					('".$this->newid."',
					'".addslashes($file_orig)."',
					'".addslashes($filename)."')");

			}

			/**
				* Add email to DB
				*/
			function db_update_message($msg, $type= 'PLAIN'){

				if($type == 'PLAIN') $execute = mysql_query("UPDATE emailtodb_email SET Message='".addslashes($msg)."' WHERE ID= '".$this->newid."'");

				if($type == 'HTML')  $execute = mysql_query("UPDATE emailtodb_email SET Message_html='".addslashes($msg)."' WHERE ID= '".$this->newid."'");

			}

			/**
				* Insert progress log
				*/
			function add_db_log($email, $info){

				$execute = mysql_query("INSERT INTO emailtodb_log (IDemail, Email, Info, FSize, Date_start, Status) VALUES
				('".$this->newid."',
				'".$email['FROM_EMAIL']."',
				'".addslashes(strip_tags($info))."',
				'".$email["SIZE"]."',
				'".date("Y-m-d H:i:s")."',
				'2')");

			$execute = mysql_query("select LAST_INSERT_ID() as UID");
			$row = mysql_fetch_array($execute);
			$this->logid = $row['UID'];

			return  $this->logid;

		}

		/**
			* Set folder
			*/
		function update_folder($id, $folder){

			$execute = mysql_query("UPDATE emailtodb_email SET Type = '".addslashes($folder)."' WHERE ID = '".$id."'");

		}

		/**
			* Update progress log
			*/
		function update_db_log($info, $id){

			$execute = mysql_query("UPDATE emailtodb_log  SET Status = '1', Info='".addslashes(strip_tags($info))."', Date_finish = '".date("Y-m-d H:i:s")."' WHERE IDlog = '".$id."'");

		}


		/**
			* Read log from DB
			*/
		function db_read_log(){

			$email = array();

			$execute = mysql_query("SELECT IDlog, IDemail, Email, Info, FSize, Date_start, Date_finish, Status FROM emailtodb_log ORDER BY Date_finish DESC LIMIT 100");
			while($row = mysql_fetch_array($execute)){
				$ID = $row['IDlog'];
				$email[$ID]['IDemail']     = $row['IDemail'];
				$email[$ID]['Email']       = $row['Email'];
				$email[$ID]['Info']        = $row['Info'];
				$email[$ID]['Size']        = $row['FSize'];
				$email[$ID]['Date_start']  = $row['Date_start'];
				$email[$ID]['Date_finish'] = $row['Date_finish'];
			}
			return $email;
		}  


		/**
			* Read emails from DB
			*/
		function db_read_emails(){
			if (!isset($db)) $db = new DB_WL;
			$email = array();


			$execute = mysql_query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, Message, Message_html, MsgSize FROM emailtodb_email ORDER BY ID DESC LIMIT 25");

			while($row = mysql_fetch_array($execute)){
				$ID = $row['ID'];
				$email[$ID]['Email']     = $row['EmailFrom'];
				$email[$ID]['EmailName'] = $row['EmailFrom'];
				$email[$ID]['Subject']   = $row['Subject'];
				$email[$ID]['Date']      = $row['DateE'];
				$email[$ID]['Size']      = $row['MsgSize'];
			}
			return $email;
		}

		function dir_name() {
			
			if (is_dir('/home/shuff/ppg/files/email')) {
				return '/home/shuff/ppg/files/email' . '/';
			} else {
				echo "making path<br>";
				mkdir('/home/shuff/ppg/files/email', 0777);
				return '/home/shuff/ppg/files/email' . '/';
			}
			
		}

		function db_num_rows($tbl){

			$query = mysql_query("SELECT * FROM ".$tbl); 
			return mysql_num_rows($query);

		}

		function getNumNewMessages(){

			// get lastNum from file
			// use sessions? http://www.tizag.com/phpT/phpsessions.php
			/*
				$myFile = "numMessages.txt";
			$fh = fopen($myFile, 'w+');	// open for rw, pointer at beginning
			$lastNum = intval(trim(fgets($fh)));
			echo "lastNum: ".$lastNum."<br>";
			$currentNumMessages = $this->num_message();
			fwrite($fh, $currentNumMessages);
			*/

			session_start(); 
			if(isset($_SESSION['lastNum'])){
				$lastNum = $_SESSION['lastNum'];
				} else $lastNum = $this->num_message();		// best to have the end result be "0" on the first try

				echo "lastNum: ".$lastNum."<br>";
				$currentNumMessages = $this->num_message();
				echo "currentNumMessages: $currentNumMessages <br>";
				$_SESSION['lastNum'] = $currentNumMessages;

				return $currentNumMessages - $lastNum;

			}

			function getTime(){
				
				$mtime = microtime();
				$mtime = explode(' ', $mtime);
				$mtime = $mtime[1] + $mtime[0];
				return $mtime;
				
			}

			function average($array) {
				return array_sum($array) / count($array);
			}

			/****************************    MAIN    ******************************/

			function db_update(){
				$startTimeTotal = $this->getTime();
				$times = array();
				
				$this->filename_array = array();

				//	get number of rows in emailtodb_email table and start a huge for loop from the number of rows +1 until num_messages

				$total_messages = $this->num_message();

				if($total_messages >= 1) {	//if there are emails in the mailbox

					$this->msgid_start = $this->db_num_rows("emailtodb_email");
					if($this->msgid_start < 1) $this->msgid_start = 1;

					echo "Starting with ".$this->msgid_start." out of ".$total_messages."<br>";
echo "$this->msgid <br>";
					for($this->msgid = $this->msgid_start; $this->msgid <= $total_messages; $this->msgid++){
						
						// *** TIME MEASUREMENT
						if(isset($startTime)){
							$elapsed = $this->getTime() - $startTime;
							$totalElapsed = $this->getTime() - $startTimeTotal;
							//array_push($times, $elapsed);
							//if(count($times) > 50) array_shift($times);	// shift off first element
							$avg = $totalElapsed / $this->msgid;
							echo "----> Last message took ".$elapsed." seconds. | Elapsed time since starting: ".$totalElapsed." seconds. | Average time per message: ".$avg." seconds.<br>";
						}
						// start timer
						$startTime = $this->getTime();
						// ******
						
						
						echo "msgid: ".$this->msgid." | ";

						#Get message
						$email = $this->email_get();

						#Get store dir
						$dir = $this->dir_name();

						#Insert message to db
						$ismsgdb = $this->db_add_message($email,$this->msgid);

						$id_log = $this->add_db_log($email, 'Copy e-mail - start ');

						foreach($this->partsarray as $part){

							/// TRIMMING MESSAGE CONTENTS
							/// I decided to leave the original message contents intact in the database
							/// all further processing should be done in a secondary script
							// remove lines beginning with '>'
							//$part['text']['string'] = preg_replace("/>.*(\n|\r)/i", "", $part['text']['string']);
							// remove entire end of message beginning with "On ... wrote:\n" and trim result
							//$part['text']['string'] = trim(preg_replace("/On.*wrote:(\n|\r)(.|\n)*/i", "", $part['text']['string']));

							if($part['text']['type'] == 'HTML'){
								//$message_HTML = $part['text']['string'];
								//$this->db_update_message($part['text']['string'], $type= 'HTML');
								}elseif($part['text']['type'] == 'PLAIN'){
									//$message_PLAIN = $part['text']['string'];
									//$this->db_update_message($part['text']['string'], $type= 'PLAIN');
									}elseif($part['attachment']){
										#Save files(attachments) on local disc

										// $message_ATTACH[] = $part['attachment'];
										foreach(array($part['attachment']) as $attach){
											$attach['filename'] = $this->mime_text_decode($attach['filename']);
											$attach['filename'] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $attach['filename']);
											echo " attachment filename: ".$attach['filename']." - ";
											// don't duplicate files
											if(!in_array($attach['filename'], $this->filename_array)){
												array_push($this->filename_array, $attach['filename']);

												$this->add_db_log($email, 'Start copying file:"'.strip_tags($attach['filename']).'"');

												$this->save_files($this->newid.$attach['filename'], $attach['string']);
												$filename =  $dir.$this->newid.$attach['filename'];
												$this->db_add_attach($attach['filename'], $filename);
												$this->update_db_log('<b>'.$filename.'</b>Finish copying: "'.strip_tags($attach['filename']).'"', $this->logid);
											}
										}
										//

										}elseif($part['image']){
											#Save files(attachments) on local disc

											$message_IMAGE[] = $part['image'];

											foreach($message_IMAGE as $image){
												$image['filename'] = $this->mime_text_decode($image['filename']);
												$image['filename'] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $image['filename']);

												echo " image filename: ".$image['filename']." - ";

												if(!in_array($attach['filename'], $this->filename_array)){
													array_push($this->filename_array, $attach['filename']);

													$this->add_db_log($email, 'Started copying file: "'.strip_tags($image['filename']).'"');
													$this->save_files($this->newid.$image['filename'], $image['string']);
													$filename =  $dir.$this->newid.$image['filename'];
													$this->db_add_attach($image['filename'], $filename);
													$this->update_db_log('<b>'.$filename.'</b>Finish copying:"'.strip_tags($image['filename']).'"', $this->logid);
												}
											}
										}

									}

									//we don't care about any of this for the ITP list
									/*
										$this->spam_detect();
									$this->email_setflag(); 
									$this->email_delete();
									$this->email_expunge();
									*/

									$this->update_db_log('Finished copying', $id_log);

									echo "Extracted ".$email['SUBJECT']."<br>";
								}
							}
						}

						}#end class

						?>