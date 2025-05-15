const form = document.getElementById("chat_box");
const boutonIndice = document.getElementById("indice");
const boutonSport = document.getElementById("sport");
const boutonDateDebut = document.getElementById("date_debut");
const boutonDateFin = document.getElementById("date_fin");
const boutonClub = document.getElementById("club");
const boutonPrenom = document.getElementById("prenom");
const devinette= document.getElementById("Trouver");

const idsBoutons = [ 
    "sport",
    "date_debut",
    "date_fin",
    "club",
    "prenom"
];
window.onload = function () {
    const fromSelectionPage = document.referrer.includes("Selection1.php");

    idsBoutons.forEach(id => {
        const element = document.getElementById(id);
        if (element && element.tagName.toLowerCase() === "p") {
            if (fromSelectionPage) {
                /*Cas admin : suppression*/
                element.remove();
                console.log(`Élément <p> avec l'ID "${id}" supprimé.`);
            } else {
               /* Cas user : cacher puis afficher après 15 sec*/
                element.style.display = "none";
                console.log(`Élément <p> avec l'ID "${id}" caché.`);
                setTimeout(() => {
                    element.style.display = "block";
                    console.log(`Élément <p> avec l'ID "${id}" affiché après 15 secondes.`);
                }, 15000);
            }
        }
    });
};

devinette.addEventListener("click", function () {
    const tentative = prompt("Quel est le nom du sportif ?");
    
    if (tentative === null || tentative.trim() === "") {
        alert("Annulé ou vide !");
        return;
    }

    const formData = new FormData(); /*creation d'un form data car c'est le fetch dont j'ai l'habitude de faire*/
    formData.append("trouver", tentative.trim());

    fetch("deviner.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert("Réponse du serveur : " + result);
    })
    .catch(err => {
        console.error("Erreur lors de la requête :", err);
    });
});









    

function confirmerEtExecuter(nomBouton) {
    if (confirm(`Êtes-vous sûr de vouloir interagir avec "${nomBouton}" ?`)) {
        console.log(`Action confirmée pour : ${nomBouton}`);

        const formData = new FormData();
        formData.append("indice", nomBouton);

        fetch("Jeu1_serveur.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Réponse brute du serveur :", data);

            // Découpe la première virgule seulement
            const virguleIndex = data.indexOf(",");
            if (virguleIndex === -1) {
                alert("Réponse inattendue du serveur.");
                return;
            }

            const points = data.slice(0, virguleIndex).trim();
            const valeur = data.slice(virguleIndex + 1).trim();

            const indiceElement = document.getElementById("indice");
            indiceElement.textContent = `Points d'indices: ${points}/10`;

            // Affiche seulement si valeur non vide
            if (valeur) {
                alert(valeur);
            }
        })
        .catch(error => {
            console.error("Erreur lors du fetch vers Jeu1_serveur.php :", error);
        });
    } else {
        console.log(`Action annulée pour : ${nomBouton}`);
    }
}

idsBoutons.forEach(id => {
    const bouton = document.getElementById(id);
    if (bouton) {
        bouton.addEventListener("click", () => confirmerEtExecuter(id));
    }
});


form.addEventListener("submit", function (e) {
    e.preventDefault();

    const input = document.getElementById("chat_text");
    const message = input.value.trim();

    if (message === "") {
        alert("Message vide");
        return;
    }

    const formData = new FormData();
    formData.append("message", message);

    fetch("handler_chatbox_user.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        if (text.trim() === "#Error_") {
            alert("Erreur côté PHP.");
        } else {
            input.value = "";
            afficherMessages();
        }
    })
    .catch(err => {
        console.error("Erreur FETCH :", err);
    });
});

function afficherMessages() {
    fetch("handler_chatbox_user.php", {
        method: 'GET'
    })
    .then(response => response.text())
    .then(text => {
        const result = text.trim();
        if (result === "#Error_") {
            alert("Erreur lors du chargement des messages.");
            return;
        }

        let messages;
        try {
            messages = JSON.parse(result);
        } catch (e) {
            console.error("Erreur JSON :", result);
            alert("Réponse JSON invalide.");
            return;
        }

        const messagesList = document.getElementById("affichage");
        messagesList.innerHTML = "";

        messages.forEach(message => {
            const li = document.createElement("li");
            li.textContent = `${message.username}: ${message.message}`;
            messagesList.appendChild(li);
        });
    })
    .catch(error => {
        console.error("Erreur FETCH GET :", error);
        alert("Erreur lors du chargement des messages.");
    });
}

setInterval(afficherMessages, 5000);
 // rafraîchit toutes les 5 sec
// function endGame(){
//     fetch("minuteur.php", {
//         method: GET
//     })
//     .then(response => response.text())
//     .then(text =>{
//         const minuteur = text.trim();
//         if (minuteur === "Boom"){
//             declencherExplosion();
//         }
//     })
// }


// function declencherExplosion() {
//     document.body.style.background = "black";
//     document.body.innerHTML = "<h1 style='font-size: 80px; text-align: center; color: red;'>💥 BOOM 💥</h1>";

//     setTimeout(() => {
//         window.location.href = "Page.php";
//     }, 2000);
// }

// setInterval(endGame(), 10000);