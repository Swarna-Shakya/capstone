<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

require_once("../include/initialize.php");

try {
    // Get input data
    $input = json_decode(file_get_contents('php://input'), true);

    $checkIn = isset($input['check_in']) ? trim($input['check_in']) : '';
    $checkOut = isset($input['check_out']) ? trim($input['check_out']) : '';
    $roomType = isset($input['room_type']) ? trim($input['room_type']) : '';

    // If no dates provided, show current availability for today
    if (empty($checkIn) || empty($checkOut)) {
        $checkIn = date('Y-m-d');
        $checkOut = date('Y-m-d', strtotime('+1 day'));
    }

    $checkInDate = date('Y-m-d', strtotime($checkIn));
    $checkOutDate = date('Y-m-d', strtotime($checkOut));

    // REAL-TIME DATABASE QUERY - No static data, fetch everything live
    global $db;

    // Build dynamic SQL query for real-time availability
    $sql = "
        SELECT 
            r.id,
            r.title,
            r.room_qnty as total_rooms,
            r.price,
            r.currency,
            r.image,
            r.content as description,
            COALESCE(b.booked_count, 0) as booked_rooms,
            (r.room_qnty - COALESCE(b.booked_count, 0)) as available_rooms
        FROM rooms r
        LEFT JOIN (
            SELECT 
                room_id,
                COUNT(*) as booked_count
            FROM bookings 
            WHERE book = 'true'
            AND (check_in < '$checkOutDate' AND check_out > '$checkInDate')
        ) b ON r.id = b.room_id
    ";

    // Add room type filter if specified
    if (!empty($roomType)) {
        $sql .= " WHERE r.title LIKE '%" . $db->escape_value($roomType) . "%'";
    }

    $sql .= " ORDER BY r.id";

    // Execute real-time query
    $result = $db->query($sql);

    if (!$result) {
        throw new Exception("Database query failed: " . $db->last_query);
    }

    $availableRooms = [];
    $allRooms = [];

    while ($row = $result->fetch_assoc()) {
        $roomData = [
            'id' => (int) $row['id'],
            'title' => $row['title'],
            'total_rooms' => (int) $row['total_rooms'],
            'booked_rooms' => (int) $row['booked_rooms'],
            'available_rooms' => (int) $row['available_rooms'],
            'price' => $row['price'],
            'currency' => $row['currency'],
            'image' => $row['image'],
            'description' => $row['description']
        ];

        $allRooms[] = $roomData;

        // Only include rooms with availability > 0 in available_rooms array
        if ($roomData['available_rooms'] > 0) {
            $availableRooms[] = $roomData;
        }
    }

    // Real-time response with live database data
    $response = [
        'success' => true,
        'check_in' => $checkInDate,
        'check_out' => $checkOutDate,
        'available_rooms' => $availableRooms,
        'all_rooms' => $allRooms, // Include all rooms for complete picture
        'total_available_types' => count($availableRooms),
        'total_room_types' => count($allRooms),
        'query_timestamp' => date('Y-m-d H:i:s'),
        'data_source' => 'real_time_database'
    ];

    echo json_encode($response, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    $response = [
        'success' => false,
        'error' => 'Real-time database error: ' . $e->getMessage(),
        'query_timestamp' => date('Y-m-d H:i:s'),
        'data_source' => 'real_time_database'
    ];

    echo json_encode($response, JSON_PRETTY_PRINT);
}
