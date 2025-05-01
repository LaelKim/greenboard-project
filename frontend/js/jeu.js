// Récupérer l'ID du jeu depuis l'URL
const params = new URLSearchParams(window.location.search);
const id = params.get("id");

if (!id) {
  document.getElementById("jeu-container").innerHTML = "<p>Jeu non trouvé.</p>";
} else {
  fetch(`../backend/get-game-by-id.php?id=${id}`)
    .then((res) => res.json())
    .then((game) => {
      const container = document.getElementById("jeu-container");

      container.innerHTML = `
        <h2>${game.name}</h2>
        <img src="${
          game.thumbnail || "https://via.placeholder.com/300?text=No+Image"
        }" alt="${game.name}" style="max-width: 300px; border-radius: 10px;" />
        <p><strong>Année de publication :</strong> ${game.year_published}</p>
        <p><strong>Nombre de joueurs :</strong> ${game.min_players} - ${
        game.max_players
      }</p>
        <p><strong>Temps de jeu :</strong> ${game.playing_time} min</p>
        <p><strong>Catégorie :</strong> ${game.category || "Non spécifiée"}</p>
        <p><strong>Note moyenne :</strong> ${
          game.average ? game.average.toFixed(1) : "N/A"
        }</p>
        <p><strong>Description :</strong></p>
        <p>${game.description || "Aucune description disponible."}</p>
      `;
    })
    .catch((err) => {
      console.error(err);
      document.getElementById("jeu-container").innerHTML =
        "<p>Erreur lors du chargement.</p>";
    });
}
