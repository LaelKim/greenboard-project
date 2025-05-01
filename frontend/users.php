<?php
include('../backend/session.php');

// Rediriger si non connecté OU si pas admin
if (!$isLoggedIn || $_SESSION['user_role'] !== 'admin') {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des utilisateurs - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>



  <main>
    <h2>Gestion des utilisateurs</h2>
    <p>Ici s’affichera la liste des utilisateurs (à générer dynamiquement plus tard).</p>
  </main>

  <?php include('footer.php'); ?>

</body>
</html>
