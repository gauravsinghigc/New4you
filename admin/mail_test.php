<?php


//sender, receiver, reply mails
$send_mail = "notification@24kharido.in";
$reply_mail = "24kharido@gmail.com";
$customer_mail_id = "sauravsinghigc26@gmail.com";

// Subject
$subject = "24kharido : Account Created";

// Set Message
$message = "
<style>
@import url('https://fonts.googleapis.com/css2?family=Commissioner&display=swap');
  html,
body, table, tr, th, td, h1, h2, h3, h4, h5, h6, p, span, div, section, b {
    font-family: 'Commissioner', sans-serif !important;
    font-size: 10px !important;
}
</style>
<div style='text-shadow: 0px 0px 0.5px grey;font-family: 'Commissioner', sans-serif !important; max-width:400px !important;background-color:#caeff7 !important;'>
<img src='https://24kharido.in/img/MailTopBanner.png' style='width:100%;'>
<h2 style='font-family: 'Commissioner', sans-serif !important;'>Registration Successful</h2>  <hr>
<h3 style='font-family: 'Commissioner', sans-serif !important;'><b style='font-weight: 400;'>Dear</b> Gaurav Singh</h3>

<p style='font-family: 'Commissioner', sans-serif !important;'>Your account is created Successfully on 24kharido.in Online Store.<br>Now, You can order your Favourite groceries, household items, and Personal Care Products with Our App. <br>All Orders are Delivered to your door within next 3 hours.</p>

<p style='font-family: 'Commissioner', sans-serif !important;'><b>Your Registration Details</b><br>
<b>Full Name:</b> Gaurav Singh<br>
<b>Email-ID:</b> gauravsinghigc@gmail.com<br>
<b>Phone Number:</b> +91-8447572565<br>
<b>Address:</b> House no 3814, first floor, sector 3, faridabad, haryana 121004<br>
<hr>
<b>Login Details:</b><br>
<b>URL :</b> https://24kharido.in<br>
<b>Username :</b> 8447572565<br>
<b>Password :</b> 8447572565.
</p>

<hr>
<p style='font-family: 'Commissioner', sans-serif !important;'>
<b>* Note:</b> This is a auto generated mail, send from 24kharido.in.
If you find something incorrect in this mail or have any query than mail us at $reply_mail.</p>
<a href='https://24kharido.in/'>
<img src='https://24kharido.in/img/MailBottomBanner.png' style='width:100%;'>
</a>
</div>
";

// Set From: header
$from =  "notification" . "<" . $send_mail . ">";

// Email Headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: " . $reply_mail . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mail = mail($customer_mail_id, $subject, $message, $headers);

if ($mail == true) {
  echo "Mail Send";
} else {
  echo "Unable to Send!";
}