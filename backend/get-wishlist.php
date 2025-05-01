<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
  echo json_encode([]);
  exit;
}

try {
  $pdo = new PDO("mysql:host=localhost;dbname=greenboard;charset=utf8", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("
    SELECT g.id, g.name, r.thumbnail, r.average
    FROM games g
    JOIN ratings r ON g.id = r.id
    JOIN wishlists w ON g.id = w.game_id
    WHERE w.user_id = ?
  ");
  $stmt->execute([$_SESSION['user_id']]);

  echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
