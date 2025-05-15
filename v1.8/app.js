document.getElementById('conect_form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("./conect_compte.php", {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        const result = text.trim();
        if (result === "success") {
            window.location.href = "Page.php";
        } else if (result === "fichier_error") {
            window.location.href = "creation.html";
        } else {
            alert(result);
        }
    })
    .catch(error => {
        console.error("Erreur", error);
        alert("Une erreur est survenue avec la requête.");
    });
});


