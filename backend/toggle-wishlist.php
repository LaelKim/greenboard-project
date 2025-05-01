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

    // Vérifie si déjà dans la wishlist
    $stmt = $pdo->prepare("SELECT * FROM wishlists WHERE user_id = ? AND game_id = ?");
    $stmt->execute([$userId, $gameId]);

    if ($stmt->rowCount() > 0) {
        // Supprime si déjà présent
        $pdo->prepare("DELETE FROM wishlists WHERE user_id = ? AND game_id = ?")
            ->execute([$userId, $gameId]);
        echo json_encode(['status' => 'removed']);
    } else {
        // Ajoute sinon
        $pdo->prepare("INSERT INTO wishlists (user_id, game_id) VALUES (?, ?)")
            ->execute([$userId, $gameId]);
        echo json_encode(['status' => 'added']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
