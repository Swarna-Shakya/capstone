<?php
// send data in JSON format about rooms
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../include/initialize.php';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method == 'GET') {
    $rooms_data = [];
    // Fetch room data from the database
    $query = "SELECT * FROM rooms ORDER BY id DESC";
    $rooms = Rooms::find_by_sql($query);
    if ($rooms) {
        foreach ($rooms as $room) {
            $room_data = [
                'id' => $room->id,
                'title' => $room->title,
                'quantity' => $room->room_qnty,
                'beds' => $room->beds,
                'bed_type' => $room->bed_type,
                'image' => BASE_URL . 'images/rooms/' . $room->image,
                'price' => $room->price,
                'currency' => $room->currency
            ];
            $rooms_data[] = $room_data;
        }
    } else {
        http_response_code(404);
        echo json_encode(['action' => 'error', 'message' => 'No rooms found']);
    }
    http_response_code(200);
    // Return the rooms data as JSON
    echo json_encode(['action' => 'success', 'data' => $rooms_data]);
} else {
    http_response_code(405);
    echo json_encode(array("action" => "error", "message" => "Method not allowed."));
}
