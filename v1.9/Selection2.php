
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>

<body>
<div class="entete">
        <div class="titre">
            <h1>Adisport</h1>
            <h4>Devine les tous!</h4>
        </div>

        <div class="photo_prof">
            <img  src="Images/profil1.png" alt="Photo de profil">
            <div class="utilisateur">
                <?php session_start();
                echo $_SESSION['username']; ?>
            </div>
        </div>
    </div>

<div class="formulaire-box">
    <h1>Selectionner un sportif</h1>

    <form id="conect_form">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="Nom" autocomplete="off" required placeholder="Nom"> 
        <label for="prenom">Prenom</label>
        <input type="text" id="prenom" name="prenom" autocomplete="off" required placeholder="Nom"> 
        <label for="club">Club</label>
        <input type="text" id="Club" name="club" autocomplete="off" required placeholder="club"> 
        <label for="date_debut">Date de début</label>
        <input type="date" id="date_debut" name="date_debut" required>
        <label for="date_fin">Date de fin</label>
        <input type="date" id="date_fin" name="date_fin" required>
        <input type="submit" value="Enregistrer" class="bouton">
    </form> 
</div>

</body>
</html>
<script src="app.js"></script>