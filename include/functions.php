<?php

function pr($arr, $exit = true)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($exit) die();
}

function redirect_to($location = NULL)
{
    if ($location != NULL):
        //header("Location: {$location}");
        echo "<script language='javascript'>window.location.href = '{$location}';</script>";
        exit;
    endif;
}

// Display file size 
function getFileFormattedSize($size = 0)
{
    $formattedSize = $size;
    if ($size > 0) {
        $formattedSize = $size . ' B';
    }
    if ($size > 1024) {
        $formattedSize = ceil($size / 1024) . ' KB';
    }
    if ($size > 1048576) {
        $formattedSize = ceil($size / 1048576) . ' MB';
    }
    return $formattedSize;
}

function randomKeys($length, $pattern = '')
{
    $i = "";
    $key     = "";
    $add     = "";
    $strLength  = 0;
    if (empty($pattern)) {
        $pattern  =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
    $i = 0;
    $strLength  =  strlen($pattern);
    for ($i = 1; $i <= $length; $i++) {
        $add     =  $pattern[rand(0, $strLength)];
        if (empty($add)) {
            $add     =  $pattern[rand(0, $strLength)];
            $key   .= $add;
        } else {
            $key   .= $add;
        }
    }
    return $key;
}
function confirm_logged_in() {
    global $session;

    if (!$session->get('u_id')) {
        redirect_to(BASE_URL . 'admin/login.php');
        exit;
    }
}