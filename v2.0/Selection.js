const form1 = document.getElementById("Select_form1");
if (form1) {
    form1.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log("Enregistrement Formulaire 1");

        const formData = new FormData(this);

        fetch("handler_select.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log("Réponse brute du serveur :", text);
            const result = text.trim();
            if (result === "good") {
                window.location.href = "Jeu1.php";
            } else {
                alert("Erreur : " + result);
            }
        })
        .catch(error => {
            console.error("Erreur FETCH :", error);
            alert("Une erreur est survenue avec la requête.");
        });
    });
}

const form2 = document.getElementById("Select_form2");
if (form2) {
    form2.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log("Enregistrement Formulaire 2");

        const formData = new FormData(this);

        fetch("handler_select2.php", {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log("Réponse brute du serveur :", text);
            const result = text.trim();
            if (result === "good") {
                window.location.href = "Jeu2.php";
            } else {
                alert("Erreur : " + result);
            }
        })
        .catch(error => {
            console.error("Erreur FETCH :", error);
            alert("Une erreur est survenue avec la requête.");
        });
    });
}
