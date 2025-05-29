<?php
session_start();
header('Content-Type: application/json');

$host = 'localhost';
$db = 'escapeagency';
$user = 'root';
$pass = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

$action = $_POST['action'] ?? '';
//$user_id = $_SESSION['user_id'] ?? 1; // Replace with real session check in production
//$user_id = $_SESSION['user_id'] ?? 1;
$user_id = $_SESSION['username'] ?? 'Guest'; // Replace with real session check in production
switch ($action) {
    case 'toggle_favorite':
        $event_id = $_POST['event_id'] ?? 0;
        handleToggleFavorite($pdo, $user_id, $event_id);
        break;
    case 'get_counts':
        getFavoriteCounts($pdo, $user_id);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

function handleToggleFavorite($pdo, $user_id, $event_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM user_event_likes WHERE user_id = ? AND event_id = ?");
        $stmt->execute([$user_id, $event_id]);
        $exists = $stmt->fetch();

        if ($exists) {
            $stmt = $pdo->prepare("DELETE FROM user_event_likes WHERE user_id = ? AND event_id = ?");
            $stmt->execute([$user_id, $event_id]);
            $is_favorited = false;
            $message = 'Removed from favorites';
        } else {
            $stmt = $pdo->prepare("INSERT INTO user_event_likes (user_id, event_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $event_id]);
            $is_favorited = true;
            $message = 'Added to favorites';
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM user_event_likes WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $total_favorites = $stmt->fetch()['count'];

        echo json_encode([
            'success' => true,
            'is_favorited' => $is_favorited,
            'total_favorites' => (int)$total_favorites,
            'message' => $message
        ]);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}

function getFavoriteCounts($pdo, $user_id) {
    try {
        $stmt = $pdo->prepare("SELECT event_id, COUNT(*) as count FROM user_event_likes GROUP BY event_id");
        $stmt->execute();
        $counts = [];
        while ($row = $stmt->fetch()) {
            $counts[$row['event_id']] = (int)$row['count'];
        }

        $stmt = $pdo->prepare("SELECT event_id FROM user_event_likes WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user_favorites = [];
        while ($row = $stmt->fetch()) {
            $user_favorites[] = $row['event_id'];
        }

        echo json_encode([
            'success' => true,
            'counts' => $counts,
            'user_favorites' => $user_favorites
        ]);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>