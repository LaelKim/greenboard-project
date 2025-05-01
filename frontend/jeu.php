<?php include('../backend/session.php'); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Détail du jeu - GreenBoard</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <?php include('header.php'); ?>

    <main>
      <section class="jeu-details" id="jeu-container">
        <!-- Contenu dynamique injecté ici -->
      </section>
    </main>

    <?php include('footer.php'); ?>


    <script src="js/jeu.js"></script>
  </body>
</html>
