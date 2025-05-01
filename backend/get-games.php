<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$db   = 'greenboard'; // Le nom exact de ta base de données
$user = 'root';
$pass = ''; // Si tu as défini un mot de passe, remplace ici
$charset = 'utf8mb4';

// Configuration PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Connexion à la base
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Requête : récupérer les jeux + note + image + catégorie
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
    // Gestion d'erreur
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
