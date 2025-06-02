<?php
require_once("include/class.phpmailer.php");

$usermail = "7evanzelina@gmail.com";
$sitename = "Capstone";
$ccusermail = "";

foreach ($_POST as $key => $val) {
    $$key = $val;
}
$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p></td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Contact message</span><br />
		  The details provided are:</p>
		  <p><strong>Fullname</strong> : ' . $name . '<br />		
		  <strong>E-mail Address</strong>: ' . $email . '<br />
		  <strong>Phone Number</strong>: ' . $phone . '<br />
		  <strong>Message</strong>: ' . $message . '<br />
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

/*
* mail info
*/

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

$mail->Subject    = 'Contact mail from ' . $name;

$mail->MsgHTML($body);

if (!$mail->Send()) {
    echo json_encode(array("action" => "unsuccess", "message" => "We could not sent your message at the time. Please try again later."));
} else {
    echo json_encode(array("action" => "success", "message" => "Your message has been successfully sent."));
}
