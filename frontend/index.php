<?php include('../backend/session.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <a href="index.php" class="logo"><h1>🎲 GreenBoard</h1></a>
    <nav>
      <a href="catalogue.php">Catalogue</a>
      <a href="users.php">Utilisateurs</a>
      <a href="ecoindex.php">ÉcoIndex</a>
      <a href="rapport.php">Rapport</a>

      <?php if ($isLoggedIn): ?>
        <a href="profil.php" class="btn-user">👤 <?= htmlspecialchars($userName) ?></a>
        <a href="../backend/logout.php" class="btn-logout">Se déconnecter</a>
      <?php else: ?>
        <a href="login.html" class="btn-login">Se connecter</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <h2>Bienvenue sur GreenBoard</h2>
    <p>Votre bibliothèque de jeux de société en ligne. Éco-conçue, interactive et dynamique.</p>
    <a class="cta" href="catalogue.php">🎮 Explorer le catalogue</a>
  </main>

  <footer>
    <p>&copy; 2025 GreenBoard • Projet étudiant éco-responsable</p>
  </footer>
</body>
</html>
