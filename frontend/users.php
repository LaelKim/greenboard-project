<?php
include('../backend/session.php');
if (!$isAdmin) {
    header("Location: index.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=greenboard;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Traitement : supprimer un utilisateur
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_user_id"])) {
    $deleteId = intval($_POST["delete_user_id"]);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$deleteId]);
    header("Location: users.php");
    exit;
}

// Traitement : changer rôle admin
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["toggle_admin_id"])) {
    $userId = intval($_POST["toggle_admin_id"]);
    $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $isAdmin = $stmt->fetchColumn();

    $newRole = $isAdmin ? 0 : 1;
    $update = $pdo->prepare("UPDATE users SET is_admin = ? WHERE id = ?");
    $update->execute([$newRole, $userId]);
    header("Location: users.php");
    exit;
}

$users = $pdo->query("SELECT id, username, is_admin FROM users ORDER BY id ASC")->fetchAll();
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
  <h2>👥 Gestion des utilisateurs</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom d'utilisateur</th>
        <th>Rôle</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user["id"] ?></td>
          <td><?= htmlspecialchars($user["username"]) ?></td>
          <td><?= $user["is_admin"] ? "Admin" : "Utilisateur" ?></td>
          <td>
            <?php if ($_SESSION["user_id"] != $user["id"]): ?>
              <form method="POST" style="display:inline">
                <input type="hidden" name="delete_user_id" value="<?= $user["id"] ?>">
                <button type="submit" onclick="return confirm('Supprimer cet utilisateur ?')">🗑 Supprimer</button>
              </form>
              <form method="POST" style="display:inline">
                <input type="hidden" name="toggle_admin_id" value="<?= $user["id"] ?>">
                <button type="submit">
                  <?= $user["is_admin"] ? "Retirer admin" : "Promouvoir admin" ?>
                </button>
              </form>
            <?php else: ?>
              <em>(Vous)</em>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>
<?php include('footer.php'); ?>
</body>
</html>
