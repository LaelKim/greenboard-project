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
  <meta charset="UTF-8" />
  <title>Ma Wishlist - GreenBoard</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php include('header.php'); ?>

<main>
  <h2>🎯 Ma Wishlist</h2>
  <div class="catalogue-grid" id="wishlist-container">
    <!-- Jeux injectés via JS -->
  </div>
</main>

<?php include('footer.php'); ?>

<script>
const container = document.getElementById("wishlist-container");

function loadWishlist() {
  fetch("../backend/get-wishlist.php")
    .then((res) => res.json())
    .then((games) => {
      container.innerHTML = "";

      if (games.length === 0) {
        container.innerHTML = "<p>Aucun jeu dans votre wishlist.</p>";
        return;
      }

      games.forEach(game => {
        const card = document.createElement("div");
        card.className = "card";

        const img = game.thumbnail?.startsWith("http")
          ? game.thumbnail
          : "https://via.placeholder.com/150?text=No+Image";

        card.innerHTML = `
          <a href="jeu.php?id=${game.id}" style="text-decoration: none; color: inherit;">
            <img src="${img}" alt="${game.name}" />
            <h3>${game.name}</h3>
            <p>Note moyenne : ${parseFloat(game.average).toFixed(2)}</p>
          </a>
          <button class="wishlist-btn active" data-id="${game.id}">🗑 Retirer</button>
        `;

        card.querySelector("button").addEventListener("click", () => {
          fetch("../backend/toggle-wishlist.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `game_id=${game.id}`
          })
          .then(res => res.json())
          .then(data => {
            if (data.status === "removed") {
              loadWishlist(); // Recharge après suppression
            }
          });
        });

        container.appendChild(card);
      });
    });
}

loadWishlist();
</script>
</body>
</html>
