<?php include('../backend/session.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catalogue - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include('header.php'); ?>

<main>
  <h2>Catalogue des jeux</h2>
  <div class="catalogue-grid" id="catalogue-container">
    <!-- Cartes dynamiques générées en JS -->
  </div>
</main>

<?php include('footer.php'); ?>

<script>
  const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
</script>
<script src="js/catalogue.js"></script>
</body>
</html>
