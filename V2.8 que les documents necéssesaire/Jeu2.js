let intervalId = null;
let jeuTermine = false;

const form = document.getElementById("chat_box");
const input = document.getElementById("chat_text");
const messagesList = document.getElementById("affichage");
const devinette = document.getElementById("Trouver");
const bombe = document.getElementsByClassName("bomb")[0];
const idsBoutons = ["sport", "date_debut", "date_fin", "club", "prenom"];

function stopGame() {
  if (intervalId !== null) clearInterval(intervalId);
}

function declencherExplosion() {
  jeuTermine = true;
  stopGame();
  document.body.style.background = "black";
  document.body.innerHTML = "";
  const boomText = document.createElement("h1");
  boomText.textContent = "💥 BOOM 💥";
  boomText.style.cssText = "font-size: 80px; text-align: center; color: red;";
  document.body.appendChild(boomText);
  setTimeout(resetServeurEtQuitter, 3000);
}

function resetServeurEtQuitter() {
  fetch("fin_de_partie.php", {
    method: "POST"
  })
    .then(response => response.text())
    .then(result => {
      if (result.trim() === "ok") {
        setTimeout(() => {
          window.location.href = "Page.php";
        }, 3000);
      }
    })
    .catch(() => {
      alert("Impossible de contacter le serveur.");
    });
}

function endGame() {
  if (jeuTermine) return;

  fetch("minuteur2.php")
    .then(res => res.text())
    .then(text => {
      const minuteur = text.trim();
      if (minuteur === "Boom") {
        jeuTermine = true;
        stopGame();
        declencherExplosion();
      } else if (minuteur === "0") {
        bombe.style.boxShadow = "0px 0px 20px 10px rgb(146, 18, 18)";
        setTimeout(() => {
          bombe.style.boxShadow = "0px 0px 20px 10px rgb(124, 60, 18)";
        }, 1000);
      }
    });
}

function afficherMessages() {
  fetch("handler_chatbox_user2.php")
    .then(res => res.text())
    .then(text => {
      if (text.trim() === "#Error_") return;
      const messages = JSON.parse(text.trim());
      messagesList.innerHTML = "";
      messages.forEach(msg => {
        const li = document.createElement("li");
        li.textContent = `${msg.username}: ${msg.message}`;
        messagesList.appendChild(li);
      });
    });
}

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const message = input.value.trim();
  if (message === "") return;

  const formData = new FormData();
  formData.append("message", message);

  fetch("handler_chatbox_user2.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(text => {
      if (text.trim() !== "#Error_") {
        input.value = "";
        afficherMessages();
      }
    });
});

devinette.addEventListener("click", function () {
  const tentative = prompt("Quel est le nom du sportif ?");
  if (!tentative || tentative.trim() === "") return;

  const formData = new FormData();
  formData.append("trouver", tentative.trim());

  fetch("deviner2.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(result => {
      if (result.includes("Yes")) {
        bombe.style.boxShadow = "0px 0px 20px 10px rgb(146, 18, 18)";
        setTimeout(() => {
          document.body.style.background = "green";
          document.body.innerHTML = "";
          const bravoText = document.createElement("h1");
          bravoText.textContent = "💥 BRAVO 💥";
          bravoText.style.cssText = "font-size: 80px; text-align: center; color: red;";
          document.body.appendChild(bravoText);
          setTimeout(() => {
            window.location.href = "fin_de_partie.php";
          }, 2000);
        }, 1000);
      } else if (result.includes("No")) {
        fetch("minuteur2.php", { method: "POST" })
          .then(res => res.text())
          .then(txt => {
            if (txt.trim() === "Boom") declencherExplosion();
          });
      } else {
        alert("Réponse inattendue : " + result);
      }
    });
});

function confirmerEtExecuter(nomBouton) {
  if (!confirm(`Êtes-vous sûr de vouloir interagir avec "${nomBouton}" ?`)) return;

  const formData = new FormData();
  formData.append("indice", nomBouton);

  fetch("Jeu2_serveur.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(data => {
      const [points, valeur] = data.split(",").map(s => s.trim());
      document.getElementById("indice").textContent = `Points d'indices: ${points}/10`;
      alert(valeur);
    });
}

idsBoutons.forEach(id => {
  const bouton = document.getElementById(id);
  if (bouton) bouton.addEventListener("click", () => confirmerEtExecuter(id));
});

window.onload = function () {
  const el = document.querySelector(".Anime");
  if (el) el.addEventListener("animationend", () => el.remove());

  const fromSelectionPage = document.referrer.includes("Selection2.php");

  idsBoutons.forEach(id => {
    const element = document.getElementById(id);
    if (element && element.tagName.toLowerCase() === "p") {
      if (fromSelectionPage) {
        devinette?.remove();
        element.remove();
      } else {
        element.style.display = "none";
        setTimeout(() => {
          element.style.display = "block";
        }, 15000);
      }
    }
  });
};

intervalId = setInterval(endGame, 10000);
setInterval(afficherMessages, 5000);