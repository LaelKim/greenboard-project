fetch("../backend/get-games.php")
  .then((response) => response.json())
  .then((data) => {
    const container = document.getElementById("catalogue-container");

    data.forEach((game) => {
      const image =
        game.thumbnail && game.thumbnail.startsWith("http")
          ? game.thumbnail
          : "https://via.placeholder.com/150?text=No+Image";

      const card = document.createElement("div");
      card.className = "card";

      const link = document.createElement("a");
      link.href = `jeu.php?id=${game.id}`;
      link.style.textDecoration = "none";
      link.style.color = "inherit";

      link.innerHTML = `
        <img src="${image}" alt="${game.name}" />
        <h3>${game.name}</h3>
      `;

      const heartBtn = document.createElement("button");
      heartBtn.className = "wishlist-btn";
      heartBtn.dataset.gameId = game.id;
      heartBtn.innerText = game.in_wishlist ? "❤️" : "🤍";

      if (game.in_wishlist) heartBtn.classList.add("active");

      heartBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (!isLoggedIn) {
          alert("Veuillez vous connecter pour gérer votre wishlist.");
          return;
        }

        fetch("../backend/toggle-wishlist.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "game_id=" + encodeURIComponent(game.id),
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.status === "added") {
              heartBtn.innerText = "❤️";
              heartBtn.classList.add("active");
            } else if (data.status === "removed") {
              heartBtn.innerText = "🤍";
              heartBtn.classList.remove("active");
            }
          });
      });

      card.appendChild(link);
      card.appendChild(heartBtn);
      container.appendChild(card);
    });
  })
  .catch((error) => {
    console.error("Erreur chargement des jeux :", error);
  });
