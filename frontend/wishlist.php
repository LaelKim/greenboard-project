<?php
include('../backend/session.php');

// Rediriger si non connecté
if (!$isLoggedIn) {
  header('Location: login.html');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Ma Wishlist - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php include('header.php'); ?>

<main>
  <h2>🎯 Ma Wishlist</h2>
  <div class="catalogue-grid">
    <?php
    try {
      $pdo = new PDO("mysql:host=localhost;dbname=greenboard;charset=utf8", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $pdo->prepare("
        SELECT 
          g.id, g.name, r.thumbnail, r.average
        FROM games g
        JOIN ratings r ON g.id = r.id
        JOIN wishlists w ON w.game_id = g.id
        WHERE w.user_id = ?
      ");
      $stmt->execute([$_SESSION['user_id']]);
      $games = $stmt->fetchAll();

      if (count($games) === 0) {
        echo "<p>Aucun jeu dans votre wishlist.</p>";
      } else {
        foreach ($games as $game) {
          $img = $game['thumbnail'] && str_starts_with($game['thumbnail'], 'http') 
              ? $game['thumbnail'] 
              : 'https://via.placeholder.com/150?text=No+Image';

          echo '<div class="card">';
          echo '<a href="jeu.php?id=' . $game['id'] . '" style="text-decoration: none; color: inherit;">';
          echo '<img src="' . $img . '" alt="' . htmlspecialchars($game['name']) . '">';
          echo '<h3>' . htmlspecialchars($game['name']) . '</h3>';
          echo '<p>Note moyenne : ' . number_format($game['average'], 2) . '</p>';
          echo '</a>';
          echo '<form method="POST" action="../backend/toggle-wishlist.php" style="margin-top: 0.5rem;">';
          echo '<input type="hidden" name="game_id" value="' . $game['id'] . '">';
          echo '<button class="wishlist-btn active">🗑 Retirer</button>';
          echo '</form>';
          echo '</div>';
        }
      }
    } catch (PDOException $e) {
      echo "<p>Erreur de chargement : " . $e->getMessage() . "</p>";
    }
    ?>
  </div>
</main>

<?php include('footer.php'); ?>
</body>
</html>
