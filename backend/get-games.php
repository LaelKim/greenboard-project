<?php
// Connexion à la base de données
$host = 'localhost';
$db   = 'greenboard';
$user = 'root';
$pass = ''; // Mets ton mot de passe si tu en as un
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Requête pour récupérer les données complètes avec image et catégorie
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
    echo json_encode($games);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
