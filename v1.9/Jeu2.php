<?php 
session_start(); 
if (!isset($_SESSION["username"])) {
    header("Location: Acceuil.html");
    exit();    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <title>Adisport</title>
</head>

<body class="jeu">
    <div class="entete">
        <div class="titre">
            <h1>Adisport</h1>
            <h4>Devine les tous!</h4>
        </div>
        <div class="photo_prof">
            <img id="photo_p" src="Images/profil1.png" alt="Photo de profil">
            <?php echo $_SESSION["username"]; ?>
            <script>
                const user = <?php echo json_encode($_SESSION['username']); ?>;
            </script>
        </div>
    </div>

    <div class="corp_jeu">
        <div class="carnet">
            <div class="notes">
                <h3 id ="indice">Points d'indices:10/10</h3>
                <p id ="sport">indice: sport(3/10)</p> 
                <p id ="date_debut">indice: date_debut(2/10)</p>
                <p id="date_fin">indice: date_fin(3/10)</p>
                <p id ="club">indice: club(5/10)</p>
                <p id ="prenom">indice: prenom(6/10)</p>
                <p id ="Admin">indice: personalisé (5/10)</p>
            </div>
        </div>
    

        <div class="bomb"></div>


        <div class="chatbox">
            
            <div id="affichage"></div>
            
            <form id="chat_box">
                <label for="chat_text">Tapez :</label>
                <input type="text" name="message" id="chat_text" required>
                <input type="submit" id="bouton" value="Envoyer">
            </form>
        </div>

    </div>
</body>

<script src="Jeu2.js"> </script>    

</html>

