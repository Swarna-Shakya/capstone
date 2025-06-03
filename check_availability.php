<?php
require_once("include/initialize.php");

$roomId = isset($_POST['room_id']) ? (int)$_POST['room_id'] : 0;
$checkIn = isset($_POST['check_in']) ? trim($_POST['check_in']) : '';
$checkOut = isset($_POST['check_out']) ? trim($_POST['check_out']) : '';

if (!$roomId || !$checkIn || !$checkOut) {
    echo "Invalid input.";
    exit;
}

$checkInDate = date('Y-m-d', strtotime($checkIn));
$checkOutDate = date('Y-m-d', strtotime($checkOut));


$roomdata = Rooms::find_by_id($roomId);
if (!$roomdata) {
    echo "Room not found.";
    exit;
}

$totalRooms = (int) $roomdata->room_qnty;

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
if ($conn->connect_error) {
    echo "Database connection failed.";
    exit;
}

$sql = "SELECT COUNT(*) as booked_rooms 
        FROM bookings 
        WHERE room_id = ? 
        AND check_in < ? AND check_out > ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Database query error.";
    exit;
}

$stmt->bind_param("iss", $roomId, $checkOutDate, $checkInDate);
$stmt->execute();
$stmt->bind_result($bookedRooms);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($bookedRooms >= $totalRooms) {
    echo "Room not available for selected dates.";
} else {
    echo "Room available.";
}
?>
