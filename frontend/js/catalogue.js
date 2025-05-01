fetch("../backend/get-games.php")
  .then((response) => response.json())
  .then((data) => {
    const tbody = document.querySelector("#games-table tbody");
    data.forEach((game) => {
      const image =
        game.thumbnail && game.thumbnail.startsWith("http")
          ? game.thumbnail
          : "https://via.placeholder.com/64?text=No+Image";

      const row = document.createElement("tr");
      row.innerHTML = `
        <td><img src="${image}" alt="${game.name}"></td>
        <td>${game.name}</td>
        <td>${game.year_published || "—"}</td>
        <td>${game.min_players || "?"} - ${game.max_players || "?"}</td>
        <td>${game.playing_time || "?"} min</td>
        <td>${game.category || "Non spécifiée"}</td>
        <td>${game.average ? game.average.toFixed(1) : "N/A"}</td>
      `;
      tbody.appendChild(row);
    });
  })
  .catch((error) => {
    console.error("Erreur chargement des jeux :", error);
  });
