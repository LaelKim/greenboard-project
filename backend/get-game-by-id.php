<?php
// Connexion à la base de données
$host = 'localhost';
$db   = 'greenboard'; // à adapter si ton nom de base est différent
$user = 'root';
$pass = ''; // à adapter si tu as un mot de passe
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Vérifier la présence de l'ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID invalide']);
        exit;
    }

    $id = (int) $_GET['id'];

    // Requête SQL : récupérer un seul jeu avec toutes les infos
    $stmt = $pdo->prepare("
        SELECT 
            g.id,
            g.name,
            g.year_published,
            g.min_players,
            g.max_players,
            g.playing_time,
            g.category,
            g.description,
            r.average,
            r.thumbnail
        FROM games g
        JOIN ratings r ON g.id = r.id
        WHERE g.id = :id
        LIMIT 1
    ");
    $stmt->execute(['id' => $id]);
    $game = $stmt->fetch();

    if (!$game) {
        http_response_code(404);
        echo json_encode(['error' => 'Jeu non trouvé']);
        exit;
    }

    echo json_encode($game);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
