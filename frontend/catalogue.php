<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catalogue - GreenBoard</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>
      <a href="index.php" class="logo"><h1>🎲 GreenBoard</h1></a>
      <nav>
        <a href="catalogue.php">Catalogue</a>
        <a href="users.php">Utilisateurs</a>
        <a href="ecoindex.html">ÉcoIndex</a>
        <a href="rapport.html">Rapport</a>
        <a href="login.html" class="btn-login">Se connecter</a>
      </nav>
    </header>

    <main>
      <h2>Catalogue des jeux</h2>
      <div class="catalogue-grid" id="catalogue-container">
        <!-- Cartes dynamiques générées en JS -->
      </div>
    </main>

    <footer>
      <p>&copy; 2025 GreenBoard • Projet étudiant éco-responsable</p>
    </footer>

    <script src="js/catalogue.js"></script>
  </body>
</html>
