/* Author:
Shannon Huff
*/
$(document).ready(function() {



// *************************************************************************
//																FUNCTIONS
// *************************************************************************

{   
	
	var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera",
			versionSearch: "Version"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();
function show_grid(grid_to_load)
{
	
	$('#grid').html(grid_to_load)

}
function file_uploads(orders_id){            
    var uploader = new qq.FileUploader({
        element: document.getElementById('orders--attachments--upload--'+orders_id),
        action: 'file_uploads.php?file_uploads=yes&orders_id='+orders_id,
        debug: true
    });     	
}

function refresh_files_list()
{
	var orders_id = $('.file_upload_button').attr('orders_id');
	show_files_list(orders_id);
}
function show_files_list(orders_id)
{
	var files_list = db('show_files_list','&orders_id='+orders_id);
	$('#orders--attachments--list--'+orders_id).html(files_list);
	
	if (instr('yes',db('has_files','&orders_id='+orders_id)))
	{
		$('#orders--attachments--list--'+orders_id).addClass('file_list_container_show');
		$('#orders--attachments--list--'+orders_id).removeClass('file_list_container_hide');
	}
	else
	{
		//alert(has_files('mail_list'))
		$('#orders--attachments--list--'+orders_id).addClass('file_list_container_hide');
		$('#orders--attachments--list--'+orders_id).removeClass('file_list_container_show');
	}
}
}
// *************************************************************************
// 						COOKIE AND FORM FUNCTIONS
//**************************************************************************
{
function form_values()
{
	var msg = '';
	$('#wrapper').each(function(index) {     
		$(this).find('input,select,fancy_radio,fancy_checkbox').each(function() {
			var id = $(this).attr('id')	
			msg = msg+'&'+id+'='+$(this).val();
		}); 
	});	
	return msg;					
}
function Eat_Cookie(name,value)
{
	Set_Cookie( name, value, '2592000', '/', '', '' )  
}	
function cookie_me(div)
{	
    Set_Cookie( 'twumc_gt_'+div, $('#'+div).val(), '2592000', '/', '', '' )  
}

function clear_all_inputs(form)
{		
	//note: every input field in this application will have the attribute "error", so i am going to use that
    $('#'+form).find('*[error]').each(function(i){
    $(this).val('');
});
}
function Set_Cookie( name, value, expires, path, domain, secure )
{
//set time, it's in milliseconds
var today = new Date();
today.setTime( today.getTime() );

if ( expires )
{
expires = expires * 1000 * 60 * 60 * 24;
}
var expires_date = new Date( today.getTime() + (expires) );

document.cookie = name + "=" +escape( value ) +
( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
( ( path ) ? ";path=" + path : "" ) +
( ( domain ) ? ";domain=" + domain : "" ) +
( ( secure ) ? ";secure" : "" );
}

function Get_Cookie( check_name ) {
	// first we'll split this cookie up into name/value pairs
	// note: document.cookie only returns name=value, not the other components
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false; // set boolean t/f default f

	for ( i = 0; i < a_all_cookies.length; i++ )
	{
		// now we'll split apart each name=value pair
		a_temp_cookie = a_all_cookies[i].split( '=' );


		// and trim left/right whitespace while we're at it
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

		// if the extracted name matches passed check_name
		if ( cookie_name == check_name )
		{
			b_cookie_found = true;
			// we need to handle case where cookie has no value but exists (no = sign, that is):
			if ( a_temp_cookie.length > 1 )
			{
				cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			}
			// note that in cases where cookie is initialized but no value, null is returned
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if ( !b_cookie_found )
	{
		return null;
	}
}
function flush_dialog()
{
	
	 	 	$('#grid_modal').dialog({
            minHeight: 200,
            minWidth: 200,
            modal: true,
            resizable: false,
           autoOpen:false,
			open: function() 
			{	
			$(this).parent().find('.ui-dialog-titlebar').append('<img tabindex="1" id="btn_cancel" class="btn_cancel" style="position:absolute;top:-10px;left:93%;width:30px;" src="/img/btn-modalcancel.png"/>');

 					$("#btn_cancel").click(function(e){
 						$("#grid_modal").dialog("destroy")
 						flush_dialog()
 					});
 		},
 			close: function() 
			{	
				$("#grid_modal").dialog("destroy")
				flush_dialog()
			}
       		 });
}
	
function clear_errors(form)
{
	var found_error = 'false';
	$('#'+form).each(function(index) {     
		$(this).find('input,select,textarea').each(function() {
			var id = $(this).attr('id')
			var error_id = $(this).attr('error')
			$('#'+error_id).removeClass('form_error');
			$('#'+error_id+'_text').text('')		
			found_error = 'false';
		}); 
	});						
}
}
// *************************************************************************
// 						STRING FUNCTIONS
//**************************************************************************
{
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
   		vars[key] = value;
	});
	return vars;
}
function instr(str,word)
{
   if( str.indexOf( word ) != -1 )
   {
   	return true;
   }
   else
   {
   	return false;
   }
}
function ltrim(str){
                return str.replace(/^\s+/, '');
            }
function rtrim(str) {
                return str.replace(/\s+$/, '');
            }
function trim(str) {
                return str.replace(/^\s+|\s+$/g, '');
            }

function IsNumeric(strString)
//check for valid numeric strings	
{
if (strString == null) 
{return false;}
if (strString.length == 0) 
{return false;}
var strValidChars = "0123456789.-";
var strChar;
var blnResult = true;
//  test strString consists of valid characters listed above
for (i = 0; i < strString.length && blnResult == true; i++)
	{
		strChar = strString.charAt(i);
		if (strValidChars.indexOf(strChar) == -1)
 	{
  		blnResult = false;
  	}
	}
	
return blnResult;
}
function get_session_id() {
    var dd = new Date();
    var yy = dd.getYear();
    var mm = dd.getMonth();
    var d = dd.getDay();
    var hh = dd.getHours();
    var mm = dd.getMinutes();
    var ss = dd.getSeconds();
    var ms = dd.getMilliseconds();
    return yy + "." +  mm + "." +  d + "." + hh + "." + mm + "." + ss + "." + ms ;
}
}
// *************************************************************************
// 						ERROR AND VALIDATION FUNCTIONS
//**************************************************************************
{
function validateEmail(txtEmail)
{
	var a = txtEmail
	var filter = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{1,4}$/;
	 if(filter.test(a))
	 {
	 	return true;
	 }
	  else
	  {
	      return false;
	  }
}
	
function validate_values(form)
{
	var message = 'true';
	$('#'+form).each(function(index) {    
		
		$(this).find('input,select,textarea').each(function() {
			 
	if ($(this).hasClass('ck_required') && $(this).val() == '')
			{
				
			var id = $(this).attr('id')
			
			var error_id = $(this).attr('error')
			if ($(this).attr('type') == 'inline')
			{
				//do nothing
			}
			else
			{
				$('#'+error_id).addClass('form_error');
			}
			
			$('#'+error_id+'_text').text('Required').show();
					
			message = 'false';
		
	}
						
		}); 
		
	}); 
	
	return message;
}
function validate_numeric(form)
{
	var message = 'true';
	$('#'+form).each(function(index) {     
		$(this).find('input,select,textarea').each(function() {
		if ($(this).hasClass('ck_numeric'))
		{
		if (IsNumeric($(this).val()) == false && $(this).val() != '')
		{
			var id = $(this).attr('id')
			var error_id = $(this).attr('error')
			if ($(this).attr('type') == 'inline')
			{
				//do nothing
			}
			else
			{
				$('#'+error_id).addClass('form_error');
			}

			$('#'+error_id+'_text').text('Just a Number').show();		
			message = 'false';
		}
		}	
									
		}); 

	}); 
	
	return message;
}
}
// *************************************************************************
// 						DATABASE and DIALOGS
//**************************************************************************
{
function db(name,options)
{

	var sendit = '&name='+name+options;
	var msg = $.ajax({
	type: "POST",
	async: false,
	url: "js/functions.php",
	data: sendit
	}).responseText;
	return msg;
}
function db_async(name,options)
{
	var sendit = '&name='+name+options;
	var msg = $.ajax({
	type: "POST",
	async: true,
	url: "js/functions.php",
	data: sendit
	}).responseText;
	return msg;
}
function ornament()
{
	$('#grid_modal').dialog({
    	minHeight: 150,
    	modal: true,
    	resizable: false,
   		autoOpen:false,
		open: function() 
		{	
			$(this).parent().find('.ui-dialog-titlebar').append('<img tabindex="1" id="btn_cancel" class="btn_cancel" style="position:absolute;top:-10px;left:93%;width:30px;" src="/img/btn-modalcancel.png"/>');

			$("#btn_cancel").click(function(e){
				$("#grid_modal").dialog("close");
				$("#grid_modal").dialog("destroy")
				flush_dialog()	
			});
		}
 	});
}		
}	
		
// *************************************************************************
//																HTML
// *************************************************************************
{
	
var add_rep_html =	
  		'<div id="form_add_rep" style="width:30%;">'+
			
				'<h1 class="h1 deal_header">Sales Agent</h1>'+
						
  				'<div id="rep_name_error" class="">'+
  					'<div id="rep_name_label" class="form_label">Name</div>'+
  					'<input type="tiny_text" error="rep_name_error" class="ck_required" id="input_rep_name" maxlength="25" />'+
  					'<div id="rep_name_error_text" class="error_text"></div>'+
  				'</div>					'+
  				'<div id="rep_phone" class="">'+
  					'<div id="rep_phone_label" class="form_label">Phone</div>'+
  					'<input type="tiny_text" error="rep_phone_error" id="input_rep_phone" maxlength="50" />'+
  					'<div id="rep_phone_error_text" class="error_text"></div>'+
  				'</div>'+
  				'<div id="rep_email_error" class="">'+
  					'<div id="rep_email_label" class="form_label">Email</div>'+
  					'<input type="tiny_text" error="rep_email_error" id="input_rep_email"  class="ck_required" maxlength="50" />'+
  					'<div id="rep_email_error_text" class="error_text"></div>'+
  				'</div>	'+
  				
  				'		<div id="rep_street_error">'+
		'			<div id="rep_street_label" class="form_label">Address</div>'+
		'			<input type="tiny_text" error="rep_street_error" id="input_rep_street" maxlength="50" />'+
		'			<div id="rep_street_error_text" class="error_text"></div>'+
		'		</div>'+
		'		<div id="rep_address" class="address" style="">	'+					
		'			<div class="city">'+
		'				<div id="rep_city_error">'+
		'					<div id="rep_city_label" class="form_label">City</div>'+
		'					<input type="tiny_text" error="rep_city_error"  id="input_rep_city" maxlength="25" />'+
		'					<div id="rep_city_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
		'			<div class="state">'+
		'				<div id="rep_state_error">'+
		'					<div id="rep_state_label" class="form_label" style="left:-10px;">State</div>'+
		'					<input type="tiny_text" error="rep_state_error"  class="state" value="TX" id="input_rep_state" maxlength="2" />'+
		'					<div id="rep_state_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
		'			<div class="zipcode">'+
		'				<div id="rep_zip_error" >'+
		'					<div id="rep_zip_label" class="form_label">Zipcode</div>'+
		'					<input type="tiny_text" error="rep_zip_error"  class="zipcode" id="input_rep_zip" maxlength="15" />'+
		'					<div id="rep_zip_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
  					'<div id="button_submit">'+
					'<input type="tiny_button" id="submit_add_rep" value="Submit"  />'+
					'<div id="spinner"></div>'+
				'</div>'+
  			'</div>		'+		

			'<div id="form_add_rep_success" class="form_checkmark"></div>'+
		'</div>';
var add_account_html =	
  		'<div id="form_add_client" style="width:30%;">'+
		
		'		<h1 class="h1 deal_header">Login Account</h1>'+
						
  		'		<div id="client_name_error" class="">'+
  		'			<div id="client_name_label" class="form_label">Name</div>'+
  		'			<input type="tiny_text" error="client_name_error" class="ck_required" id="input_client_name" maxlength="25" />'+
  		'			<div id="client_name_error_text" class="error_text"></div>'+
  		'		</div>					'+
  		'		<div id="client_phone" class="">'+
  		'			<div id="client_phone_label" class="form_label">Phone</div>'+
  		'			<input type="tiny_text" error="client_phone_error" id="input_client_phone" maxlength="20" />'+
  		'			<div id="client_phone_error_text" class="error_text"></div>'+
  		'		</div>'+
  		'		<div id="client_email" class="">'+
  		'			<div id="client_email_label" class="form_label">Email</div>'+
  		'			<input type="tiny_text" error="client_email_error" id="input_client_email" maxlength="100" />'+
  		'			<div id="client_phone_error_text" class="error_text"></div>'+
  		'		</div>'+
  		'		<div id="client_email_error" class="">'+
  		'			<div id="client_email_label" class="form_label">Username/Email</div>'+
  		'			<input type="tiny_text" error="client_email_error" id="input_client_username"  class="ck_required" maxlength="100" />'+
  		'			<div id="client_email_error_text" class="error_text"></div>'+
  		'		</div>'+
  		
 		'		<div id="client_password_error" class="">'+
  		'			<div id="client_password_label" class="form_label">Password</div>'+
  		'			<input type="password" error="client_password_error" id="input_client_password" class="ck_required" maxlength="25" />'+
  		'			<div id="client_password_error_text" class="error_text"></div>'+
  		'		</div>'+
 		'	  	<div id="client_group_error">				'+
  		'			<div id="client_group_label" class="form_label">Permissions</div>		'+			
  		'			<div class="tiny_styled_select">'+
		'				<select id="input_client_group" class="ck_required" error="client_group_error"><option value="">'+
		'		</option><option value="admin">Administrator</option><option value="rep">Sales Rep</option></select>'+
		'			</div>'+
		'		</div>'+
		'		<div id="client_street_error">'+
		'			<div id="client_street_label" class="form_label">Address</div>'+
		'			<input type="tiny_text" error="client_street_error" id="input_client_street" maxlength="50" />'+
		'			<div id="client_street_error_text" class="error_text"></div>'+
		'		</div>'+
		'		<div id="client_address" class="address" style="">	'+					
		'			<div class="city">'+
		'				<div id="client_city_error">'+
		'					<div id="client_city_label" class="form_label">City</div>'+
		'					<input type="tiny_text" error="client_city_error"  id="input_client_city" maxlength="25" />'+
		'					<div id="client_city_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
		'			<div class="state">'+
		'				<div id="client_state_error">'+
		'					<div id="client_state_label" class="form_label" style="left:-10px;">State</div>'+
		'					  <div class="tiny_styled_select">'+
		'							<select id="input_client_state" class="ck_required" error="client_state_error"><option value="TX">'+db('list_states','')+'</select>'+
		'					</div>'+
		'					<div id="client_state_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
		'			<div class="zipcode">'+
		'				<div id="client_zip_error" >'+
		'					<div id="client_zip_label" class="form_label">Zipcode</div>'+
		'					<input type="tiny_text" error="client_zip_error"  class="zipcode" id="input_client_zip" maxlength="15" />'+
		'					<div id="client_zip_error_text" class="error_text"></div>'+
		'				</div>'+
		'			</div>'+
			
		'		<div id="client_notes_error">'+
		'			<div id="client_notes_label" class="form_label">Notes</div>'+
		'			<textarea class="tiny_textarea" error="client_notes_error" type="tiny_text" id="input_client_notes" maxlength="2000" /></textarea>'+
		'			<div id="client_notes_error_text" class="error_text"></div>'+
		'		</div>'+
		'		<div id="client_enabled_error">'+
		'			<div id="client_enabled_label" class="form_label">Account Enabled</div>'+
		'		<div id="input_client_enabled" class="fancy_checkbox_row"> '+
		'				<img id="input_client_enabled_ck" class="fancy_checkbox" style="display:none;"  src="img/btn-unchecked.png" /> '+
		'				<img id="input_client_enabled_cked"  class="fancy_checkbox" style="display:none;" src="img/btn-checked.png" />'+
		'				</div>'+
		'			<div id="input_client_enabled_error_text" class="error_text"></div>'+
		'		</div>'+
		'		<div id="button_submit">'+
		'			<input type="tiny_button" id="submit_add_client" value="Submit"  />'+
		'			<div id="spinner"></div>'+
		'		</div>'+
				
		'	</div>'+
		'	<div id="form_add_client_success" class="form_checkmark"></div>'+
'	</div>';

}
// *************************************************************************
//																PAGES
// *************************************************************************

var page = $('#page').val();

// *************************************************************************
// 						LOGIN PAGE
//**************************************************************************
{
	if (page == 'login')
	{
		actions();
		
		if (BrowserDetect.browser == 'Explorer'){
		$('#login_div_fields').html('<div id="browser_suggestion"></div>');
		$('#browser_suggestion').addClass('bad_browser_error').html('This application is not designed for Internet Explorer browsers. Please use an alternate browser such as Google Chrome, Mozilla&nbsp;Firefox, or Safari.');
		}
		else{
		if (Get_Cookie('ppg_crm_input_username') != null){$('#input_username').val(Get_Cookie('ppg_crm_input_username'));}
		$('#spinner').css('display','none');

		$('input').bind('keypress', function(e) {
        	if (e.keyCode==13){
                $("#login_submit").click();
       		 }
		});
		
		}
	}
}		
// *************************************************************************
// 						DASHBOARD PAGE
//**************************************************************************	
{
if (page == 'dashboard')
{	
	//alert(db('hello','&my_name=shannon'));
						
	$('#deals_list').html('');
	$('#deals_list').html(db('deals_list','&table=&field=&id='));
	$('#status_list').html(db('search_by_status_list',''));
	$('#sales_agent_list').html(db('search_by_sales_agent',''));
	$('#flaged_list').html(db('search_by_flagged',''));

	
	var name =  db('get_field_value','&table=client&field=client_name&pkey_field=client_id&pkey_value='+$('#client_id').val())

	// check which group client is in 

	var is_admin = db('in_group','&client_id='+$('#client_id').val()+'&table=group_admin')
	var is_rep = db('in_group','&client_id='+$('#client_id').val()+'&table=group_rep')

	var roles = '';
	if (is_rep == 'true') {roles = ' Rep ';}
	if (is_admin == 'true') {roles = ' Administrator ';}	

	// show welcome message
	$('#client_welcome').html('Welcome, ' + roles + ' ' + name +' <a class="logout"> [logout]</a>');
}
	
}
// *************************************************************************
//																ACTIONS
// *************************************************************************	

function actions()
{		
	$('*').unbind('click');
				
	$('#input_client_enabled').on('click',function(e){
		
		if ($('#input_client_enabled_ck').css('display')=='none')
		{
			
			$('#input_client_enabled_ck').show()
			$('#input_client_enabled_cked').hide()
		}
		else
		{
			
			$('#input_client_enabled_ck').hide()
			$('#input_client_enabled_cked').show()
		}
	});
	
	
	$("#login_button").on('click',function(e){

		cookie_me('input_username');
	
		$('#login_error').html('');
		$('#login_error').hide();
		$('#login_submit').hide();
		$('#spinner').show();
	
		// username or password is missing
	
		if ($('#input_password').val() == '' || $('#input_email').val() == '' )
		{
			$('#login_error').html('<h2 class="h2"><b>NOTE</b></h2>Sorry, the username or password was incorrect.');
			$('#login_error').show();
			$('#spinner').hide();
			$('#login_submit').show();
			Set_Cookie('ppg_crm_auto_login', 'false', '2592000', '/', '', '' )
			return
		}
		// validate username and password
		
		var sendit = 'login_validate=yes'+'&username='+$('#input_username').val()+'&password='+$('#input_password').val();	
		var msg = $.ajax({
   		type: "POST",
    	async: false,
    	url: "js/functions.login.php",
    	data: sendit
    	}).responseText;

		// It's a good login !! 

		if (msg != 'false' || msg != '')
		{
			Set_Cookie( 'ppg_crm_client_id', msg, '2592000', '/', '', '' )
			Set_Cookie( 'ppg_crm_session_id',get_session_id(), '2592000', '/', '', '' )
			Set_Cookie( 'ppg_crm_input_username', $('#input_username').val(), '2592000', '/', '', '' )
			Set_Cookie( 'ppg_crm_auto_login', 'false', '2592000', '/', '', '' )
			var t = setTimeout("window.open('/dashboard','_self')", 1000);
		}
		// It's bad login :(
		else 
		{	
			$('#login_error').html('<h2 class="h2"><b>NOTE</b></h2>Sorry, the username or password was incorrect');
			$('#login_error').show();
			$('#spinner').hide();
			$('#login_submit').show();
			Set_Cookie( 'ppg_crm_auto_login', 'false', '2592000', '/', '', '' )
			return
		}
	});
	
	$("#submit_add_rep").on('click',function(e){ 
	
		$('#rep_name').focus();
		$('#input_rep_phone').mask("999.999.9999");
						
		//check for errors							
		clear_errors('form_add_rep');
		found_error = 'false';
		//all fields have values
		var form_errors = validate_values('form_add_rep');
		if (form_errors == 'false'){found_error = 'true'};
		
		//email is valid
		if (validateEmail($('#input_rep_email').val()) != true )
		{		
			$('#rep_email_error').addClass('form_error')
			$('#rep_email_error_text').text('Enter a valid email')		
			found_error = 'true';
			
		}
		doit ='';		
		if (found_error == 'false')
		{		
			var doit = db('add_rep','&rep_city='+$('#input_rep_city').val()+'&rep_street='+$('#input_rep_street').val()+'&rep_state='+$('#input_rep_state').val()+'&rep_zipcode='+$('#input_rep_zip').val()+'&pkey='+$('#rep_pkey').val()+'&rep_email='+$('#input_rep_email').val()+'&rep_phone='+$('#input_rep_phone').val()+'&rep_name='+$('#input_rep_name').val());
		}
			
		if (doit.length < 5 && doit != 0 && doit != '') //confirming a valid resonce 
		{
			
				$('#form_add_rep_success').fadeIn('slow').delay(1500).fadeOut('4000', function(){});
				clear_all_inputs('form_add_rep')
											
		}
	// need to add and else if the udate fails
	});

	$("#submit_add_client").on('click',function(e){ 
						
		$('#client_name').focus();
		$('#input_client_phone').mask("999.999.9999");	
		$('#input_client_enabled_cked').show()
		
		
		//check for errors							
		clear_errors('form_add_client');
		found_error = 'false';
		
		//all fields have values
		var form_errors = validate_values('form_add_client');
		if (form_errors == 'false'){found_error = 'true'};
		
		//email is valid
		if (validateEmail($('#input_client_username').val()) != true )
		{		
			$('#client_email_error').addClass('form_error')
			$('#client_email_error_text').text('Enter a valid email')		
			found_error = 'true';
			
		}
		
		//email not already used	
		if (db('exists','&table=client'+'&field=client_username'+'&value='+$('#input_client_username').val()) == 'true')
		{
		
			var existing_pkey = db('get_field_value','&table=client&field=pkey&pkey_field=client_username&pkey_value='+$('#input_client_username').val());
	
			if (existing_pkey != $('#account_pkey').val())
			{
				$('#client_email_error').addClass('form_error');
				$('#client_email_error_text').text('This email is already in use')		
				found_error = 'true';
			}	
		}
			if ($('#input_client_enabled_ck').css('display')=='none'){
				$('#input_client_enabled').val('yes')
			}
			else
			{
				$('#input_client_enabled').val('no')
				$('#input_client_enabled_cked').show()
			}
	
			doit ='';
			if (found_error == 'false')
			{
			
			
			var doit = db('add_client','&client_email='+$('#input_client_email').val()+'&client_enabled='+$('#input_client_enabled').val()+'&client_username='+$('#input_client_username').val()+'&client_password='+$('#input_client_password').val()+'&client_name='+$('#input_client_name').val()+'&client_phone='+$('#input_client_phone').val()+'&client_street='+
			$('#input_client_street').val()+'&client_city='+
			$('#input_client_city').val()+'&client_state='+$('#input_client_state').val()
			+'&client_zip='+$('#input_client_zip').val()+'&client_notes='+$('#input_client_notes').val()+'&client_group='+$('#input_client_group').val()+'&pkey='+$('#account_pkey').val());	
//alert(doit)
		}
				
		if (doit.length < 5 && doit != 0 && doit != '') //confirming a valid resonce 
		{
			
			$('#form_add_client_success').fadeIn('slow').delay(1500).fadeOut('4000', function(){});
			clear_all_inputs('form_add_client')
			if ($('#account_pkey').length){$('#account_pkey').val('')}
											
		}
		// need to add and else if the udate fails
	});

	$('.crm_action').on('click',function(e){
		$('.search_list').hide();	
		var togg = $(this).attr( 'id' );
		var b = togg	
		var rec = b.split('--');
		var table = rec[0];
		var field = rec[1];
		var id = rec[2];

	if (id == 'add_rep'){
		$('#right_nav').html('');
		$('#right_nav').html(add_rep_html);
		$('#form_add_rep').show()
	}
	if (id == 'add_client'){
		$('#right_nav').html('');
		$('#right_nav').html(add_account_html);
		$('#form_add_rep').show()
		$('#client_name').focus();
		$('#input_client_phone').mask("999.999.9999");	
		$('#input_client_enabled_cked').show()						
		clear_errors('form_add_client');	
	}
	if (id == 'view_rep'){
		$('#right_nav').html('');
		$('#right_nav').html(db('load_reps_grid',''));
		$('#right_nav').prepend('<h1 class="h1 deal_header">Sales Agents</h1><br>')
	}
	if (id == 'view_account'){
		$('#right_nav').html('');
		$('#right_nav').html(db('load_accounts_grid',''));
		$('#right_nav').prepend('<h1 class="h1 deal_header">Login Accounts</h1><br>')
	}
	if (table == 'orders'){
		$('#deals_list').html(db('deals_list','&table='+table+'&field='+field+'&id='+id));
		$('.search_list').hide();
	}
	if (table == 'rep'){
		$('#deals_list').html(db('deals_list','&table='+table+'&field='+field+'&id='+id));
		$('.search_list').hide();
	}
	actions();
	});
	// ************************
	// EDIT ACCOUNT
	//*************************
	$('.tb_edit_client').on('click',function(e){
		var togg = $(this).attr('id');
		var b = togg
		var rec = b.split('--');
		var pkey = rec[1];

		var name = db('get_field_value','&table=client&field=client_name&pkey_field=pkey&pkey_value='+pkey);
		var username = db('get_field_value','&table=client&field=client_username&pkey_field=pkey&pkey_value='+pkey);
		var email = db('get_field_value','&table=client&field=client_email&pkey_field=pkey&pkey_value='+pkey);
		var street = db('get_field_value','&table=client&field=client_street&pkey_field=pkey&pkey_value='+pkey);
		var city = db('get_field_value','&table=client&field=client_city&pkey_field=pkey&pkey_value='+pkey);
		var state = db('get_field_value','&table=client&field=client_state&pkey_field=pkey&pkey_value='+pkey);
		var zipcode	= db('get_field_value','&table=client&field=client_zip&pkey_field=pkey&pkey_value='+pkey);
		var phone	= db('get_field_value','&table=client&field=client_phone&pkey_field=pkey&pkey_value='+pkey);
		var password = db('get_field_value','&table=client&field=client_password&pkey_field=pkey&pkey_value='+pkey);
		var enabled = db('get_field_value','&table=client&field=client_enabled&pkey_field=pkey&pkey_value='+pkey);
		var notes = db('get_field_value','&table=client&field=client_notes&pkey_field=pkey&pkey_value='+pkey);
		var client_id = db('get_field_value','&table=client&field=client_id&pkey_field=pkey&pkey_value='+pkey);
		var is_admin = db('in_group','&group=group_admin&client_id='+client_id);
		$('head').append('<input type="hidden" id="account_pkey" value="'+pkey+'"/>');
		
		Eat_Cookie('input_client_name',name);
		Eat_Cookie('input_client_email',email);
		Eat_Cookie('input_client_phone',phone);
		Eat_Cookie('input_client_street',street);
		Eat_Cookie('input_client_city',city);
		Eat_Cookie('input_client_state',state);
		Eat_Cookie('input_client_zipcode',zipcode);
		Eat_Cookie('input_client_username',username);
		Eat_Cookie('input_client_password',password);
		Eat_Cookie('input_client_phone',phone);
		Eat_Cookie('input_client_enabled',enabled);
		Eat_Cookie('input_client_notes',notes);
		
		$('#right_nav').html(add_account_html);
		
		$('#input_client_name').val(Get_Cookie('input_client_name'));	
		$('#input_client_username').val(Get_Cookie('input_client_username'));
		$('#input_client_email').val(Get_Cookie('input_client_email'));
		$('#input_client_phone').val(Get_Cookie('input_client_phone'));
		$('#input_client_street').val(Get_Cookie('input_client_street'));
		$('#input_client_city').val(Get_Cookie('input_client_city'));
		$('#input_client_state').val(Get_Cookie('input_client_state'));
		$('#input_client_zip').val(Get_Cookie('input_client_zipcode'));
		$('#input_client_password').val(Get_Cookie('input_client_password'));
		$('#input_client_phone').val(Get_Cookie('input_client_phone'));
		$('#input_client_notes').val(Get_Cookie('input_client_notes'));
		if (is_admin == 'true'){$('#input_client_group').val('admin')}
		else{$('#input_client_group').val('rep')}
		if (enabled == 'yes'){$('#input_client_enabled_ck').hide();$('#input_client_enabled_cked').show()}
		else{$('#input_client_enabled_ck').show();$('#input_client_enabled_cked').hide()}
		$('#client_name').focus();
		$('#input_client_phone').mask("999.999.9999");	
		$('#input_client_enabled_cked').show()		

		
		actions();
								
	});
	// ************************
	// DELETE ACCOUNT
	//*************************
	$(".tb_delete_client").on('click',function(e){
		var togg = $(this).attr('id');
		var b = togg
		var rec = b.split('--');
		var pkey = rec[1];
		var table='client';
		var pkey_field='pkey';
		var doit = db('delete_record','&table='+table+'&pkey_field='+pkey_field+'&pkey_value='+pkey)
		
		if (doit ==1){
			$('#right_nav').html(db('load_accounts_grid',''));
		}
		else{
			alert(doit);
		}
		actions()
	});
	// ************************
	// EDIT REP
	//*************************
	$('.tb_edit_rep').on('click',function(e){
		var togg = $(this).attr('id');
		var b = togg
		var rec = b.split('--');
		var pkey = rec[1];
		
		var name = db('get_field_value','&table=rep&field=rep_name&pkey_field=pkey&pkey_value='+pkey);
		var email = db('get_field_value','&table=rep&field=rep_email&pkey_field=pkey&pkey_value='+pkey);
		var street = db('get_field_value','&table=rep&field=rep_street&pkey_field=pkey&pkey_value='+pkey);
		var city = db('get_field_value','&table=rep&field=rep_city&pkey_field=pkey&pkey_value='+pkey);
		var state = db('get_field_value','&table=rep&field=rep_state&pkey_field=pkey&pkey_value='+pkey);
		var zipcode	= db('get_field_value','&table=rep&field=rep_zipcode&pkey_field=pkey&pkey_value='+pkey);
		var phone	= db('get_field_value','&table=rep&field=rep_phone&pkey_field=pkey&pkey_value='+pkey);
		$('head').append('<input type="hidden" id="rep_pkey" value="'+pkey+'"/>');
		
		Eat_Cookie('input_rep_name',name);
		Eat_Cookie('input_rep_email',email);
		Eat_Cookie('input_rep_phone',phone);
		Eat_Cookie('input_rep_street',street);
		Eat_Cookie('input_rep_city',city);
		Eat_Cookie('input_rep_state',state);
		Eat_Cookie('input_rep_zipcode',zipcode);
		
		$('#right_nav').html(add_rep_html);
		
		$('#input_rep_name').val(Get_Cookie('input_rep_name'));	
		$('#input_rep_email').val(Get_Cookie('input_rep_email'));
		$('#input_rep_phone').val(Get_Cookie('input_rep_phone'));
		$('#input_rep_street').val(Get_Cookie('input_rep_street'));
		$('#input_rep_city').val(Get_Cookie('input_rep_city'));
		$('#input_rep_state').val(Get_Cookie('input_rep_state'));
		$('#input_rep_zip').val(Get_Cookie('input_rep_zipcode'));

		
		actions();
								
	});
	// ************************
	// DELETE REP
	//*************************
	$(".tb_delete_rep").on('click',function(e){
		var togg = $(this).attr('id');
		var b = togg
		var rec = b.split('--');
		var pkey = rec[1];
		var table='rep';
		var pkey_field='pkey';
		var doit = db('delete_record','&table='+table+'&pkey_field='+pkey_field+'&pkey_value='+pkey)
		
		if (doit ==1){
			$('#right_nav').html(db('load_reps_grid',''));
		}
		else{
			alert(doit);
		}
	});
	
	
	// ************************
	// EMAIL ACTIONS
	// ************************
		
	$('.email_item').on('click',function(e){
		var id = $(this).attr('id');
		var my_url = 'http://crm.patriotpaymentgroup.com/report.php?email='+id;
		window.open (my_url,'_blank')
	});
	
	$('#email_close').on('click',function(e){
		$('#email_view').html('');
		$('#email_view').hide();
	
	});
	
	$('.attachment,.attachment_text').on('click',function(e){
		var id = $(this).attr( 'id' );
		var get_attachment_path = db('get_field_value','&table=emailtodb_attach&field=Filename&pkey_field=IDEmail&pkey_value='+id);
		var exe_file = get_attachment_path.replace(' ','%20');
		var exe_file = exe_file.replace('/home/shuff/ppg/','');
		exe_file = 'http://crm.patriotpaymentgroup.com/'+exe_file;
		window.open(exe_file)
	});
	
	// ************************
	//CLICK ITEM OPEN DETAILS
	// ************************
	

	$('.deals_list_item').on('click',function(e){
		
		$('.search_list').hide();
		var togg = $(this).attr('id');
		var b = togg
		var rec = b.split('--');
		var pkey = rec[1];
		var merchant_id = rec[0];
	
		$('#right_nav').html(db('data_display','&deal='+pkey+'&client_id='+$('#client_id').val())+'<div id="grid_modal"></div>');
		$('.email_list').html(db('data_display_email','&deal='+pkey+'&client_id='+$('#client_id').val()))
		//$('.email_list').html(db('data_display_email','&deal='+pkey+'&client_id='+$('#client_id').val()))
	//alert(db('data_display_email','&deal='+pkey+'&client_id='+$('#client_id').val()))
		var doit = show_files_list(merchant_id)
		var doit = file_uploads(merchant_id)

		actions();
	});

	$('.flagged_ck').on('click',function(e){
		var merchant_id = $(this).attr('merchant_id');

		if($("#flagged").val()== 'yes'){
			var doit = db('update_flagged','&status=no&client_id='+$('#client_id').val()+'&merchant_id='+merchant_id);
			$("#flagged").val('no')
			$('#flagged').attr('src','img/btn-unchecked.png')
		}		
		else {
			var doit = db('update_flagged','&status=yes&client_id='+$('#client_id').val()+'&merchant_id='+merchant_id);
			$("#flagged").val('yes')
			$('#flagged').attr('src','img/btn-checked.png')
		}
	
	});
	
	$('#search_button').on('click',function(e){
	
		if ($('#search_input').val() != '' ){
			
			$('#search_spinner').show();
			var doit = db('global_search','&my_search='+$('#search_input').val())
			
			if (doit != '' && doit != '1'){
				$('#search_spinner').hide();
				$('#deals_list').html('');
				$('#deals_list').html(doit);
				$('#search_input').val('');
			}
			if (doit == '1'){
				$('#deals_list').html('');
				$('#search_spinner').hide();
				$('#search_wrapper').show();
				$('#search_input').val('');
			}
	
		}
		actions();
	});
	
	// PAYMENT ACTIONS
	$('.tb_view_paid').on('click',function(e){	
		var id = $(this).attr('id').split('--')[1];
		var str='&merchant_id='+id;
		var my_url = 'http://crm.patriotpaymentgroup.com/report.php?payment='+id;
		window.open (my_url,'_blank')
	});
	$('.tb_mark_paid').on('click',function(e){	
		var id = $(this).attr('id').split('--')[1];
		var str='&merchant_id='+id;
		var doit = db('mark_paid',str)
		if (doit == 1){
		$('#right_nav').html('');
		{
			var sendemail = db('send_payment_summery',str)
			$('#right_nav').html(db('grid_payments_due',''))}
		}
		else{
			alert(doit);
		}
		actions();
	});	
	$("#Payments").on('click',function(e){ 											
	$('#right_nav').html('');
	//$('#right_nav').html('<div style="top:50px;" class="spinner"></div>');
	//$('.spinner').show();
	$('.search_list').hide();
	$('#right_nav').html('<div id="export_orders_error"><div id="export_payments" style="width:100%;"></div><div id="export_payments_link" style="width:100%;"></div>	<br></div>');
			
	$('#export_payments_link').html(db('build_payment_export',''));

	if (db('grid_payments_due','') == 0){
		$('#button_submit_payments').hide();
		$('#export_payments_link').html('');
		$('#export_payments').append('No pending payments');
	}
	else{

		$('#right_nav').append(db('grid_payments_due','')).css('margin-top','-15px'); 
		actions();
		
	}
	});
	// TOP BAR ACTIONS
	$('.top_nav_text').on('click',function(e){
		
		// PAYMENTS CLICK
		if ($(this).attr('id') != 'Payments'){
		$('#right_nav').html('');
		$('.search_list').hide();
		}
		var doit = $(this).attr('s_list');
		
		//FLAGGED SEARCH CLICK
		if (doit == 'FLAGGED_SEARCH'){
			$('#deals_list').html(db('deals_list','&table=flagged&field=client_id&id='+$('#client_id').val()));
			//alert(db('deals_list','&table=flagged&field=client_id&id='+$('#client_id').val()))
		}
				
		$('#'+doit).show();	
		actions()			
	});
	//LOGOUT
	$('.logout').on('click',function(e){			
		Set_Cookie( 'ppg_crm_session_id', '', '2592000', '/', '', '' );
		Set_Cookie( 'ppg_crm_client_id', '', '2592000', '/', '', '' );
		window.open('/','_self');
	});


// Field Maps

	$(".field_label").on('click',function(e){ 
	
		var togg = $(this).attr( 'id' );
		var b = togg
		var temp = new Array();
		var rec = b.split('--');
		var table = rec[0];
		var field = rec[1];
		var id = rec[2];

		var field_display_only = field;
							
		if (field == "merchant_id"){field_display_only = 'Merchnat ID'}
		if (field == "rep_id"){field_display_only = 'Sales Agent'}
		if (field == "order_notes"){field_display_only = 'Background'}
		if (field == "order_status"){field_display_only = 'Stutus'}
		if (field == "lead_source"){field_display_only = 'Lead Source'}
		if (field == "processor"){field_display_only = 'Processor'}
		if (field == "type"){field_display_only = 'Type'}
		if (field == "pricing_structure"){field_display_only = 'Pricing Structure'}
		if (field == "equipment_setup"){field_display_only = 'Pricing Structure'}
		if (field == "terminal_type"){field_display_only = 'Terminal Type'}
		if (field == "pin_debit"){field_display_only = 'Pin Debit'}
		if (field == "monthly_service_fee"){field_display_only = 'Monthly Service Fee'}
		if (field == "qual_discount_rate"){field_display_only = 'Qual Discount Rate'}
		if (field == "authorization_fee"){field_display_only = 'Authorization Fee'}
		if (field == "setup_fee_one_time"){field_display_only = 'One Time Setup Fee'}
		if (field == "annual_fee"){field_display_only = 'Annual Fee'}
		if (field == "date_submitted"){field_display_only = 'Date Submitted'}
		if (field == "date_approved"){field_display_only = 'Date Approved'}
		if (field == "date_activated"){field_display_only = 'Date Activated'}
		if (field == "date_last_updated"){field_display_only = 'Date last updated'}
		if (field == "contact_name"){field_display_only = 'Contact Name'}
		if (field == "contact_email"){field_display_only = 'Contact Email'}
		if (field == "contact_phone"){field_display_only = 'Contact Phone'}
		if (field == "contact_cell"){field_display_only = 'Contact Cell'}
		if (field == "contact_street"){field_display_only = 'Contact Street'}
		if (field == "contact_city"){field_display_only = 'Contact City'}
		if (field == "contact_state"){field_display_only = 'Contact State'}
		if (field == "contact_zip"){field_display_only = 'Contact Zip'}
		if (field == "company_name"){field_display_only = 'Company Name'}
		if (field == "company_email"){field_display_only = 'Company Email'}
		if (field == "company_phone"){field_display_only = 'Company Phone'}
		if (field == "company_street"){field_display_only = 'Company Street'}
		if (field == "company_city"){field_display_only = 'Company City'}
		if (field == "company_state"){field_display_only = 'Company State'}
		if (field == "company_zip"){field_display_only = 'Company Zip'}
		if (field == "company_notes"){field_display_only = 'Company Notes'}
		if (field == "company_country"){field_display_only = 'Company Country'}
		if (field == "amount_processed"){field_display_only = 'Amount Processsed'}
		if (field == "number_processed"){field_display_only = 'Number Of Transactions'}
		if (field == "company_status_code"){field_display_only = 'Company Status Code'}
		if (field == "amounts_since"){field_display_only = 'Totals from date'}
		if (field == "tracking"){field_display_only = 'Tracking ID'}
		if (field == "carrier"){field_display_only = 'Shipping Company'}
		if (field == "shipping_status"){field_display_only = 'Status'}
		if (field == "shipping_notes"){field_display_only = 'Background'}
		if (field == "payment_status"){field_display_only = 'Payment Status'}
		if (field == "commission_total"){field_display_only = 'Commission Total'}
		if (field == "commission_amount_paid"){field_display_only = 'Commission Amount Paid'}
		if (field == "commission_paid_date"){field_display_only = 'Date Paid'}
		if (field == "payment_received_date"){field_display_only = 'Date Payment Received'}
		if (field == "payment_due_date"){field_display_only = 'Date Payment Due'}
		if (field == "ppg_payment_total"){field_display_only = 'PPG Payment'}
		if (field == "payment_amount_received"){field_display_only = 'Payment Amount Received'}
		if (field == "ballance_due"){field_display_only = 'Ballance Due'}
		if (field == "amount_due_rep"){field_display_only = 'Amount Due Rep'}
		if (field == "amount_due_ppg"){field_display_only = 'Amount Due PPG'}
		if (field == "unknown_field"){field_display_only = 'unknown'}

		if (field == "client_password"){field_display_only = 'Password'}	
		if (field == "client_enabled"){field_display_only = 'Enabled'}	
		if (field == "client_name"){field_display_only = 'Name'}
		if (field == "client_email"){field_display_only = 'Email'}
		if (field == "client_phone"){field_display_only = 'Phone'}	
		if (field == "client_street"){field_display_only = 'Street'}	
		if (field == "client_city"){field_display_only = 'City'} 
		if (field == "client_state"){field_display_only = 'State'} 	
		if (field == "client_zip"){field_display_only = 'Zipcode'}	
		if (field == "client_notes"){field_display_only = 'Notes'}
		
		if (field == "client_id" && table == 'group_admin'){field_display_only = 'Administrator'}
	
		$('#grid_modal').dialog('option', 'minHeight', 300);
		$('#grid_modal').dialog('option', 'minWidth', 300);

 		flush_dialog();	
 		
		$("#grid_modal").dialog("open") 		
		$("#grid_modal").css('line-height','30px')
		$("#grid_modal").html('<div class="error"></div><div id="modal_pkey" value="'+togg+'" class="field_label_modal">'+
		field_display_only+ '</div>');

		var foundit = false;
		
		$('#modal_input_'+togg).bind('keypress', function(e) {
	        	if (e.keyCode==13 && field != 'order_notes'){
	                $("#grid_modal_submit").click();
	       		 }
		});	
		
		if (field == 'company_notes')
		{		
			foundit = true;
			$("#grid_modal").append('<textarea id="modal_input_'+togg+'" class="tiny_textarea" type="tiny_text">'+db('get_field_value','&table='+table+'&field='+field+'&pkey_field='+merchant_id+'&pkey_value='+id)+'</textarea>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}
		if (field == 'client_id' && table == "group_admin")
		{
			
			foundit = true;
			var admin_status = db('exists','&table='+table+'&field='+client_id+'&field_value='+id);
		
			if (admin_status == 'true'){admin_status = 'yes';}else{admin_status = 'no';}
			
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" value="'+admin_status+'" class="tiny_styled_select"><option value="yes">Yes</option><option value="no">No</option></select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
			
		
		}
		if (field == 'client_enabled')
		{
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select"><option value="yes">Yes</option><option value="no">No</option></select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}
		if (field == 'carrier')
		{
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select"><option value="FedEx">FedEx</option><option value="UPS">UPS</option><option value="USPS">USPS</option></select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}
		if (field == 'rep_id')
		{
					
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select">'+db('rep_list','')+'</select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}			
		if (field == 'company_state')
		{
					
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select"></div>'+db('list_states','')+'</select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}
		if (field == 'payment_status')
		{
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select">'+db('load_status_list_payment','')+'</select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}	
		if (field == 'order_status')
		{
			foundit = true;
			$("#grid_modal").append('<div class="tiny_styled_select"><select id="modal_input_'+togg+'" class="tiny_styled_select">'+db('load_status_list_order','')+'</select></div>'+		
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}
		 if (field == 'client_password')
		{
			foundit = true;
			var content = '<input id="modal_input_'+togg+'" type="tiny_text" style="width:92%;margin-top:5px;" value="" /></div>'+
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>'
			
			$("#grid_modal").append(content)
		}
		
		if (field == 'order_notes')
		{
			foundit = true;		
			$("#grid_modal").append('<textarea class="tiny_textarea" type="tiny_text" style="position:relative;left:-5px;" id="modal_input_'+togg+'" maxlength="2000">'+db('get_field_value','&table='+table+'&field='+field+
			'&pkey_field=merchant_id+&pkey_value='+id)+'</textarea></div>'+		
			'<div id="button_modal" style="margin-top:25px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"/></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>')
		}	
		
		if (foundit == false && table == 'orders')
		{
		
			var content = '<input id="modal_input_'+togg+'" type="tiny_text" style="width:92%;margin-top:5px;" value="'+db('get_field_value','&table='+table+
			'&field='+field+'&pkey_field=merchant_id'+'&pkey_value='+id)+'" /></div>'+
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>'
			
			$("#grid_modal").append(content)
		}

		if (foundit == false && table == 'client')
		{
			var content = '<input id="modal_input_'+togg+'" type="tiny_text" style="width:92%;margin-top:5px;" value="'+db('get_field_value','&table='+table+
			'&field='+field+'&pkey_field=client_id'+'&pkey_value='+id)+'" /></div>'+
			'<div id="button_modal" style="margin-top:55px;width:57%;float:left;"><input type="tiny_button" style="" name="login_submit" id="grid_modal_submit" value="Update"  /></div>'+
			'<div id="spinner" class="modal_spinner"></div></div>'
			
			$("#grid_modal").append(content)
		}
	

		if (instr(togg,'date') == true){		
			$('#modal_input_'+togg).datepicker({});
			$('#modal_input_'+togg).focus()
		}
		else
		{
			$('#modal_input_'+togg).datepicker('disable');
			$('#modal_input_'+togg).focus()
			//$('#modal_input_'+togg).datepicker("distroy");
		}
					
		
		$("#grid_modal_submit").on('click',function(e){ 
			$('.error_text').hide().text("");
				
		//	$('#grid_modal_submit').hide();
		
		
		//	$('.modal_spinner').show();
				
		
			var new_field_value = $('#modal_input_'+togg).val();
			var found_error = false;
				
			//CHECK FOR ERRORS
			
			// IS NUMERIC
			if (IsNumeric(new_field_value) == false && $('#'+togg).hasClass('ck_numeric')){ found_error = true; $('.error').text("Enter just number").css('display','block'); $('.modal_spinner').hide();$('#grid_modal_submit').show(); return}
			
			// HAS VALUE
			if (new_field_value == '' && $('#'+togg).hasClass('ck_required')){ found_error = true; $('.error').text("Enter value").css('display','block'); $('.modal_spinner').hide();$('#grid_modal_submit').show(); return}
		
			// COMMIT CHANGES
			if (table == 'orders'){
			
				var doit = db('update_field_by_id','&table='+table+'&field='+field+'&myvalue='+new_field_value+'&pkey_field=merchant_id'+'&pkey='+id)
			}
			if (table == 'client')
			{
				var doit = db('update_field_by_id','&table='+table+'&field='+field+'&myvalue='+new_field_value+'&pkey_field=client_id'+'&pkey='+id)
			}
			if (table == 'group_admin' && field == 'client_id')
			{
			
				var doit = db('update_admin','&new_field_value='+new_field_value+'&client_id='+id);
			}
			
			if (doit != 1 && doit != 2){{ found_error = true; $('.error').show().text("Could not update: " + doit); $('.modal_spinner').hide();$('#grid_modal_submit').show(); return}}
		
			var t = setTimeout("$('.modal_spinner').hide();$('#grid_modal_submit').show();", 3000);
	
			$("#grid_modal").dialog("destroy")
			flush_dialog();	
			
			
			// UPDATE UI WITH NEW INFORMATION
			
			var foundit = false
			if (field == 'company_state' && foundit != true)
			{
				foundit = true;
				$('.'+togg).text(db('get_field_value','&table=orders&field=company_state&pkey_field=merchant_id&pkey_value='+id));
			}
			
			var foundit = false
			if (field == 'rep_id' && foundit != true)
			{
				foundit = true;
				var doit = db('get_field_value','&table=orders&field=rep_id&pkey_field=merchant_id&pkey_value='+id)
				$('.'+togg).text(db('get_field_value','&table=rep&field=rep_name&pkey_field=rep_id&pkey_value='+doit));
			}

			if (field == 'client_id' && table == 'group_admin' && foundit != true)
			{
				foundit = true;
				var my_status = db('exists','&table='+table+'&field='+client_id+'&field_value='+id);
		
				if (my_status == 'false'){my_status = 'No'}else{my_status = 'Yes'}
			
				$('.'+togg).text(my_status);
				
			}
			if (field == 'client_enabled' && table == 'client' && foundit != true)
			{
				foundit = true;
				var my_status = db('get_field_value','&table=client&field=client_enabled&pkey_field=client_id&pkey_value='+id)
				
				if (my_status == 'yes'){my_status = 'Yes'}else{my_status = 'No'}
				$('.'+togg).text(my_status);
			}
			if (field == 'payment_status' && table == 'orders' && foundit != true)
			{
				foundit = true;
				var my_status = db('get_field_value','&table=orders&field=commission_paid_date&pkey_field=merchant_id&pkey_value='+id)
				$('.commission_paid_date').text(my_status);
			}
			// CATCH ALL
			
			if (foundit == false & table == 'orders')
			{
				foundit = true;
				$('.'+togg).text(db('get_field_value','&table='+table+'&field='+field+'&pkey_field=merchant_id&pkey_value='+id));  
			} 
			if (foundit == false)
			{
				$('.'+togg).text(db('get_field_value','&table='+table+'&field='+field+'&pkey_field='+client_id+'&pkey_value='+id));
			}  	
			$('#'+togg).effect("highlight", {color:"#90EE90"}, 5000)
			
		});				

	});	
}
actions();

});


			


