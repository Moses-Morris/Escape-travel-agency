<?php
header('Content-Type: application/json');

// database connection
$conn = mysqli_connect("localhost", "root", "", "escape_agency");
if (!$conn) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

// get event id
if (!isset($_POST['event_id'])) {
    echo json_encode(["success" => false, "message" => "No event ID provided"]);
    exit;
}
$event_id = intval($_POST['event_id']);

// update LikesAVG (+1)
$sql = "UPDATE events SET LikesAVG = LikesAVG + 1 WHERE EventID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);

// fetch new like count
$sql2 = "SELECT LikesAVG FROM events WHERE EventID = ?";
$stmt2 = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $event_id);
mysqli_stmt_execute($stmt2);
mysqli_stmt_bind_result($stmt2, $likes);
mysqli_stmt_fetch($stmt2);

echo json_encode(["success" => true, "likes" => $likes]);

mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
mysqli_close($conn);
?>
