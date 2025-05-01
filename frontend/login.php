<?php include('../backend/session.php'); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - GreenBoard</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <?php include('header.php'); ?>

    <div class="login-wrapper">
      <div class="login-left"></div>
      <div class="login-right">
        <div class="login-box">
          <h2>Connexion</h2>
          <form action="../backend/login.php" method="post">
            <input
              type="email"
              name="email"
              placeholder="Adresse email"
              required
            />
            <input
              type="password"
              name="password"
              placeholder="Mot de passe"
              required
            />
            <button type="submit">Se connecter</button>
          </form>
          <p class="register-link">
            Pas de compte ? <a href="register.php">Créer un compte</a>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
