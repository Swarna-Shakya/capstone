<?php
require_once '../../include/initialize.php';
$action = $_REQUEST['action'];

switch ($action) {
	case "checkLogin":
		$session->start();
		$email    = addslashes($_REQUEST['email']);
		$password = addslashes($_REQUEST['password']);

		$found_user = User::authenticateAdmin($email, md5($password));

		if ($found_user):
			$session->set('u_id', $found_user->id);
			$session->set('acc_ip', $_SERVER['REMOTE_ADDR']);
			$session->set('acc_agent', $_SERVER['HTTP_USER_AGENT']);
			$session->set('loginUser', $found_user->user_name);

			echo json_encode(array("action" => "success", "message" => "Login Successfully", "redirect_url" => BASE_URL_ADMIN . "check_login.php"));
		else:
			echo json_encode(array("action" => "unsuccess", "message" => "Credentials do not match!"));
		endif;
		break;
}
