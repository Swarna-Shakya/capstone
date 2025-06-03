<?php
require_once("include/initialize.php");

// saving data to database
extract($_REQUEST);

$record 			= new Bookings();
$record->room_id 	= $room_id;
$record->room_title = $room_title;
$record->check_in 	= $check_in;
$record->check_out 	= $check_out;
$record->name 		= $name;
$record->phone 		= $phone;
$record->email 		= $email;
$record->message 	= $message;
$record->book 		= "true";
$record->created_at = date("Y-m-d H:i:s");
$record->save();


// send email to admin
$usermail 	= "statshakya@gmail.com";
$sitename 	= "Capstone";
$ccusermail = "7evanzelina@gmail.com";

$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p></td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Room booking message</span><br />
		  The details provided are:</p>
		  <p>
            <strong>Room Title</strong>: ' . $room_title . '<br />
            <strong>Check In</strong>: ' . $check_in . '<br />
            <strong>Check Out</strong>: ' . $check_out . '<br />
            <strong>Booked Date</strong>: ' . $record->created_at . '<br /><br/>
            <strong>Fullname</strong> : ' . $name . '<br />		
		    <strong>E-mail Address</strong>: ' . $email . '<br />
		    <strong>Phone Number</strong>: ' . $phone . '<br />
		    <strong>Message</strong>: ' . $message . '<br /><br />         
		  </p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		' . $name . '
		</p></td>
	  </tr>
	</table>
	';

$mail = new PHPMailer(); // defaults to using php "mail()"
$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name);
$mail->AddAddress($usermail, $sitename);
if (!empty($ccusermail)) {
	$rec = explode(';', $ccusermail);
	if ($rec) {
		foreach ($rec as $row) {
			$mail->AddCC($row, $sitename);
		}
	}
}

$mail->Subject    = 'Booking mail from ' . $name;
$mail->MsgHTML($body);
$mail->Send();


// send email to user
$body = '
<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p></td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Thank you for room booking!</span><br />
		  The details provided are:</p>
		  <p>
            <strong>Room Title</strong>: ' . $room_title . '<br />
            <strong>Check In</strong>: ' . $check_in . '<br />
            <strong>Check Out</strong>: ' . $check_out . '<br />
            <strong>Booked Date</strong>: ' . $record->created_at . '<br /><br/>
            <strong>Fullname</strong> : ' . $name . '<br />		
		    <strong>E-mail Address</strong>: ' . $email . '<br />
		    <strong>Phone Number</strong>: ' . $phone . '<br />
		    <strong>Message</strong>: ' . $message . '<br /><br />         
		  </p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		' . $sitename . '
		</p></td>
	  </tr>
	</table>';

$cmail = new PHPMailer();
$cmail->SetFrom($usermail, $sitename);
$cmail->AddReplyTo($usermail, $sitename);
$cmail->AddAddress($email, $name);
$cmail->Subject    = 'Booking in ' . $sitename;
$cmail->MsgHTML($body);

if (!$cmail->Send()) {
	echo json_encode(array("action" => "unsuccess", "message" => "We could not sent your message at the time. Please try again later."));
} else {
	echo json_encode(array("action" => "success", "message" => "Your booking has been successfully sent."));
}
