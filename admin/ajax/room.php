<?php
require_once '../../include/initialize.php';
$action = $_REQUEST['action'];

switch ($action) {
    case "add":

        $room = new Rooms();

        $room->title        = $_REQUEST['title'];
        $room->room_qnty    = $_REQUEST['room_qnty'];
        $room->beds         = $_REQUEST['beds'];
        $room->bed_type     = $_REQUEST['bed_type'];
        $room->currency     = $_REQUEST['currency'];
        $room->price        = $_REQUEST['price'];
        $room->content      = $_REQUEST['content'];
        $room->created_at   = date("Y-m-d H:i:s");
        $room->updated_at   = date("Y-m-d H:i:s");

        if (isset($_FILES['room_image']) && $_FILES['room_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../../images/rooms/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileTmpPath = $_FILES['room_image']['tmp_name'];
            $fileName = uniqid() . '_' . basename($_FILES['room_image']['name']);
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $room->image = $fileName;
            }
        }

        $db->begin();
        if ($room->save()):
            $db->commit();
            echo json_encode(
                array(
                    "action" => "success",
                    "message" => "Room added successfully.",
                    "redirect_url" => BASE_URL . "admin/rooms.php"
                )
            );
        else:
            $db->rollback();
            echo json_encode(
                array(
                    "action" => "unsuccess",
                    "message" => "Room not added."
                )
            );
        endif;
        break;

    case 'update':
        $room = Rooms::find_by_id($_POST['id'] ?? 0);

        if (!$room) {
            echo json_encode([
                'action' => 'error',
                'message' => 'Room not found.'
            ]);
            exit;
        }

        // Update room data
        $room->title      = $_REQUEST['title'];
        $room->room_qnty  = $_REQUEST['room_qnty'];
        $room->beds       = $_REQUEST['beds'];
        $room->bed_type   = $_REQUEST['bed_type'];
        $room->currency   = $_REQUEST['currency'];
        $room->price      = $_REQUEST['price'];
        $room->content    = $_REQUEST['content'];
        $room->updated_at = date("Y-m-d H:i:s");

        if (isset($_FILES['room_image']) && $_FILES['room_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../../images/rooms/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileTmpPath = $_FILES['room_image']['tmp_name'];
            $fileName = uniqid() . '_' . basename($_FILES['room_image']['name']);
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $room->image = $fileName;
            }
        }

        // Begin transaction
        $db->begin();
        if ($room->save()) {
            $db->commit();
            echo json_encode([
                "action"    => "success",
                "message"   => "Room updated successfully",
                "redirect_url" => BASE_URL . "admin/rooms.php"
            ]);
        } else {
            $db->rollback();
            echo json_encode([
                "action"    => "unsuccess",
                "message"   => "Failed to update room"
            ]);
        }
        break;
}
