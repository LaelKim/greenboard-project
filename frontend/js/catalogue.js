fetch("../backend/get-games.php")
  .then((response) => response.json())
  .then((data) => {
    const container = document.getElementById("catalogue-container");

    data.forEach((game) => {
      const image =
        game.thumbnail && game.thumbnail.startsWith("http")
          ? game.thumbnail
          : "https://via.placeholder.com/150?text=No+Image";

      const cardLink = document.createElement("a");
      cardLink.href = `jeu.html?id=${game.id}`;
      cardLink.className = "card";
      cardLink.style.textDecoration = "none";
      cardLink.style.color = "inherit";

      cardLink.innerHTML = `
        <img src="${image}" alt="${game.name}" />
        <h3>${game.name}</h3>
      `;

      container.appendChild(cardLink);
    });
  })
  .catch((error) => {
    console.error("Erreur chargement des jeux :", error);
  });
