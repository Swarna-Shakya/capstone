<?php
require_once '../../include/initialize.php';
$action = $_REQUEST['action'];
	
	switch($action) 
	{
case "checkLogin":
			$session->start();
			$uname    = addslashes($_REQUEST['user']);
			$password = addslashes($_REQUEST['password']) ;

			$found_user = User::authenticateAdmin($uname, md5($password));
			// pr($found_user);
			
			// ** check the number of login attempts
			$_SESSION['countrials'] = (isset($_SESSION['countrials'])) ? $_SESSION['countrials']+1 : 1;
			if($found_user):	
				$session->set('u_id',$found_user->id);
				$session->set('acc_ip',$_SERVER['REMOTE_ADDR']);
				$session->set('acc_agent',$_SERVER['HTTP_USER_AGENT']);
				// $session->set('user_type',$found_user->type);
				$session->set('loginUser',$found_user->user_name);

				echo json_encode(array("action"=>"success","message"=>"Login Successfully","redirect_url"=>BASE_URL."admin/check_login.php"));
			else: 
				echo json_encode(array("action"=>"unsuccess","message"=>"Username Or Password Not Match "));     
			endif;
			//  pr($_SESSION);
		break;
    }