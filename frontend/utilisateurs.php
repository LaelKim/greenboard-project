<?php
include('../backend/session.php');
if (!$isAdmin) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des utilisateurs</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include('header.php'); ?>
  <main>
    <h2>Gestion des utilisateurs (Admin)</h2>
    <p>Ici vous pourrez ajouter ou supprimer des comptes (à implémenter).</p>
  </main>
  <?php include('footer.php'); ?>
</body>
</html>
