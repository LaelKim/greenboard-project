<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non connecté']);
    exit;
}

if (!isset($_POST['game_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID manquant']);
    exit;
}

$userId = $_SESSION['user_id'];
$gameId = intval($_POST['game_id']);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=greenboard;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM wishlists WHERE user_id = ? AND game_id = ?");
    $stmt->execute([$userId, $gameId]);

    if ($stmt->rowCount() > 0) {
        $delete = $pdo->prepare("DELETE FROM wishlists WHERE user_id = ? AND game_id = ?");
        $delete->execute([$userId, $gameId]);
        echo json_encode(['status' => 'removed']);
    } else {
        $insert = $pdo->prepare("INSERT INTO wishlists (user_id, game_id) VALUES (?, ?)");
        $insert->execute([$userId, $gameId]);
        echo json_encode(['status' => 'added']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
