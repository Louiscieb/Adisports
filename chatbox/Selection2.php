<?php
session_start();

if (isset($_SESSION["mot"])) {
    header("Location: Jeu2.php");
    exit();    
}
if (!isset($_SESSION["username"])) {
    header("Location: Acceuil.html");
    exit();    
}
if (!($_SESSION["serv"]=="S2")) {
    $_SESSION["serv"]="S2";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Selection.css">
    <title>Connexion</title>
</head>
<body>
<div class="entete">
        <div class="titre">
            <h1>Adisport</h1>
            <h4>Devine les tous!</h4>
        </div>
        <div class="photo_prof">
            <img id="photo_p" src="Images/profil1.png" alt="Photo de profil">
            <?php echo $_SESSION["username"]; ?>
        </div>
    </div>
<br>
<div class="A">

    <div class="B">
        <div class="C">
            Selectionner un sportif
        </div>

        <form id="Select_form2">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="Nom" autocomplete="off" required placeholder="Nom"><br> 
            <label for="prenom">Prenom</label><br>
            <input type="text" id="prenom" name="prenom" autocomplete="off" required placeholder="Nom"><br> 
            <label for="club">Club</label><br>
            <input type="text" id="Club" name="club" autocomplete="off" required placeholder="club"><br> 
            <label for="date_debut">Date de début</label><br>
            <input type="date" id="date_debut" name="date_debut" required><br>
            <label for="date_fin">Date de fin</label><br>
            <input type="date" id="date_fin" name="date_fin" required>
            <br>
            <label for="sport">sport</label><br>
            <input type="sport" id="sport" name="sport" required><br>
            <br>
            <input type="submit" value="Enregistrer" class="bouton">
            <br>
        </form>
    </div>
</div>
<br>
</body>
</html>
<script src="Selection.js"></script>