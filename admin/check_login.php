<?php
require_once '../include/initialize.php';

$accsid    = $session->get(var: 'u_id');
if(!empty($accsid)){
$useracess= user::find_by_id($accsid);
if ($useracess) {
    redirect_to(BASE_URL . 'admin/index.php');
}
}
else{
    redirect_to(BASE_URL . 'admin/login.php');
}
