<?php 

include ("admin/common/common.php");

$sqlc3 = "select * from " . $tblGeneralContent . " where section='contact-mailadd'";
$rsc3 = mysql_query($sqlc3) or die(mysql_error());
$rowc3 = mysql_fetch_assoc($rsc3);


/*
$sqlcnew = "select * from " . $tblGeneralContent . " where autoid=10";
$rscnew = mysql_query($sqlcnew) or die(mysql_error());
$rowsub = mysql_fetch_assoc($rscnew);
*/


/* Email address which sent mail */
$EmailAddress =$rowc3['content'];;

/* Email Subject */
$subject = "Contact Us Form";

/* Message body of email */


$message = "Name:- ".$_POST['fname']."&nbsp;".$_POST['lname']."<br/>".
           "\n Title:- ".$_POST['title']."<br/>".
		   "\n Phone:- ".$_POST['phone']."<br/>".
           "\n Email Address:- ".$_POST['email']."<br/>".
		   "\n Comments:- ".$_POST['comment']."<br/>".
		   "\n ";
	  
  			

$headers = 'From: '.$subject.'' . "\r\n" .
           'Reply-To: webmaster@example.com' . "\r\n" .
           "Content-Type: text/html\r\n".
           'X-Mailer: PHP/' . phpversion();
	
//	echo 		$EmailAddress;	//$email = ;
				if(mail($EmailAddress, $subject, $message, $headers)){
					 echo '<div class="mailok">Your message was sent successfully. Thanks.</div> <br/><br/>';
					}else{
					  echo '<div class="mailerrors">Your message was Not Sent..Please Try Again Later</div><br/><br/>';	
					}

				
				
		   
?>                                       