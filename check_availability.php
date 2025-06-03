<?php
require_once("include/initialize.php");

$roomId     = isset($_POST['room_id']) ? (int)$_POST['room_id'] : 0;
$checkIn    = isset($_POST['check_in']) ? trim($_POST['check_in']) : '';
$checkOut   = isset($_POST['check_out']) ? trim($_POST['check_out']) : '';

if (!$roomId || !$checkIn || !$checkOut) {
    echo "Invalid input.";
    exit;
}

$checkInDate    = date('Y-m-d', strtotime($checkIn));
$checkOutDate   = date('Y-m-d', strtotime($checkOut));


$roomdata   = Rooms::find_by_id($roomId);
if (!$roomdata) {
    echo "Room not found.";
    exit;
}

$totalRooms = (int) $roomdata->room_qnty;

$bookingRec = Bookings::check_available_room($checkInDate, $checkOutDate, $roomId);
if (!$bookingRec) {
    echo "Error checking room availability.";
    exit;
}

$bookedRooms = 0;
if ($bookingRec->num_rows > 0) {
    $row = $bookingRec->fetch_assoc();
    $bookedRooms = (int) $row['booked_rooms'];
}

if ($bookedRooms >= $totalRooms) {
    echo "Room not available for selected dates.";
} else {
    echo "Room available.";
}
