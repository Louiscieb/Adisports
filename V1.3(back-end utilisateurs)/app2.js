
document.getElementById('creat_form').addEventListener('submit', function (e) {
    e.preventDefault()/*recharge pas la page pro*/

    const formData = new FormData(this);/*fct php permetant de creer un formulaire pour le fetch*/

    fetch("./Compte.php", {
        method: 'POST',
        body: formData /*pas besoin d'encoder qqchose avec le header de base*/
    })
    .then(response => response.text())
    .then(text => alert(text))
    .catch(error => console.error("Erreur", error));
});
