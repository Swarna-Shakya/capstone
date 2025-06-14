<?php
require_once '../../include/initialize.php';
$action = $_REQUEST['action'];
	
	switch($action) 
	{
    case "add":

        $room = new rooms();

        $room->title    		= $_REQUEST['title'];
        $room->room_qnty    	= $_REQUEST['room_qnty'];
        $room->bed_type 		= $_REQUEST['bed_type'];
        $room->currency		= $_REQUEST['currency'];    
        $room->price		= $_REQUEST['price'];
        $room->content   	= $_REQUEST['content'];
       


        $db->begin();
        if($room->save()):  $db->commit();
            // Global slug table storeSlug(class name, main slug, store id);
            // $act_id = $db->insert_id();
            $qry = $db->query("SELECT LAST_INSERT_ID() as lastId");
            $row = $db->fetch_object($qry);
            echo json_encode(array("action"=>"success","message"=>"Room saved Successfully","redirect_url"=>BASE_URL."admin/rooms.php"));
              else: $db->rollback();
            echo json_encode(array("action"=>"unsuccess","message"=>"data not saved"));   
        endif;
        break;
    }