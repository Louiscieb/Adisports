document.addEventListener('DOMContentLoaded', function () {
    afficher_donnees();  // Appel initial pour afficher les données dès que la page est chargée.
});


function afficher_donnees() {
    console.log("afficher_donnees lancé");
    fetch("./serveur.json?t=" + Date.now()) /* serveur.json de il y a 1 sec != serveur.json de mtn cela permet a forcer de ne peut pas utiliser le json du cache localhost mais bien celui du serveur*/
        .then(function(response) {
            if (!response.ok) throw new Error("Erreur lors du chargement des données");
            return response.json();
        })
        .then(function(data) {
            console.log(user);
            if (data.S1) {
                const joueurs1 = data.S1.joueurs;
                const host1 = data.S1.host !== null ? data.S1.host : "Aucun";   
                const hostElement1 = document.getElementById("host1");

                if (data.S1.launch === true){
                document.getElementById("titre_S1").innerHTML = "Serveur 1 (lancé)" ;
                if(joueurs1.includes(user)){
                    if(host1 == user){
                        window.location.href = "./Selection1.php";
                        return;
                    }
                    else{
                        window.location.href = "./Jeu1.php";
                        return;

                    }

                }
                }
                
                if (hostElement1) hostElement1.innerHTML = "- hôte : " + host1;

                const joueurElement1 = document.getElementById("joueur1_list");
                if (joueurElement1) {
                    let joueursList1 = "<ul>";
                    joueurs1.forEach(joueur => {
                        joueursList1 += "<li>" + joueur + "</li>";
                    });
                    joueursList1 += "</ul>";
                    joueurElement1.innerHTML = joueursList1;
                }

                const joueursCount1 = document.getElementById("joueurs_count1");
                if (joueursCount1) joueursCount1.innerHTML = joueurs1.length + " joueur(s)";
            }

            // Serveur 2
            if (data.S2) {
                const joueurs2 = data.S2.joueurs;
                const host2 = data.S2.host !== null ? data.S2.host : "Aucun";
                const hostElement2 = document.getElementById("host2");
                if (data.S2.launch === true ) {
                document.getElementById("titre_S2").innerHTML = "Serveur 2 (lancé)" ;
                if(joueurs2.includes(user)){
                    if(host2 == user){
                        window.location.href = "./Selection2.php";
                        return;
                    }
                    else{
                        window.location.href = "./Jeu2.php";
                        return;
                    }
                }
                }
                if (hostElement2) hostElement2.innerHTML = "- hôte : " + host2;

                const joueurElement2 = document.getElementById("joueur2_list");
                if (joueurElement2) {
                    let joueursList2 = "<ul>";
                    joueurs2.forEach(joueur => {
                        joueursList2 += "<li>" + joueur + "</li>";
                    });
                    joueursList2 += "</ul>";
                    joueurElement2.innerHTML = joueursList2;
                }

                const joueursCount2 = document.getElementById("joueurs_count2");
                if (joueursCount2) joueursCount2.innerHTML = joueurs2.length + " joueur(s)";
            }
        })
        .catch(function(error) {
            console.error("Erreur JSON :", error);
        });
}


// Connexion à un serveur
document.getElementById("form_serv_connect").addEventListener('submit', function (e) {
    console.log("connexion");
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

setInterval(() => {
    afficher_donnees();
}, 10000);