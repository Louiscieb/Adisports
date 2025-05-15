const form = document.getElementById("chat_box");
const boutonIndice = document.getElementById("indice");
const boutonSport = document.getElementById("sport");
const boutonDateDebut = document.getElementById("date_debut");
const boutonDateFin = document.getElementById("date_fin");
const boutonClub = document.getElementById("club");
const boutonPrenom = document.getElementById("prenom");
const boutonAdmin = document.getElementById("Admin");

const idsBoutons = [ 
    "sport",
    "date_debut",
    "date_fin",
    "club",
    "prenom",
    "Admin"
];
function confirmerEtExecuter(nomBouton) {
    if (confirm(`Êtes-vous sûr de vouloir interagir avec "${nomBouton}" ?`)) {
        console.log(`Action confirmée pour : ${nomBouton}`);

        const formData = new FormData();
        formData.append("indice", nomBouton);

        fetch("Jeu2_serveur.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data !== "") {
                console.log("Réponse du serveur :", data);

                const [points, valeur] = data.split(",");
                
                if (points !== "-1") { /*-1 est envoyé par echo et signifique que rien n'a changé*/
                    console.log(points)
                    const indiceElement = document.getElementById("indice");
                    indiceElement.textContent = `Points d'indices: ${points}/10`;
                    alert(valeur);
                } else {
                    alert(valeur); 
                }
            }
        })
        .catch(error => {
            console.error("Erreur lors du fetch vers Jeu2_serveur.php :", error);
        });
    } else {
        console.log(`Action annulée pour : ${nomBouton}`);
    }
}



idsBoutons.forEach(id => { /* permet de reduire de beacouuup la place prise*/
    const bouton = document.getElementById(id);
    if (bouton) {
        bouton.addEventListener("click", () => confirmerEtExecuter(id));
    }
});


form.addEventListener("submit", function (e) {
    e.preventDefault();

    const input = document.getElementById("chat_text");
    const message = input.value.trim();

    if (message === "") {/*optionnel normalement jamais on arrive jammais ici*/
        alert("Message vide");
        return;
    }

    const formData = new FormData();
    formData.append("message", message); /*on le remmet sous forme de Form*/

    fetch("handler_chatbox_user2.php", {
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
    console.log("récupération des messages");

    fetch("handler_chatbox_user2.php", {
        method: 'GET'
    })
    .then(response => response.text())
    .then(text => {
        const result = text.trim();
        if (result === "#Error_") {
            alert("Erreur lors du chargement des messages.");
        } else {
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
                li.textContent = message.username + ": " + message.message;
                messagesList.appendChild(li);
            });
        }
    })
    .catch(error => {
        console.error("Erreur FETCH GET :", error);
        alert("Erreur lors du chargement des messages.");
    });
}

setInterval(afficherMessages, 5000); /* refraichit toutes les 3 sec */
