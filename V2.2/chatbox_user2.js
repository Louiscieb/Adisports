const form = document.getElementById("chat_box");

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

setInterval(afficherMessages, 3000); /* refraichit toutes les 3 sec */
