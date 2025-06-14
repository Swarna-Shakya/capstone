<?php
require_once '../include/initialize.php';
$session->clear('u_id');
$session->clear('accesskey');
$session->clear('acc_agent');
$session->clear('loginUser');
redirect_to(BASE_URL.'admin/login.php');
?>