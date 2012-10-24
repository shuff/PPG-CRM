<html>
<head>
<script src="js/libs/jquery-1.7.2.js"></script>
<script src="jquery_UI/js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/script.js"></script>

<script>
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
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
</script>
</head>
<body>
<script>


var email = getUrlVars()["email"];
var payment = getUrlVars()["payment"];

if (email != '' && email != null && email != 'undefined'){
//var email_html = db('get_field_value','&table=emailtodb_email&field=Message_html&pkey_field=ID&pkey_value='+id);
var email = db('get_field_value','&table=emailtodb_email&field=Message&pkey_field=ID&pkey_value='+email);
document.write(email)
}

if (payment != '' && payment != null && payment != 'undefined'){
//var email_html = db('get_field_value','&table=emailtodb_email&field=Message_html&pkey_field=ID&pkey_value='+id);
var payment = db('send_payment_summery','&summery_report=yes&merchant_id='+payment);
document.write(payment)
}		
</script>

</body>
</html>