<?php
// send data in JSON format about rooms
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../include/initialize.php';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method == 'POST') {

    http_response_code(500);
    $post_data = json_decode(file_get_contents("php://input"));
    if (empty($post_data->check_in)) {
        http_response_code(400);
        echo json_encode(array("action" => "error", "message" => "Check-in date is required."));
        exit();
    }
    if (empty($post_data->check_out)) {
        http_response_code(400);
        echo json_encode(array("action" => "error", "message" => "Check-out date is required."));
        exit();
    }

    $check_in = $post_data->check_in;
    $check_out = $post_data->check_out;

    $rooms_data = [];
    // Fetch room data from the database
    $available_rooms = Bookings::check_available_new($check_in, $check_out);
    if ($available_rooms && $available_rooms->num_rows > 0) {
        while ($room = $available_rooms->fetch_object()) {
            $room_data = [
                'id' => $room->room_id,
                'title' => $room->room_title,
                'quantity' => $room->room_qnty,
                'available_rooms' => $room->available_rooms,
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
        echo json_encode(['action' => 'error', 'message' => 'No rooms available for selected dates.']);
    }
    http_response_code(200);
    // Return the rooms data as JSON
    echo json_encode(['action' => 'success', 'data' => $rooms_data]);
} else {
    http_response_code(405);
    echo json_encode(array("action" => "error", "message" => "Method not allowed."));
}
