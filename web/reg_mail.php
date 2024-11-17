<?php


require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");

$mail = new PHPMailer();

$mail->IsSMTP();
//$mail->SMTPDebug=2;                                      // set mailer to use SMTP
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;          // specify main and backup server
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "gauravwebigc@gmail.com";  // SMTP username
$mail->Password = "Gsi@9810895713"; // SMTP password

$mail->From = "gauravwebigc@gmail.com";
$mail->FromName = "Registration at $store_name";
$mail->addBCC("gauravwebigc@gmail.com", "Mobilabs.in");
$mail->AddAddress("$customer_mail_id", "$customer_name");
$mail->AddAddress("$store_mail_id", "$store_name");
$mail->addReplyTo("store@mobilabs.in", "Mobilabs.in");
$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Registration Successfull";

$mail->Body =  "
<h4>Dear $customer_name;</h4>

<p>Thankyou for Registration at $store_name. $store_name is a Grocery Store near by your location. Now you can buy Groceries from $store_name Online.</p>
<p>$store_name Deliver Groceries at your Door in next 2 hour.</p>

<hr>
<p><b>Store Information:</b><br>
<b>$store_name</b><br>
$store_address<br>
$store_phone<br>
$store_mail_id</p>

<hr>
<center><p style='color:grey; font-size:9px;'>This store is Generated via Mobilabs.in, who provides all Web developement and IT Support Services</p></center>";

$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

?>
