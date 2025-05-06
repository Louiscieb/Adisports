setTimeout(() => {
    afficher_donnees();
}, 100);/* on pourait faire un Promise plus clair afin de bien attendre la fin de la modif du serv.json mais je dois tout remodifier*/

document.addEventListener('DOMContentLoaded', function () {
    afficher_donnees();  // Appel initial pour afficher les données dès que la page est chargée.
});


// Fonction pour afficher les données des serveurs
function afficher_donnees() {
    fetch("./serveur.json")
        .then(function(response) {
            if (!response.ok) throw new Error("Erreur lors du chargement des données");
            return response.json();
        })
        .then(function(data) {
            // Serveur 1
            if (data.S1) {
                var host1 = (data.S1.host !== null && data.S1.host !== undefined) ? data.S1.host : "Aucun"; //garde fou car on donne des libertés sur les pseudo
                var joueurs1 = data.S1.joueurs.length; // Nombre de joueurs dans S1
                var hostElement1 = document.getElementById("host1");
                if (hostElement1) {
                    hostElement1.innerHTML = "- hôte : " + host1;
                }

                var joueursList1 = "<ul>";
                data.S1.joueurs.forEach(function(joueur) {
                    joueursList1 += "<li>" + joueur + "</li>";
                });
                joueursList1 += "</ul>";

                var joueurElement1 = document.getElementById("joueur1_list");
                if (joueurElement1) {
                    joueurElement1.innerHTML = joueursList1;
                }

                // Mettre à jour le nombre de joueurs
                var joueursCount1 = document.getElementById("joueurs_count1");
                if (joueursCount1) {
                    joueursCount1.innerHTML = joueurs1 + " joueur(s)";
                }
            }

            // Serveur 2
            if (data.S2) {
                var host2 = data.S2.host ? data.S2.host : "Aucun";
                var joueurs2 = data.S2.joueurs.length; // Nombre de joueurs dans S2
                var hostElement2 = document.getElementById("host2");
                if (hostElement2) {
                    hostElement2.innerHTML = "- hôte : " + host2;
                }

                var joueursList2 = "<ul>";
                data.S2.joueurs.forEach(function(joueur) {
                    joueursList2 += "<li>" + joueur + "</li>";
                });
                joueursList2 += "</ul>";

                var joueurElement2 = document.getElementById("joueur2_list");
                if (joueurElement2) {
                    joueurElement2.innerHTML = joueursList2;
                }

                // Mettre à jour le nombre de joueurs
                var joueursCount2 = document.getElementById("joueurs_count2");
                if (joueursCount2) {
                    joueursCount2.innerHTML = joueurs2 + " joueur(s)";
                }
            }
        })
        .catch(function(error) {
            console.error("Erreur JSON :", error);
        });
}

// Connexion à un serveur
document.getElementById("form_serv_connect").addEventListener('submit', function (e) {
    e.preventDefault();
    
    const formData = new FormData(this);

    fetch("./serveur.php", {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        const result = text.trim();
        const [user, serv, val] = result.split(",");
        const parsedResult = parseInt(val, 10);

        if (!isNaN(parsedResult) && Number.isInteger(parsedResult)) {
            alert("Il y a " + parsedResult + " joueur(s) connecté(s).");
            afficher_donnees();
            return;
        }

        switch (result) {
            case "fichier_error":
                alert("Erreur serveur \n Ressayez dans quelques minutes");
                break;
            case "attente":
                alert("En attente d'autres joueurs...");
                break;
            case "launch":
                window.location.href = "Jeu.html";
                break;
            case "plein":
                alert("Serveur plein. Attendez la fin de la partie.");
                break;
            case "invalide":
                alert("Mot de passe ou nom de serveur invalide !");
                break;
            case "intru":
                window.location.href = "Acceuil.html";
                break;
            default:
                alert("Erreur inattendue : " + result);
                break;
        }
    })
    .catch(error => {
        console.error("Erreur", error);
        alert("Une erreur est survenue avec la requête.");
    });
});

// Création d'un serveur
document.getElementById("form_creat_serv").addEventListener('submit', function (e) {
    e.preventDefault();

    const formData2 = new FormData(this);

    fetch("./init_serveur.php", {
        method: 'POST',
        body: formData2
    })
    .then(response => response.text())
    .then(text => {
        const result = text.trim();
        const [user, serv, val] = result.split(",");
        const parsedResult = parseInt(val, 10); 
        if (!isNaN(parsedResult) && Number.isInteger(parsedResult)) {
            alert("Il y a " + parsedResult + " joueur(s) connecté(s).");
            afficher_donnees();
            return;
        }

        switch (result) {
            case "fichier_error":
                alert("Erreur serveur \n Ressayez dans quelques minutes");
                break;
            case "conect_creat":
                alert("Vous hébergez déjà un serveur");
                break;
            case "serv_already":
                alert("Ce serveur est déjà utilisé!");
                break;
            case "intru":
                window.location.href = "Acceuil.html";
                break;
            default:
                alert("Erreur inattendue : " + result);
                break;
        }
    })
    .catch(error => {
        console.error("Erreur", error);
        alert("Une erreur est survenue avec la requête.");
    });
});
