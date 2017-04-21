<?php
	$firstName 			= $_POST["firstName"];
	$surName 			= $_POST["surName"];
	$visitor_email 	= $_POST["email"];
	$visitor_age 		= $_POST["age"];
	$visitor_timezone = $_POST["timezone"];
	$visitor_country 	= $_POST["country"];
	$visitor_callsign = $_POST["callsign"];
	$visitor_section 	= $_POST["section"];
	$message 			= $_POST["message"];
	
	echo "First Name: ".$firstName."<br>\n";
	echo "Surname: ".$surName."<br>\n";
	echo "Email: ".$visitor_email."<br>\n";
	echo "Age: ".$visitor_age."<br>\n";
	echo "Timezone: ".$visitor_timezone."<br>\n";
	echo "Country: ".$visitor_country."<br>\n";
	echo "Callsign: ".$visitor_callsign."<br>\n";
	echo "Section: ".$visitor_section."<br>\n";
	echo "Message:<br>\n".$message."<br>\n";
	

$email_from = '69giapWebsite@69giap.com';
$email_subject = "New Form submission from Recruiting Form";
$email_body = "You have received a new message from ".$firstName." ".$surName.".\n
Applicant Details:\n
First Name: "	.$firstName.			"\n
Surname: "		.$surName.				"\n
Email: "			.$visitor_email.		"\n
Age: "			.$visitor_age.			"\n
Timezone: "		.$visitor_timezone.	"\n
Country: "		.$visitor_country.	"\n
Callsign: "		.$visitor_callsign.	"\n
Section: "		.$visitor_section.	"\n
Message:\n".$message.				"\n\n
END OF MESSAGE\n";

$to = "rowbajt@gmail.com, ptthome@free.fr, ch.bluewin@bluewin.ch";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);

$to = $visitor_email;
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email_from \r\n";

$email_subject2 = "You successfully applied for joining the 69.GIAP.";
$email_body2 = "You received this message because you applied on www.69giap.com to join this fabulous squad!\n
We will get in touch with you as soon as possible.\n
In the meantime feel free to join out teamspeak server or post something in our forums to get our attention.\n
Thanks a lot and looking forward to flying with you soon!";
mail($to,$email_subject2,$email_body2,$headers);

header ("location: http://www.69giap.com/CSS3/applicationThanks.html");					
?>