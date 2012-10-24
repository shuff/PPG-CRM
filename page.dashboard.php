
<?php header("Cache-Control: no-cache, must-revalidate");?>
<?php include_once 'js/page.backgroundcheck.php'; $whoami = $_COOKIE['ppg_crm_client_id'];?>
<?php require_once 'js/functions.php';$action = new action();?>


<!doctype html>
<html class="no-js" lang="en"> 
<head>
  <meta charset="utf-8">
 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>PPG | CRM</title>
  <meta name="description" content="PPG | BMC" />


  <link rel="stylesheet" href="css/style_v2.css">
   <link rel="stylesheet" href="css/jquery.shadow.css">

<link rel="stylesheet" type="text/css" href="css/fileuploader.css" />
<link type="text/css" href="jquery_UI/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="Stylesheet" />	
  
<script src="js/libs/jquery-1.7.2.js"></script>
<script src="jquery_UI/js/jquery-ui-1.8.16.custom.min.js"></script>
 
 <!-- 
//***************************************************************************
//						Globals
//***************************************************************************
-->	

<input type="hidden" name="client_id" id="client_id" value="<?php echo $whoami;?>" />
<input type="hidden" name="name" id="name" value="<?php echo $action->get_field_value('client', 'client_name','client_id', $whoami);?>" />
<input type="hidden" name="email" id="email" value="<?php $_COOKIE['ppg_crm_input_username'];?>">
<input type="hidden" name="form_session_id" id="form_session_id" value="<?php echo  $_COOKIE['ppg_crm_session_id'];?>">
<input type="hidden" name="page" id="page" value="dashboard" />

</head>
<body>


<div id="wrapper" class=" jquery-shadow jquery-shadow-raised">
<div id="client_welcome"></div>

			
<div id="top_nav">
	
<div id="search_wrapper"><input type="inline" style="width:150px;" id="search_input" class="top_nav_text search_input"/><input type="tiny_button_search" id="search_button"  value="Search" name="Search"/>
</div><div id="search_spinner" class="spinner"></div>
	
<a>
<div id="Add" s_list="search_by_add" class="top_nav_text">Update</div>
</a>
<div id="search_by_add" class="search_by_add search_list">

<a><div class="crm_action" id="add--item--add_rep">Add Sales Agent</div></a>
<a><div class="crm_action" id="add--item--add_client">Add Login Account</div></a><br>
<a><div class="crm_action" id="view--item--view_rep">Change Sales Agent Account</div></a>
<a><div class="crm_action" id="view--item--view_account">Change Login Account</div></a>
</div>
	
<a>
<div id="Payments" class="top_nav_text">Payments</div>
</a>

<a>
<div id="STATUS_SEARCH" class="top_nav_text" s_list="status_list">Search Status</div>
</a>
<div id="status_list" class="search_by_status search_list"></div>
<a>
<div id="SALES_AGENT_SEARCH" s_list="sales_agent_list" class="top_nav_text">Search Sales Agent</div>
</a>


<div id="sales_agent_list" class="search_by_sales_agent search_list"></div>
	

<div id="manager_list" class="search_by_manager search_list"></div>

<a>
<div id="FLAGGED_SEARCH" s_list="FLAGGED_SEARCH" class="top_nav_text">Search Flagged</div>
</a>





</div>

<div id="left_nav">
	<div id="deals_list"></div>
</div>
<div id="right_nav"></div>

			
 

</div>
</body>
<script src="js/script.js"></script>
<script src="js/libs/jquery.masked_input.js"></script>
<script src="js/libs/jquery.slideto.min.js"></script>
<script src="js/libs/jquery.shadow.js"></script> 
<script src="js/libs/modernizr-2.5.3.min.js"></script>
<script src="js/libs/respond.min.js"></script>
<script src="js/fileuploader.js"></script>	
</html>