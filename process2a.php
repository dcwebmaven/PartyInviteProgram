<?php
include($_SERVER['DOCUMENT_ROOT']."/template_top.inc");

$name = ($_GET['name']);
$subject = ($_GET['subject']);
list_evites($e, $subject);

foreach( $name as $key => $n ) {
	//assign email variable to make life easier
	$e = $_GET['email'][$key];

	if(!($n && $e) || !filter_var($e, FILTER_VALIDATE_EMAIL)) {
	
		echo "$n at $e could not be invited, INVALID EMAIL<br>";
		
	} else {
		mail_message($n, $e, $subject,($_SERVER['DOCUMENT_ROOT']."eviteemail_template2.txt"));
		
		echo "$n at $e is invited<br><br>";
               }
}


/*This function requires a single name and a single email address, which have already
  been validated, and a template file.*/
function mail_message($n, $e, $subject,$template_file) {

	/*Extracts the message content from $template_file.
	*/

	#get template contents, and replace variables with data
	$email_message = file_get_contents($template_file);
	$email_message = str_replace("#NAME#", $n, $email_message);
	$email_message = str_replace("#SUBJECT#", $subject, $email_message);
		
	#construct the email headers
	$to = $e;  
	$from = "nlinzau@cold.useractive.com";
	$email_subject = "CONTACT #".time().": "."Party Invitation";

	$headers  = "From: " . $from . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\n";  //these headers will allow our HTML tags to be displayed in the email
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";   

	#now mail
	mail($to, $email_subject, $email_message, $headers);
}

/*this function shows a copy of the information submitted on the form and whether or not 
the email addresses were valid.*/
function list_evites ($e, $subject){

	echo "<h3>Thank you!</h3>";
	echo "Here is a copy of your request:<br/><br/>";
	echo "CONTACT #".time().":<br/>";
	echo "Request Date: ".date("F d, Y h:i a")."<br/>";
	echo "Event Title: ".$subject."<br/>";
	echo "Invitations Sent To: <br/>";
		
	}
	
	
include($_SERVER['DOCUMENT_ROOT']."/template_bottom.inc");



?>
