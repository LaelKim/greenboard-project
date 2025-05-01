<?php
if (!isset($isLoggedIn)) {
  include('../backend/session.php');
}
?>

<header>
  <a href="index.php" class="logo"><h1>🎲 GreenBoard</h1></a>
  <nav>
    <a href="catalogue.php">Catalogue</a>

    <?php if ($isLoggedIn): ?>
      <a href="wishlist.php">Wishlist</a>
    <?php endif; ?>

    <a href="ecoindex.php">ÉcoIndex</a>
    <a href="rapport.php">Rapport</a>

    <?php if ($isLoggedIn && $_SESSION['user_role'] === 'admin'): ?>
      <a href="users.php">Utilisateurs</a>
    <?php endif; ?>

    <?php if ($isLoggedIn): ?>
      <a href="profil.php" class="btn-user">👤 <?= htmlspecialchars($userName) ?></a>
      <a href="../backend/logout.php" class="btn-logout">Se déconnecter</a>
    <?php else: ?>
      <a href="login.php" class="btn-login">Se connecter</a>
    <?php endif; ?>
  </nav>
</header>
