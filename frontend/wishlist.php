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
  <meta charset="UTF-8">
  <title>Ma Wishlist - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>

  <main>
    <h2>Ma Wishlist</h2>
    <p>Ici s’afficheront les jeux ajoutés à votre liste de souhaits.</p>
    <!-- Affichage dynamique à ajouter plus tard -->
  </main>

  <footer>
    <p>&copy; 2025 GreenBoard</p>
  </footer>
</body>
</html>
