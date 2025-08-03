<?php
require_once '../include/initialize.php';

if (isset($_GET['roomid'])) {
    $room_id = $_GET['roomid'];
    $room = Rooms::find_by_id($room_id);

    if ($room) {
        $room->delete(); // Delete the room
        header("Location: rooms.php?deleted=1"); // Redirect back with status
        exit;
    }
}

header("Location: rooms.php?deleted=0"); // If not found or error
exit;
