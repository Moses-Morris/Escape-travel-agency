<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    include('User/config/connection.php');
    session_start();

    $userID = $_SESSION['user_id'];
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $country = mysqli_real_escape_string($mysqli, $_POST['country']);
    $location = mysqli_real_escape_string($mysqli, $_POST['location']);

    $destinationID = (int) $_POST['destination_id'];
    $destinationPrice = (float) $_POST['destination_price'];
    $totalPrice = (float) $_POST['total_price'];

    $activitiesJson = mysqli_real_escape_string($mysqli, $_POST['selected_activities']);
    $hostingJson = mysqli_real_escape_string($mysqli, $_POST['selected_hosting']);
    $travelJson = mysqli_real_escape_string($mysqli, $_POST['selected_travel']);

    $bookingType = "online"; // or from form dropdown
    $status = "Pending";
    $createdAt = date("Y-m-d H:i:s");

    // Decode JSON to store in normalized tables later if needed
    $activities = json_decode($activitiesJson, true);
    $hosting = json_decode($hostingJson, true);
    $travel = json_decode($travelJson, true);

    // Save to bookings table
    $insert = mysqli_query($mysqli, "
        INSERT INTO bookings (UserID, DestinationID, BookingType, TotalPrice, Status, Created_at)
        VALUES ('$userID', '$destinationID', '$bookingType', '$totalPrice', '$status', '$createdAt')
    ");

    $bookingID = mysqli_insert_id($mysqli);

    // Optional: insert into booking_items
    if ($activities) {
        foreach ($activities as $activity) {
            $actTitle = mysqli_real_escape_string($mysqli, $activity['title']);
            $actPrice = (float)$activity['price'];
            mysqli_query($mysqli, "
                INSERT INTO booking_items (BookingID, ItemType, Title, Price)
                VALUES ('$bookingID', 'activity', '$actTitle', '$actPrice')
            ");
        }
    }

    if ($hosting) {
        $hostTitle = mysqli_real_escape_string($mysqli, $hosting['title']);
        $hostPrice = (float)$hosting['price'];
        mysqli_query($mysqli, "
            INSERT INTO booking_items (BookingID, ItemType, Title, Price)
            VALUES ('$bookingID', 'hosting', '$hostTitle', '$hostPrice')
        ");
    }

    if ($travel) {
        $travelTitle = mysqli_real_escape_string($mysqli, $travel['title']);
        $travelPrice = (float)$travel['price'];
        mysqli_query($mysqli, "
            INSERT INTO booking_items (BookingID, ItemType, Title22, Price)
            VALUES ('$bookingID', 'travel', '$travelTitle', '$travelPrice')
        ");
    }

    echo "<script>alert('Booking successfully placed!'); window.location='bookingsummary.php?';</script>";
    exit();
}
?>
