<?php
require_once '../include/initialize.php';

$accsid    = $session->get('u_id');
if (!$accsid) {
    redirect_to(BASE_URL . 'admin/login.php');
}
