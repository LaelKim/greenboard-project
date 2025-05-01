<?php
session_start();
$host = 'localhost';
$db   = 'greenboard';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query("
        SELECT 
            g.id, 
            g.name, 
            g.year_published, 
            g.min_players, 
            g.max_players, 
            g.playing_time, 
            g.category, 
            r.average, 
            r.thumbnail
        FROM games g
        JOIN ratings r ON g.id = r.id
        ORDER BY r.average DESC
        LIMIT 50
    ");
    $games = $stmt->fetchAll();

    $wishlist = [];
    $userId = $_SESSION['user_id'] ?? null;
    if ($userId) {
        $wstmt = $pdo->prepare("SELECT game_id FROM wishlists WHERE user_id = ?");
        $wstmt->execute([$userId]);
        $wishlist = array_column($wstmt->fetchAll(), 'game_id');
    }

    foreach ($games as &$game) {
        $game['in_wishlist'] = in_array($game['id'], $wishlist);
    }

    echo json_encode($games);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur DB : ' . $e->getMessage()]);
}
